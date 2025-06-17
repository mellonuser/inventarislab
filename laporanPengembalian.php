<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
  'tempDir' => __DIR__ . '/tmp'
]);
$mpdf->SetTitle('Laporan Pengembalian');

$html = '
<h2 style="text-align:center;">Laporan Pengembalian Barang</h2>
<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <thead>
    <tr style="background-color:#f5f5f5;">
      <th>ID Kembali</th>
      <th>Nama Peminjam</th>
      <th>Nama Barang</th>
      <th>Tanggal Kembali</th>
    </tr>
  </thead>
  <tbody>';

$data = $koneksi->query("
  SELECT K.IDKEMBALI, U.NAMAUSER,
    (SELECT NAMABARANG FROM BARANG WHERE IDPINJAM = K.IDPINJAM LIMIT 1) AS NAMABARANG,
    K.TANGGALKEMBALI
  FROM PENGEMBALIAN K
  JOIN PEMINJAMAN P ON K.IDPINJAM = P.IDPINJAM
  JOIN USERS U ON P.IDUSER = U.IDUSER
  ORDER BY K.TANGGALKEMBALI DESC
");

while ($row = $data->fetch_assoc()) {
  $html .= '
    <tr>
      <td>' . $row['IDKEMBALI'] . '</td>
      <td>' . $row['NAMAUSER'] . '</td>
      <td>' . $row['NAMABARANG'] . '</td>
      <td>' . $row['TANGGALKEMBALI'] . '</td>
    </tr>';
}

$html .= '</tbody></table>';

$mpdf->WriteHTML($html);
$mpdf->Output('Laporan_Pengembalian.pdf', \Mpdf\Output\Destination::DOWNLOAD);