<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Selamat datang di PDF!</h1><p>Berhasil dengan mPDF</p>');
$mpdf->Output();