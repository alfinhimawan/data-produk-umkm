$(document).ready(function() {
    $('#tabel-produk-owner').DataTable();

    $('#modalTambahProduk').on('show.bs.modal', function () {
        $('#formTambahProduk')[0]?.reset();
        $('#preview-img-produk').attr('src', '/img/default-produk.png');
        $('.custom-file-label[for="foto"]').text('Pilih foto...');
    });

    $('.btn-edit-produk').on('click', function () {
        var row = $(this).closest('tr');
        var id = $(this).data('id');
        var nama = row.find('td').eq(1).text().trim();
        var kategori = row.find('td').eq(2).data('id') || '';
        var harga = row.find('td').eq(4).text().replace(/[^\d]/g, '');
        var foto = row.find('img').attr('src');
        var deskripsi = row.data('deskripsi') || '';
        $('#edit_nama_produk').val(nama);
        $('#edit_id_kategori').val(kategori);
        $('#edit_harga').val(harga);
        $('#preview-img-edit-produk').attr('src', foto);
        $('#edit_deskripsi').val(deskripsi);
        // Set form action for update
        $('#formEditProduk').attr('action', '/owner/products/' + id);
    });

    $('.btn-hapus-produk').on('click', function (e) {
        // Confirm before submit
        var form = $(this).closest('form');
        if (!confirm('Hapus produk ini?')) {
            e.preventDefault();
        }
    });
});
