@props([
    'tableId' => 'datatable',
    'showSearch' => false,
    'showDateRange' => true,
    'showRole' => false,
    'roleOptions' => [],
    'embedded' => false,
])

@php
    $formId = 'filter-form-' . $tableId;
@endphp

@if($embedded)
    {{-- فلتر مضمن: حجم عادي للحقول والأزرار --}}
    <form id="{{ $formId }}" class="row g-3 align-items-end">
        @if($showDateRange)
            <div class="col-auto">
                <label for="{{ $formId }}-date-from" class="form-label text-muted mb-0">@lang('translate.date_from')</label>
                <input type="date" class="form-control" id="{{ $formId }}-date-from" name="filter_date_from" style="min-width: 165px;">
            </div>
            <div class="col-auto">
                <label for="{{ $formId }}-date-to" class="form-label text-muted mb-0">@lang('translate.date_to')</label>
                <input type="date" class="form-control" id="{{ $formId }}-date-to" name="filter_date_to" style="min-width: 165px;">
            </div>
        @endif
        @if($showRole && count($roleOptions) > 0)
            <div class="col-auto">
                <label for="{{ $formId }}-role" class="form-label text-muted mb-0">@lang('translate.role')</label>
                <select class="form-select" id="{{ $formId }}-role" name="filter_role" style="min-width: 140px;">
                    <option value="">@lang('translate.all')</option>
                    @foreach($roleOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-auto d-flex gap-2">
            <button type="button" class="btn btn-primary filter-apply" data-table-id="{{ $tableId }}">
                @lang('translate.apply')
            </button>
            <button type="button" class="btn btn-outline-secondary filter-clear" data-table-id="{{ $tableId }}">
                @lang('translate.clear')
            </button>
        </div>
    </form>
@else
    {{-- فلتر منفصل (كارت قابل للطي) - بدون بحث افتراضياً --}}
    <div class="card mb-3">
        <div class="card-header py-2">
            <button class="btn btn-link btn-sm p-0 text-decoration-none d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $formId }}-collapse" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                </svg>
                @lang('translate.filter')
            </button>
        </div>
        <div class="collapse" id="{{ $formId }}-collapse">
            <div class="card-body pt-0">
                <form id="{{ $formId }}" class="row g-3">
                    @if($showSearch)
                        <div class="col-md-3 col-6">
                            <label for="{{ $formId }}-search" class="form-label small">@lang('translate.search')</label>
                            <input type="text" class="form-control form-control-sm" id="{{ $formId }}-search" name="filter_search" placeholder="@lang('translate.name') / @lang('translate.email')">
                        </div>
                    @endif
                    @if($showDateRange)
                        <div class="col-md-2 col-6">
                            <label for="{{ $formId }}-date-from" class="form-label small">@lang('translate.date_from')</label>
                            <input type="date" class="form-control form-control-sm" id="{{ $formId }}-date-from" name="filter_date_from">
                        </div>
                        <div class="col-md-2 col-6">
                            <label for="{{ $formId }}-date-to" class="form-label small">@lang('translate.date_to')</label>
                            <input type="date" class="form-control form-control-sm" id="{{ $formId }}-date-to" name="filter_date_to">
                        </div>
                    @endif
                    @if($showRole && count($roleOptions) > 0)
                        <div class="col-md-2 col-6">
                            <label for="{{ $formId }}-role" class="form-label small">@lang('translate.role')</label>
                            <select class="form-select form-select-sm" id="{{ $formId }}-role" name="filter_role">
                                <option value="">@lang('translate.all')</option>
                                @foreach($roleOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-3 col-6 d-flex align-items-end gap-2">
                        <button type="button" class="btn btn-primary btn-sm filter-apply" data-table-id="{{ $tableId }}">@lang('translate.apply')</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm filter-clear" data-table-id="{{ $tableId }}">@lang('translate.clear')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tableId = @json($tableId);
    var form = document.getElementById('filter-form-' + tableId);
    if (!form) return;

    form.querySelectorAll('.filter-apply[data-table-id="' + tableId + '"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (typeof jQuery !== 'undefined' && jQuery.fn.DataTable && jQuery('#datatable').length && jQuery.fn.DataTable.isDataTable('#datatable')) {
                jQuery('#datatable').DataTable().ajax.reload();
            }
        });
    });

    form.querySelectorAll('.filter-clear[data-table-id="' + tableId + '"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            form.reset();
            if (typeof jQuery !== 'undefined' && jQuery.fn.DataTable && jQuery('#datatable').length && jQuery.fn.DataTable.isDataTable('#datatable')) {
                jQuery('#datatable').DataTable().ajax.reload();
            }
        });
    });
});
</script>
@endpush
