@extends('dashboard.layouts.master')
@section('title', __('translate.roles'))
@section('header', __('translate.roles'))
@section('roles', 'show')
@section('breadcrumbs', Breadcrumbs::render('roles'))
@section('content')
    <div class="box-shadow mb-30 pd-15">
        <div class="row">
            <div class="col-md-10">
                <div class="pd-15">
                    <input type="text" class="form-control searchEmail" id="search-table" placeholder="{{ __('translate.search') }}"
                        aria-controls="datatable">
                </div>
            </div>
            @can('role-create')
                <div class="col-md-2 text-end">
                    <div class="pd-15">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary w-100"> @lang('translate.new_role') </a>
                    </div>
                </div>
            @endcan
            <div class="col-12">
                <div class="table-responsive datatable mb-30">
                    <table class="table" id="datatable">
                        <thead class="table-header">
                            <tr>
                                <th> @lang('translate.name') </th>
                                <th> @lang('translate.creation_date') </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let datatableUrl = '{{ route('roles.data') }}';
    </script>
    <script>
        let table = $('#datatable').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            info: false,
            "language": {
                "url": $('#importLangLocal').attr('data-LangLocal'),
            },
            ajax: {
                url: datatableUrl,
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    sortable: false
                },
            ],
            drawCallback: function(settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#search-table').on('keyup', function() {
            table.search(this.value).draw();
        });
    </script>
@endpush
