$(document).ready(function () {
    $(".table").DataTable();
    $(document).on("click", ".btn-edit-kategori", function () {
        var id = $(this).attr("data-id");
        if (!id) {
            alert('ID kategori tidak ditemukan! Cek data-id pada tombol edit.');
            return;
        }
        var nama = $(this).data("nama");
        $("#edit_nama_kategori").val(nama);
        var url = "/admin/categories/" + id;
        $("#formEditKategori").attr("action", url);
    });

    $(document).on('submit', 'form[action*="categories"][method="POST"]', function (e) {
        var form = this;
        if ($(form).find('input[name="_method"]').val() === "DELETE") {
            e.preventDefault();
            Swal.fire({
                title: "Yakin hapus kategori?",
                text: "Data kategori akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

    $('#modalTambahKategori').on('show.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });

    setTimeout(function () {
        $(".alert").alert("close");
    }, 2500);
});
