<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
  'tempDir' => __DIR__ . '/tmp'
]);
$mpdf->SetTitle('Laporan Peminjaman');

$html = '
<h2 style="text-align:center;">Laporan Peminjaman Barang</h2>
<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <thead>
    <tr style="background-color:#f5f5f5;">
      <th>ID Pinjam</th>
      <th>Nama Peminjam</th>
      <th>Nama Barang</th>
      <th>Tanggal Pinjam</th>
    </tr>
  </thead>
  <tbody>';

$data = $koneksi->query("
  SELECT P.IDPINJAM, U.NAMAUSER, B.NAMABARANG, P.TANGGALPINJAM
  FROM PEMINJAMAN P
  JOIN USERS U ON P.IDUSER = U.IDUSER
  LEFT JOIN BARANG B ON B.IDPINJAM = P.IDPINJAM
  ORDER BY P.TANGGALPINJAM DESC
");

while ($row = $data->fetch_assoc()) {
  $html .= '
    <tr>
      <td>' . $row['IDPINJAM'] . '</td>
      <td>' . $row['NAMAUSER'] . '</td>
      <td>' . $row['NAMABARANG'] . '</td>
      <td>' . $row['TANGGALPINJAM'] . '</td>
    </tr>';
}

$html .= '</tbody></table>';

$mpdf->WriteHTML($html);
$mpdf->Output('Laporan_Peminjaman.pdf', \Mpdf\Output\Destination::DOWNLOAD);