@php
    $deleteModalTranslations = [
        'are_you_sure' => __('translate.are_you_sure'),
        'cannot_restore' => __('translate.cannot_restore'),
        'yes_delete' => __('translate.yes_delete'),
        'cancel' => __('translate.cancel'),
        'deleted' => __('translate.deleted'),
        'deleted_successfully' => __('translate.deleted_successfully'),
        'error' => __('translate.error'),
        'something_went_wrong' => __('translate.something_went_wrong'),
        'server_error' => __('translate.server_error'),
    ];
@endphp
<script>
(function() {
    var t = @json($deleteModalTranslations);
    window.sweetAlertDelete = function(url, table) {
        if (typeof Swal === 'undefined') { alert(t.are_you_sure); return; }
        Swal.fire({
            title: t.are_you_sure,
            text: t.cannot_restore,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: t.yes_delete,
            cancelButtonText: t.cancel
        }).then(function(result) {
            if (result.isConfirmed && url) {
                var token = document.querySelector('meta[name="csrf-token"]');
                var csrf = token ? token.getAttribute('content') : '';
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(function(r) { return r.json(); }).then(function(data) {
                    if (data && data.status) {
                        Swal.fire(t.deleted, t.deleted_successfully, 'success');
                        if (table && typeof table.ajax !== 'undefined') table.ajax.reload(null, false);
                    } else {
                        Swal.fire(t.error, (data && data.message) || t.something_went_wrong, 'error');
                    }
                }).catch(function() {
                    Swal.fire(t.error, t.server_error, 'error');
                });
            }
        });
    };
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('.delete-btn');
            if (!btn) return;
            e.preventDefault();
            e.stopPropagation();
            var url = btn.getAttribute('data-url');
            if (!url) return;
            var table = null;
            try {
                if (typeof jQuery !== 'undefined' && jQuery.fn.DataTable && jQuery('#datatable').length && jQuery.fn.DataTable.isDataTable('#datatable')) {
                    table = jQuery('#datatable').DataTable();
                }
            } catch (err) {}
            window.sweetAlertDelete(url, table);
        });
    });
})();
</script>
