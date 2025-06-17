<?php
session_start();
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  echo "<script>window.location.href='login.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <style>
    :root {
      --color-bg1: #0f2027;
      --color-bg2: #203a43;
      --color1: 102, 126, 234;
      --color2: 118, 75, 162;
      --color3: 88, 180, 255;
      --circle-size: 70%;
      --blending: overlay;
    }

    html, body {
      height: 100%;
      width: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 0;
    }

    .gradient-bg {
      position: fixed;
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
      background: linear-gradient(-45deg, var(--color-bg1), var(--color-bg2));
      background-size: 400% 400%;
      animation: gradientMove 20s ease infinite;
      z-index: -2;
    }

    .gradients-container {
      position: fixed;
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
      filter: url(#goo) blur(40px);
      z-index: -1;
    }

    .g {
      position: absolute;
      mix-blend-mode: var(--blending);
      width: var(--circle-size);
      height: var(--circle-size);
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 50%;
      animation: spin 40s linear infinite;
      background: radial-gradient(circle at center, rgba(var(--color1), 0.8) 0, rgba(var(--color1), 0) 50%);
    }

    .g2 {
      background: radial-gradient(circle at center, rgba(var(--color2), 0.7) 0, rgba(var(--color2), 0) 50%);
      animation: spin 60s linear reverse infinite;
    }

    .g3 {
      background: radial-gradient(circle at center, rgba(var(--color3), 0.7) 0, rgba(var(--color3), 0) 50%);
      animation: spin 50s ease-in-out infinite;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes spin {
      0% { transform: rotate(0deg) translate(-50%, -50%); }
      100% { transform: rotate(360deg) translate(-50%, -50%); }
    }

    .popup {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
      text-align: center;
      max-width: 400px;
      width: 90%;
      z-index: 1;
      position: relative;
    }

    .popup h2 {
      margin-bottom: 15px;
      color: #333;
    }

    .popup p {
      color: #555;
      margin-bottom: 25px;
    }

    .btn {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      margin: 0 10px;
      font-size: 14px;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: #e0e0e0;
      color: #333;
    }

    .btn-secondary:hover {
      background: #d6d6d6;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
  <div class="gradient-bg"></div>
  <div class="gradients-container">
    <div class="g g1"></div>
    <div class="g g2"></div>
    <div class="g g3"></div>
  </div>

  <div class="popup">
    <h2>Konfirmasi Logout</h2>
    <p>Apakah Anda yakin ingin keluar dari sistem?</p>
    <form method="post">
      <button type="submit" name="logout" class="btn">Ya, Logout</button>
      <button type="button" onclick="window.history.back()" class="btn btn-secondary">Batal</button>
    </form>
  </div>

  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: none;">
    <defs>
      <filter id="goo">
        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
        <feColorMatrix in="blur" mode="matrix"
          values="1 0 0 0 0  
                  0 1 0 0 0  
                  0 0 1 0 0  
                  0 0 0 20 -10" result="goo" />
        <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
      </filter>
    </defs>
  </svg>
</body>
</html>