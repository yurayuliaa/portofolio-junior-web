<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if ($id === false || $id === null) {
    http_response_code(404);
    exit('Data tidak ditemukan.');
}

$pdo = getConnection();
$data = ambilBuktiPendaftar($pdo, $id);

if ($data === null) {
    http_response_code(404);
    exit('Data tidak ditemukan.');
}

// Format Nomor Bukti: REG-TAHUN-000ID
$noBukti = sprintf('REG-%s-%05d', date('Y', strtotime($data['tgl_daftar'])), $data['id']);

ob_start();
require __DIR__ . '/../templates/bukti.php';
$html = ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', false);
$options->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();

$dompdf->stream('Bukti-Pendaftaran-' . $noBukti . '.pdf', ['Attachment' => false]);