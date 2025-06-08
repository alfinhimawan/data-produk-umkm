const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
    inp.addEventListener("focus", () => {
        inp.classList.add("active");
    });
    inp.addEventListener("blur", () => {
        if (inp.value != "") return;
        inp.classList.remove("active");
    });
});

toggle_btn.forEach((btn) => {
    btn.addEventListener("click", () => {
        main.classList.toggle("sign-up-mode");
    });
});

function moveSlider() {
    let index = this.dataset.value;

    let currentImage = document.querySelector(`.img-${index}`);
    images.forEach((img) => img.classList.remove("show"));
    currentImage.classList.add("show");

    const textSlider = document.querySelector(".text-group");
    textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

    bullets.forEach((bull) => bull.classList.remove("active"));
    this.classList.add("active");
}

bullets.forEach((bullet) => {
    bullet.addEventListener("click", moveSlider);
});

function togglePasswordVisibility() {
    const input = document.getElementById("login-password");
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

// Toastr notification for auth (login, verification, etc)
document.addEventListener('DOMContentLoaded', function() {
    var alertDiv = document.getElementById('auth-alert');
    if (alertDiv) {
        var type = alertDiv.getAttribute('data-type');
        var message = alertDiv.getAttribute('data-message');
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: true,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "4000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        if(type === 'success') {
            toastr.success(message);
        } else if(type === 'error') {
            toastr.error(message);
        } else if(type === 'info') {
            toastr.info(message);
        } else if(type === 'warning') {
            toastr.warning(message);
        }
    }
});

VANTA.WAVES({
    el: "#vanta-bg",
    color: 0x375a7f,
    shininess: 50,
    waveHeight: 20,
    waveSpeed: 0.7,
    zoom: 1.1,
    backgroundColor: 0xe3ecfa,
});
