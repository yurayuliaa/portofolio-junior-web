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