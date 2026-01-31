@props(['id', 'route', 'columns', 'createRoute' => null, 'title' => '', 'header' => '', 'noCard' => false])

<div class="{{ $noCard ? '' : 'box-shadow mb-30 pd-15' }}">
    <div class="row">
        <div class="col-12">
            @if($noCard)
            <div class="card-header pt-0">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="pd-15 d-flex align-items-center gap-2">
                        <input type="text" class="form-control searchEmail" id="search-table-{{ $id }}"
                            placeholder="{{ __('translate.search') }}"
                            aria-controls="datatable-{{ $id }}">
                        @if (isset($filter))
                            <button type="button" class="btn btn-link text-secondary p-0 border-0 filter-toggle ms-2"
                                data-bs-toggle="collapse" data-bs-target="#filter-row-{{ $id }}"
                                aria-expanded="false" aria-label="@lang('translate.filter')" title="@lang('translate.filter')">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter-2-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6h16" /><path d="M6 12h8.5" /><path d="M9 18h2" /><path d="M15 18c0 .796 .316 1.559 .879 2.121c.563 .563 1.326 .879 2.121 .879c.796 0 1.559 -.316 2.121 -.879c.563 -.563 .879 -1.326 .879 -2.121c0 -.796 -.316 -1.559 -.879 -2.121c-.563 -.563 -1.326 -.879 -2.121 -.879c-.796 0 -1.559 .316 -2.121 .879c-.563 .563 -.879 1.326 -.879 2.121" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                            </button>
                        @endif
                    </div>
                    @if ($createRoute)
                        <div class="pd-15">
                            <a href="{{ $createRoute }}" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                @lang('translate.add')
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @if (isset($filter))
                <div class="collapse border-bottom border-secondary bg-light-subtle"
                    id="filter-row-{{ $id }}" style="border-width: 1px !important;">
                    <div class="p-3">
                        {{ $filter }}
                    </div>
                </div>
            @endif
            <div class="table-responsive">
                <table id="datatable" class="table table-striped" style="margin: 0 !important;">
                    <thead>
                        <tr>
                            @foreach ($columns as $column)
                                <th width="{{ $column['width'] ?? 'auto' }}">
                                    {{ $column['title'] ?? __('translate.' . $column['data']) }}</th>
                            @endforeach
                            <th width="80px">{{ __('translate.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex align-items-center flex-column gap-3 gap-sm-0 flex-sm-row">
                    <div class="me-sm-3">
                        <label class="form-label m-0 d-flex gap-2">
                            @lang('translate.show')
                            <select name="datatable_length" aria-controls="datatable-{{ $id }}"
                                class="form-select form-select-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            @lang('translate.entries')
                        </label>
                    </div>
                    <p class="m-0 text-secondary" id="showing-entries-{{ $id }}"></p>
                    <ul class="pagination m-0 ms-sm-auto" id="custom-pagination-{{ $id }}"></ul>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="pd-15 d-flex align-items-center gap-2">
                            <input type="text" class="form-control searchEmail" id="search-table-{{ $id }}"
                                placeholder="{{ __('translate.search') }}"
                                aria-controls="datatable-{{ $id }}">
                            @if (isset($filter))
                                <button type="button" class="btn btn-link text-secondary p-0 border-0 filter-toggle ms-2"
                                    data-bs-toggle="collapse" data-bs-target="#filter-row-{{ $id }}"
                                    aria-expanded="false" aria-label="@lang('translate.filter')" title="@lang('translate.filter')">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter-2-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6h16" /><path d="M6 12h8.5" /><path d="M9 18h2" /><path d="M15 18c0 .796 .316 1.559 .879 2.121c.563 .563 1.326 .879 2.121 .879c.796 0 1.559 -.316 2.121 -.879c.563 -.563 .879 -1.326 .879 -2.121c0 -.796 -.316 -1.559 -.879 -2.121c-.563 -.563 -1.326 -.879 -2.121 -.879c-.796 0 -1.559 .316 -2.121 .879c-.563 .563 -.879 1.326 -.879 2.121" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                                </button>
                            @endif
                        </div>
                        @if ($createRoute)
                            <div class="pd-15">
                                <a href="{{ $createRoute }}" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    @lang('translate.add')
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @if (isset($filter))
                    <div class="collapse border-bottom border-secondary bg-light-subtle"
                        id="filter-row-{{ $id }}" style="border-width: 1px !important;">
                        <div class="p-3">
                            {{ $filter }}
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" style="margin: 0 !important;">
                        <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th width="{{ $column['width'] ?? 'auto' }}">
                                        {{ $column['title'] ?? __('translate.' . $column['data']) }}</th>
                                @endforeach
                                <th width="80px">{{ __('translate.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center flex-column gap-3 gap-sm-0 flex-sm-row">
                        <div class="me-sm-3">
                            <label class="form-label m-0 d-flex gap-2">
                                @lang('translate.show')
                                <select name="datatable_length" aria-controls="datatable-{{ $id }}"
                                    class="form-select form-select-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                @lang('translate.entries')
                            </label>
                        </div>
                        <p class="m-0 text-secondary" id="showing-entries-{{ $id }}"></p>
                        <ul class="pagination m-0 ms-sm-auto" id="custom-pagination-{{ $id }}"></ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@php
    $dataTableTranslations = [
        'show' => __('translate.show'),
        'entries' => __('translate.entries'),
        'prev' => __('translate.prev'),
        'next' => __('translate.next'),
        'showing' => __('translate.showing'),
        'to' => __('translate.to'),
        'of' => __('translate.of'),
        'no_data' => __('translate.no_data'),
        'loading' => __('translate.loading'),
        'processing' => __('translate.processing'),
        'search' => __('translate.search'),
        'zero_records' => __('translate.zero_records'),
    ];
@endphp
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const translations = @json($dataTableTranslations);

            let tableId = @json($id);
            let datatableUrl = @json($route);
            let columns = @json($columns);


            let table = $('#datatable').DataTable({
                dom: "tiplr",
                serverSide: true,
                processing: true,
                paging: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                language: {
                    "url": $('#importLangLocal').attr('data-LangLocal'),
                    "lengthMenu": translations.show + " _MENU_ " + translations.entries,
                    "emptyTable": translations.no_data,
                    "loadingRecords": translations.loading,
                    "processing": translations.processing,
                    "search": "_INPUT_",
                    "searchPlaceholder": translations.search,
                    "zeroRecords": translations.zero_records
                },
                ajax: {
                    url: datatableUrl,
                    data: function(d) {
                        var form = document.getElementById('filter-form-' + tableId);
                        if (form) {
                            var fd = new FormData(form);
                            fd.forEach(function(value, key) {
                                if (value) d[key] = value;
                            });
                        }
                    }
                },
                columns: columns.map(column => {
                    return {
                        data: column.data,
                        name: column.name,
                        title: column.title,
                    };
                }).concat([{
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }]),
                responsive: true,
                autoWidth: false,
                order: [
                    [columns.length - 1, 'desc']
                ],
                drawCallback: function(settings) {
                    updatePagination();
                    updateShowingEntries();
                    $('select[name="datatable_length"]').val(table.page.len());
                },
                initComplete: function() {
                    $('.dataTables_paginate').hide();
                    $('.dataTables_length').hide();
                    $('.dataTables_filter').hide();
                }
            });

            $('select[name="datatable_length"]').on('change', function() {
                table.page.len($(this).val()).draw();
            });

            function updateShowingEntries() {
                let info = table.page.info();
                let text =
                    `${translations.showing} <span>${info.start + 1}</span> ${translations.to} <span>${info.end}</span> ${translations.of} <span>${info.recordsTotal}</span> ${translations.entries}`;
                $('#showing-entries-' + tableId).html(text);
            }

            function updatePagination() {
                let pagination = $('#custom-pagination-' + tableId);
                pagination.empty();

                let pageInfo = table.page.info();
                let maxVisiblePages = 5;

                // زر السابق
                pagination.append(`
                    <li class="page-item ${pageInfo.page === 0 ? 'disabled' : ''}">
                        <a class="page-link prev-page" href="#" tabindex="-1" aria-disabled="true">
                            @if (app()->getLocale() == 'ar')
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>                          
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 6l-6 6l6 6"></path>
                                </svg>
                            @endif
                            <span class="d-none d-sm-inline">${translations.prev}</span>
                        </a>
                    </li>
                `);

                // أرقام الصفحات
                let startPage = Math.max(0, pageInfo.page - 2);
                let endPage = Math.min(pageInfo.pages, pageInfo.page + 3);

                if (startPage > 0) {
                    pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="0">1</a>
                    </li>
                    ${startPage > 1 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
                `);
                }

                for (let i = startPage; i < endPage; i++) {
                    pagination.append(`
                    <li class="page-item ${i === pageInfo.page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i + 1}</a>
                    </li>
                `);
                }

                if (endPage < pageInfo.pages) {
                    pagination.append(`
                    ${endPage < pageInfo.pages - 1 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="${pageInfo.pages - 1}">${pageInfo.pages}</a>
                    </li>
                `);
                }

                // زر التالي
                pagination.append(`
                <li class="page-item ${pageInfo.page >= pageInfo.pages - 1 ? 'disabled' : ''}">
                    <a class="page-link next-page" href="#">
                        <span class="d-none d-sm-inline">${translations.next}</span>
                        @if (app()->getLocale() == 'ar')
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 6l-6 6l6 6"></path>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 6l6 6l-6 6"></path>
                            </svg>
                        @endif
                    </a>
                </li>
            `);

                // معالج الأحداث
                pagination.off('click', 'a').on('click', 'a', function(e) {
                    e.preventDefault();
                    if ($(this).parent().hasClass('disabled')) return;

                    let page = $(this).data('page');
                    if (typeof page !== 'undefined') {
                        table.page(page).draw('page');
                    } else if ($(this).hasClass('prev-page')) {
                        table.page('previous').draw('page');
                    } else if ($(this).hasClass('next-page')) {
                        table.page('next').draw('page');
                    }

                    $('html, body').animate({
                        scrollTop: $('.card').offset().top
                    }, 100);
                });
            }

            $('#search-table-' + tableId).on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
