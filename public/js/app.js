$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('body').on('click', '.modal-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').css('display', 'block')
        .text(me.hasClass('edit') ? 'Update' : 'Create');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('body').on('click', '.detail-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').css('display', 'none');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('#modal-btn-save').click(function (event) {
    event.stopImmediatePropagation();

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT';

    form.find('.invalid-feedback').remove();
    form.find('.form-control').removeClass('is-invalid');
    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function (response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('.table').DataTable().ajax.reload();

            Swal.fire({
                title: 'Success !',
                icon: 'success',
                text: method == 'POST' ? 'Data Berhasil Disimpan !' : 'Data Berhasil Diubah !'
            });
        },
        error: function (xhr) {
            var res = xhr.responseJSON;

            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-control')
                        .addClass('is-invalid')
                        .closest('.form-group')
                        .append('<div class="invalid-feedback">' + value + '</div>')
                });
            }
        }
    })
});

$('body').on('click', '.btn-show', function (event) {
    event.stopImmediatePropagation();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').css('display', 'none');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Apakah data ini akan dihapus ' + title + '?',
        text: 'Data akan terhapus selamanya',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('.table').DataTable().ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success !',
                        text: 'Data Berhasil Dihapus!'
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong !'
                    });
                }
            });
        }
    });
});

$('body').on('click', '.hapus-grup', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    Swal.fire({
        title: 'Apakah data ini akan dihapus ' + title + '?',
        text: 'Data akan terhapus selamanya',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'POST',
                },
                success: function (response) {
                    $('.table').DataTable().ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success !',
                        text: 'Data Berhasil Dihapus!'
                    });
                },
                error: function (xhr) {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong !'
                    });
                }
            });
        }
    });
});

$('body').on('click', '.hapus-grup2', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    Swal.fire({
        title: 'Apakah data ini akan dihapus ' + title + '?',
        text: 'Data akan terhapus selamanya',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'POST',
                },
                success: function (response) {
                    $('.table').DataTable().ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success !',
                        text: 'Data Berhasil Dihapus!'
                    });
                },
                error: function (xhr) {
                    console.log(response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong !'
                    });
                }
            });
        }
    });
});
