$(document).ready(function () {
    $("#modalEditUMKM").on("hidden.bs.modal", function () {
        $(this).find("form")[0].reset();
        // Ambil ulang src logo lama dari data attribute
        var defaultLogo = $("#preview-img-umkm").data("default");
        $("#preview-img-umkm").attr("src", defaultLogo || "/img/default-umkm.png");
        $(this).find(".custom-file-label").text("Pilih foto...");
    });

    $("#modalEditUMKM").on("show.bs.modal", function () {
        $(this).find(".is-invalid").removeClass("is-invalid");
        $(this).find(".invalid-feedback").remove();
    });

    // SweetAlert untuk error, success, warning
    const alertDiv = document.getElementById('auth-alert');
    if (alertDiv) {
        const type = alertDiv.getAttribute('data-type');
        const message = alertDiv.getAttribute('data-message');
        if (type && message) {
            Swal.fire({
                icon: type,
                title: type === 'success' ? 'Berhasil!' : (type === 'warning' ? 'Peringatan!' : 'Gagal!'),
                text: message,
                timer: 2500,
                showConfirmButton: false
            });
        }
    }
});

window.previewLogoUMKM = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById("preview-img-umkm").src = URL.createObjectURL(file);
        const label = document.querySelector('label[for="edit_logo"].custom-file-label');
        if (label) label.textContent = file.name;
    }
};
