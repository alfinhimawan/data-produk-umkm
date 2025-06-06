$(document).ready(function () {
    $("#tabel-produk-owner").DataTable();

    $("#modalTambahProduk").on("show.bs.modal", function () {
        $("#formTambahProduk")[0]?.reset();
        $("#preview-img-produk").attr("src", "/img/default-produk.png");
        $('.custom-file-label[for="foto"]').text("Pilih foto...");
    });

    $(".btn-edit-produk").on("click", function () {
        var row = $(this).closest("tr");
        var id = $(this).data("id");
        var nama = row.find("td").eq(1).text().trim();
        var kategori = row.find("td").eq(2).data("id") || "";
        var harga = row.find("td").eq(4).text().replace(/[^\d]/g, "");
        var stock = row.find("td").eq(5).text().trim();
        var foto = row.find("img").attr("src");
        var deskripsi = row.data("deskripsi") || "";
        $("#edit_nama_produk").val(nama);
        $("#edit_id_kategori").val(kategori);
        $("#edit_harga").val(harga);
        $("#edit_stock").val(stock);
        $("#preview-img-edit-produk").attr("src", foto);
        $("#edit_deskripsi").val(deskripsi);
        $("#formEditProduk").attr("action", "/owner/products/" + id);
    });

    $(".btn-hapus-produk").on("click", function (e) {
        e.preventDefault();
        var form = $(this).closest("form");
        Swal.fire({
            title: "Hapus Produk?",
            text: "Data produk akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    window.previewFotoProduk = function (event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById("preview-img-produk").src =
                URL.createObjectURL(file);
            const label = document.querySelector(
                'label[for="foto"].custom-file-label'
            );
            if (label) label.textContent = file.name;
        }
    };

    window.previewEditFotoProduk = function (event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById("preview-img-edit-produk").src =
                URL.createObjectURL(file);
            const label = document.querySelector(
                'label[for="edit_foto"].custom-file-label'
            );
            if (label) label.textContent = file.name;
        }
    };

    setTimeout(function () {
        $(".alert").alert("close");
    }, 3500);

    var alertBox = document.getElementById("auth-alert");
    if (alertBox && window.Swal) {
        var type = alertBox.dataset.type;
        var message = alertBox.dataset.message;
        if (type && message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 1800,
            });
        }
    }
});
