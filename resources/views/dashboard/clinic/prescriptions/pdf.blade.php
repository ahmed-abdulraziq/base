<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('translate.prescription') }} #{{ $prescription->id }}</title>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            font-size: 13px;
            color: #1f2937;
            line-height: 1.6;
            padding: 15px;
            background: #fff;
        }

        /* ===== Header Block ===== */
        .header-block {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .block-title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .block-meta {
            margin-bottom: 10px;
        }

        .block-meta .badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #eef2ff;
            color: #4338ca;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 8px;
        }

        .meta-date {
            font-size: 12px;
            color: #6b7280;
        }

        .block-people {
            font-size: 13px;
            color: #374151;
        }

        .block-people span {
            display: inline-block;
            margin-left: 20px;
        }

        /* ===== Medications Block ===== */
        .meds-block {
            padding: 4px 0;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            background: #f1f5f9;
        }

        /* ===== Table ===== */
        .meds-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .meds-table thead th {
            background: #f1f5f9;
            color: #4338ca;
            padding: 12px 14px;
            font-weight: bold;
            font-size: 12px;
            text-align: start;
            /* border: 1px solid #e2e8f0; */
        }

        .meds-table thead th:first-child {
            width: 40px;
        }

        .meds-table tbody td {
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .meds-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .meds-table tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        .meds-table .col-num {
            text-align: center;
            font-weight: 600;
            color: #6b7280;
        }

        .meds-table .col-med {
            font-weight: 500;
            color: #1f2937;
        }

        .meds-table .instructions-row td {
            background: #f1f5f9 !important;
            padding: 8px 14px;
            font-size: 12px;
            color: #475569;
            border: none;
        }

        .meds-table .instructions-label {
            font-weight: 600;
            color: #64748b;
        }

        .center {
            text-align: center;
        }

        /* ===== Empty State ===== */
        .empty {
            text-align: center;
            color: #6b7280;
            padding: 30px;
            font-style: italic;
        }

        /* ===== Notes ===== */
        .notes-box {
            background-color: #fffbeb;
            border: 1px solid #fef3c7;
            border-radius: 8px;
            padding: 14px;
            margin-top: 15px;
        }

        .notes-title {
            font-size: 13px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 6px;
        }

        /* ===== Footer ===== */
        .watermark {
            text-align: center;
            margin-top: 25px;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
        }
    </style>
</head>

<body>

<!-- ===== Header (Patient + Doctor) ===== -->
<div class="header-block">
    <div class="block-title">{{ __('translate.prescription') }}</div>
    <div class="block-meta">
        <span class="badge">{{ __('translate.prescription_number') }}: #{{ $prescription->id }}</span>
        <span class="meta-date">{{ $prescription->prescription_date?->format('Y-m-d H:i') }}</span>
    </div>
    <div class="block-people">
        <span><strong>{{ __('translate.patient') }}:</strong> {{ $prescription->patient?->full_name ?? '-' }}</span>
        <span><strong>{{ __('translate.doctor') }}:</strong> {{ $prescription->doctor?->full_name ?? '-' }}</span>
    </div>
</div>

<!-- ===== Medications ===== -->
<div class="meds-block">
    @if(count($prescription->details ?? []))
        <table class="meds-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('translate.medication') }}</th>
                    <th>{{ __('translate.dosage') }}</th>
                    <th>{{ __('translate.frequency') }}</th>
                    <th>{{ __('translate.duration') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prescription->details ?? [] as $index => $detail)
                    <tr>
                        <td class="col-num">{{ $index + 1 }}</td>
                        <td class="col-med">{{ $detail->medication?->medication_name ?? '-' }}</td>
                        <td>{{ $detail->dosage ?? '-' }}</td>
                        <td>{{ $detail->frequency ?? '-' }}</td>
                        <td>{{ $detail->duration ?? '-' }}</td>
                    </tr>
                    <tr class="instructions-row">
                        <td colspan="5">
                            <span class="instructions-label">{{ __('translate.instructions') }}:</span>
                            {{ $detail->instructions ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty">لا توجد أدوية مضافة</div>
    @endif
</div>

<!-- ===== Notes ===== -->
@if($prescription->notes)
<div class="notes-box">
    <div class="notes-title">{{ __('translate.notes') }}</div>
    {{ $prescription->notes }}
</div>
@endif

<!-- ===== Footer ===== -->
<div class="watermark">
    {{ __('translate.prescription') }} • {{ now()->format('Y') }}
</div>

</body>
</html>