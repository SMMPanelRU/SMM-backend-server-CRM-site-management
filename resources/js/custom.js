import flatpickr from 'flatpickr';
import Swal from "sweetalert2/src/sweetalert2";

window.onload = function () {
    flatpickr(".datepicker");
    flatpickr(".datepicker-range", {
        mode: "range"
    });

    document.getElementById('navbar-toggle').addEventListener( 'click', function()
    {
        document.getElementById('bottom-navbar').classList.toggle('header-toggled')
    });
};

window.addEventListener('toast', event => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
    });

    Toast.fire({
        icon: event.detail.type,
        title: event.detail.message
    })
})
