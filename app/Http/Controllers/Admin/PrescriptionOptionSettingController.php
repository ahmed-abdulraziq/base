<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrescriptionOptionSetting;
use App\Services\Dashboard\PrescriptionOptionSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PrescriptionOptionSettingController extends Controller
{
    public function __construct(
        protected PrescriptionOptionSettingService $optionService
    ) {
        $this->middleware('auth:admin');
        $this->middleware('can:view.settings')->only(['index', 'store', 'destroy']);
    }

    public function index(): View
    {
        $optionsByType = $this->optionService->getOptionsByType();
        return view('admin.settings.prescription-options.index', compact('optionsByType'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(PrescriptionOptionSetting::TYPES)],
            'value' => ['required', 'string', 'max:255'],
        ]);

        $this->optionService->addOption($validated['type'], $validated['value']);

        return redirect()->back()->with('success', __('translate.option_added_successfully'));
    }

    public function destroy(PrescriptionOptionSetting $prescriptionOptionSetting): RedirectResponse
    {
        $this->optionService->delete($prescriptionOptionSetting);
        return redirect()->back()->with('success', __('translate.option_deleted_successfully'));
    }
}
