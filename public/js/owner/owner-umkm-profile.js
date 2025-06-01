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
});

window.previewLogoUMKM = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById("preview-img-umkm").src = URL.createObjectURL(file);
        const label = document.querySelector('label[for="edit_logo"].custom-file-label');
        if (label) label.textContent = file.name;
    }
};
