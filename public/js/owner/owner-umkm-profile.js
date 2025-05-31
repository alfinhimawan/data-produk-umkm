$(document).ready(function () {
    $('#modalEditUMKM').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#preview-img-umkm').attr('src', '/img/default-umkm.png');
        $(this).find('.custom-file-label').text('Pilih foto...');
    });

    $('#modalEditUMKM').on('show.bs.modal', function () {
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });
});
