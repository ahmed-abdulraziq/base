<?php

namespace App\Services\Dashboard;

use App\Models\MedicalExamination;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\PrescriptionOptionSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mpdf\Mpdf;

class PrescriptionService
{
    public function getFilteredQuery(Request $request, ?int $doctorId = null): Builder
    {
        $query = Prescription::query()->with(['patient', 'doctor']);

        if ($doctorId !== null) {
            $query->where('doctor_id', $doctorId);
        }

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->whereHas('patient', fn ($p) => $p->where('name', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%"))
                    ->orWhereHas('doctor', fn ($d) => $d->where('name', 'like', "%{$term}%"));
            });
        }
        if ($request->filled('filter_doctor')) {
            $query->where('doctor_id', $request->filter_doctor);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('prescription_date', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('prescription_date', '<=', $request->filter_date_to);
        }

        return $query;
    }

    public function getCreateFormOptions(?int $doctorId = null): array
    {
        $examinationsQuery = MedicalExamination::with(['patient', 'doctor'])
            ->orderBy('examination_date', 'desc');
        if ($doctorId !== null) {
            $examinationsQuery->where('doctor_id', $doctorId);
        }
        $examinations = $examinationsQuery->get()
            ->mapWithKeys(fn ($e) => [$e->id => "كشف #{$e->id} - {$e->patient?->full_name} - د.{$e->doctor?->full_name} - {$e->examination_date?->format('Y-m-d')}"])
            ->toArray();

        $medications = Medication::orderBy('medication_name')->pluck('medication_name', 'id')->toArray();
        $prescriptionOptions = PrescriptionOptionSetting::getAllOptions();

        return compact('examinations', 'medications', 'prescriptionOptions');
    }

    public function create(array $data, ?int $doctorId = null): Prescription
    {
        $examinationQuery = MedicalExamination::query();
        if ($doctorId !== null) {
            $examinationQuery->where('doctor_id', $doctorId);
        }
        $examination = $examinationQuery->findOrFail($data['examination_id']);

        $prescription = Prescription::create([
            'examination_id' => $examination->id,
            'patient_id' => $examination->patient_id,
            'doctor_id' => $examination->doctor_id,
            'prescription_date' => $data['prescription_date'],
            'notes' => $data['notes'] ?? null,
        ]);

        foreach ($data['details'] ?? [] as $detail) {
            if (empty($detail['medication_id'])) {
                continue;
            }
            $prescription->details()->create([
                'medication_id' => $detail['medication_id'],
                'dosage' => $detail['dosage'] ?? '',
                'frequency' => $detail['frequency'] ?? '',
                'duration' => $detail['duration'] ?? '',
                'instructions' => $detail['instructions'] ?? null,
            ]);
        }

        return $prescription;
    }

    public function update(Prescription $prescription, array $data): bool
    {
        $prescription->update([
            'prescription_date' => $data['prescription_date'],
            'notes' => $data['notes'] ?? null,
        ]);

        $prescription->details()->delete();
        foreach ($data['details'] ?? [] as $detail) {
            if (empty($detail['medication_id'])) {
                continue;
            }
            $prescription->details()->create([
                'medication_id' => $detail['medication_id'],
                'dosage' => $detail['dosage'] ?? '',
                'frequency' => $detail['frequency'] ?? '',
                'duration' => $detail['duration'] ?? '',
                'instructions' => $detail['instructions'] ?? null,
            ]);
        }

        return true;
    }

    public function delete(Prescription $prescription): bool
    {
        $prescription->details()->delete();
        return $prescription->delete();
    }

    public function generatePdf(Prescription $prescription): Response
    {
        $prescription->load(['patient', 'doctor', 'details.medication']);
        $html = view('dashboard.clinic.prescriptions.pdf', compact('prescription'))->render();

        $tempDir = storage_path('app/mpdf');
        $fontCacheDir = $tempDir . DIRECTORY_SEPARATOR . 'mpdf' . DIRECTORY_SEPARATOR . 'ttfontdata';
        if (is_dir($fontCacheDir)) {
            foreach (glob($fontCacheDir . DIRECTORY_SEPARATOR . 'cairo*') ?: [] as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'directionality' => 'rtl',
            'tempDir' => $tempDir,
            'fontDir' => [public_path('assets/fonts')],
            'fontdata' => [
                'cairo' => [
                    'R' => 'Cairo-Regular.ttf',
                    'B' => 'Cairo-Bold.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
            ],
            'default_font' => 'cairo',
        ]);
        $mpdf->SetDirectionality('rtl');
        $mpdf->WriteHTML($html);

        $patientName = $prescription->patient?->full_name ?? 'patient';
        $safeName = preg_replace('/[\s\/\\\\:*?"<>|]+/', '_', trim($patientName)) ?: 'patient';
        $date = $prescription->prescription_date?->format('Y-m-d') ?? now()->format('Y-m-d');
        $filename = "{$safeName}-{$prescription->prescription_id}-{$date}.pdf";

        return response(
            $mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    public function getDoctorOptionsForFilter(): array
    {
        return \App\Models\Doctor::active()->get()->pluck('full_name', 'id')->toArray();
    }
}
