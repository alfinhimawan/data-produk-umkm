function previewFoto(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById("preview-img").src = URL.createObjectURL(file);
        const label = document.querySelector(
            'label[for="foto"].custom-file-label'
        );
        if (label) label.textContent = file.name;
    }
}
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("togglePasswordIcon");
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
function toggleStatusDropdown() {
    var role = document.getElementById("role").value;
    var status = document.getElementById("status");
    if (role === "admin" || role === "umkm_owner") {
        status.value = "aktif";
        status.disabled = true;
    } else {
        status.value = "";
        status.disabled = true;
    }
}
function previewEditFoto(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById("edit-preview-img").src =
            URL.createObjectURL(file);
        const label = document.querySelector(
            'label[for="edit_foto"].custom-file-label'
        );
        if (label) label.textContent = file.name;
    }
}
function toggleEditPassword() {
    const input = document.getElementById("edit_password");
    const icon = document.getElementById("toggleEditPasswordIcon");
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
function toggleEditStatusDropdown() {
    var role = document.getElementById("edit_role").value;
    var status = document.getElementById("edit_status");
    if (role === "umkm_owner") {
        status.disabled = false;
    } else if (role === "admin") {
        status.value = "aktif";
        status.disabled = true;
    } else {
        status.value = "";
        status.disabled = true;
    }
}
$(document).ready(function () {
    $(".table").DataTable();
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).next(".custom-file-label").addClass("selected").html(fileName);
    });
    $(".btn-edit-user").on("click", function () {
        var user = $(this).data("user");
        $("#modalEditUser #id_users").val(user.id_users);
        $("#modalEditUser #name").val(user.name);
        $("#modalEditUser #email").val(user.email);
        $("#modalEditUser #role").val(user.role).change();
        $("#modalEditUser #status").val(user.status);
        $("#modalEditUser #preview-img").attr(
            "src",
            user.foto ? "/" + user.foto : "/img/default-user.png"
        );
        if (user.role === "admin") {
            $("#modalEditUser #edit_role").prop("disabled", true);
            $("#modalEditUser #edit_status")
                .val("aktif")
                .prop("disabled", true);
        } else {
            $("#modalEditUser #edit_role").prop("disabled", false);
            $("#modalEditUser #edit_status").prop("disabled", false);
        }
        $("#modalEditUser").modal("show");
    });
    const editButtons = document.querySelectorAll(".btn-edit-user");
    editButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const user = JSON.parse(this.getAttribute("data-user"));
            document.getElementById("edit_user_id").value = user.id_users;
            document.getElementById("edit_nama").value = user.name || '';
            document.getElementById("edit_email").value = user.email || '';
            document.getElementById("edit_role").value = user.role || '';
            document.getElementById("edit_status").value = user.status || '';
            document.getElementById("edit-preview-img").src = user.foto
                ? "/" + user.foto
                : "/img/default-user.png";
            document.getElementById("formEditUser").action =
                "/admin/users/" + user.id_users;
            if (user.role === "admin") {
                document.getElementById("edit_role").disabled = true;
                document.getElementById("edit_status").value = "aktif";
                document.getElementById("edit_status").disabled = true;
            } else {
                document.getElementById("edit_role").disabled = false;
                document.getElementById("edit_status").disabled = false;
            }
        });
    });

    $(document).on('submit', 'form.form-hapus-user', function (e) {
        var form = this;
        if ($(form).find('input[name="_method"]').val() === "DELETE") {
            e.preventDefault();
            Swal.fire({
                title: "Yakin hapus user?",
                text: "Data user akan dihapus permanen!",
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

    $("#modalTambahUser").on("show.bs.modal", function () {
        $(this).find("form")[0].reset();
        $(this).find(".is-invalid").removeClass("is-invalid");
        $(this).find(".invalid-feedback").remove();
    });

    setTimeout(function () {
        $(".alert").alert("close");
    }, 2500);
});
