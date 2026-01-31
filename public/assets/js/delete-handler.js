function sweetAlertDelete(url, table = null, translations) {
    Swal.fire({
        title: translations.are_you_sure,
        text: translations.cannot_restore,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: translations.yes_delete,
        cancelButtonText: translations.cancel
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire(
                            translations.deleted,
                            translations.deleted_successfully,
                            'success'
                        );
                        
                        if (table) {
                            table.ajax.reload(null, false); 
                        }
                    } else {
                        Swal.fire(
                            translations.error,
                            response.message || translations.something_went_wrong,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        translations.error,
                        translations.server_error,
                        'error'
                    );
                    console.error('Error details:', {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });
                }
            });
        }
    });
}