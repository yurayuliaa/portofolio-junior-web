$(document).ready(function () {
    // 1. Inisialisasi DataTables dengan Bahasa Indonesia
    if ($('#tabelPendaftar').length) {
        $('#tabelPendaftar').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
            },
            order: [[0, 'desc']]
        });
    }

    // 2. SweetAlert2 Toast Notifikasi Flash
    const pesan = $('#flash').data('pesan');
    if (pesan) {
        Swal.fire({
            icon: 'success',
            title: pesan,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }

    // 3. SweetAlert2 Konfirmasi Hapus Data
    $(document).on('submit', '.form-hapus', function (e) {
        e.preventDefault();
        const form = this;
        const nama = $(form).data('nama') || 'data ini';

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `Data pendaftar "${nama}" akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

/**
 * Menampilkan notifikasi toast SweetAlert2 dari pesan flash server.
 *
 * @param {HTMLElement} flash - Elemen DOM yang membawa atribut data-pesan.
 * @returns {void}
 */
function tampilkanFlash(flash) {
    if (!flash || !flash.dataset.pesan) return;
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: flash.dataset.pesan,
        showConfirmButton: false,
        timer: 3000
    });
}

/**
 * Memasang dialog konfirmasi SweetAlert2 pada tombol/form hapus data.
 *
 * @returns {void}
 */
function pasangKonfirmasiHapus() {
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pendaftar akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const flashElement = document.getElementById('flash');
    if (flashElement) {
        tampilkanFlash(flashElement);
    }
    pasangKonfirmasiHapus();
});