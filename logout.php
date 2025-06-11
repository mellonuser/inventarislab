<?php
session_start();
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  echo "<script>window.location.href='index.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/logout.css" />
  <title>Logout</title>
</head>
<body>
  <div class="popup">
    <h2>Konfirmasi Logout</h2>
    <p>Apakah Anda yakin ingin keluar dari sistem?</p>
    <form method="post">
      <button type="submit" name="logout" class="btn">Ya, Logout</button>
      <button type="button" onclick="window.history.back()" class="btn btn-secondary">Batal</button>
    </form>
  </div>
</body>
</html>
