<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Inventaris Lab Komputer</title>
  <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-bg1: #0f2027;
      --color-bg2: #203a43;
      --color1: 102, 126, 234;
      --color2: 118, 75, 162;
      --color3: 88, 180, 255;
      --color4: 29, 0, 221;
      --color5: 35, 50, 100;
      --color-interactive: 70, 70, 255;
      --circle-size: 70%;
      --blending: overlay;
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      font-family: 'Dongle', sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
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

    body {
        font-family: 'Dongle', sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }


    
    .gradient-bg {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(-45deg, var(--color-bg1), var(--color-bg2));
      background-size: 400% 400%;
      animation: gradientMove 20s ease infinite;
      overflow: hidden;
      z-index: -2;
    }

    .gradients-container {
      filter: url(#goo) blur(40px);
      width: 100%;
      height: 100%;
      position: absolute;
    }

    .g {
      position: absolute;
      mix-blend-mode: var(--blending);
      background: radial-gradient(circle at center, rgba(var(--color1), 0.8) 0, rgba(var(--color1), 0) 50%);
      width: var(--circle-size);
      height: var(--circle-size);
      top: 40%;
      left: 50%;
      transform-origin: center;
      animation: spin 40s linear infinite;
      opacity: 1;
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

    .login-wrapper {
      position: relative;
      z-index: 1;
      display: flex;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
      margin: center;
      animation: fadeIn 0.6s ease;
    }

    .left-panel {
      flex: 1;
      background: url('assets/images/left.jpg') center center / cover no-repeat;
      position: relative;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }

    .left-panel::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
    }

    .left-panel h3, .left-panel p {
      position: relative;
      z-index: 1;
    }

    .right-panel {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.95);
      transition: background 0.3s ease;
    }

    .right-panel:hover {
      background-color: rgba(255, 255, 255, 1);
    }

    .right-panel img {
      width: 80px;
      margin: 0 auto 20px;
    }

    .right-panel h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #667eea;
      box-shadow: 0 0 8px rgba(102, 126, 234, 0.4);
      outline: none;
    }

    button {
      width: 100%;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(102, 126, 234, 0.5);
      opacity: 0.95;
    }

    .error {
      color: red;
      margin-top: 10px;
      text-align: center;
      display: none;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.98); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <div class="gradient-bg">
    <svg>
      <filter id="goo"><feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/><feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 20 -10" result="goo"/><feBlend in="SourceGraphic" in2="goo"/></filter>
    </svg>
    <div class="gradients-container">
      <div class="g"></div>
      <div class="g g2"></div>
      <div class="g g3"></div>
    </div>
  </div>

  <div class="login-wrapper">
    <div class="left-panel">
      <h3>SELAMAT DATANG</h3>
      <p>Sistem Inventaris Laboratorium Komputer</p>
    </div>
    <div class="right-panel">
      <img src="./assets/images/logo.jpg" alt="Logo Lab">
      <h2>Silakan Login</h2>
      <form>
        <div class="form-group">
          <label for="username">Akun Pengguna</label>
          <input type="text" id="username" name="username" placeholder="Masukkan Akun Pengguna" required>
        </div>
        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
        </div>
        <button type="submit">Masuk</button>
        <div class="error" id="login-error">Login gagal. Periksa kembali username dan password Anda.</div>
      </form>
    </div>
  </div>

  <script>
    document.querySelector('form').addEventListener('submit', async function(e) {
      e.preventDefault();

      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      const errorDiv = document.getElementById('login-error');
      errorDiv.style.display = 'none';

      try {
        const response = await fetch('api/authAPI.php?action=login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ username, password })
        });

        const result = await response.json();

        if (result.success) {
          if (result.role === 'admin') {
            window.location.href = 'dashboard.php';
          } else {
            window.location.href = 'dashboardUser.php';
          }
        } else {
          errorDiv.textContent = result.message;
          errorDiv.style.display = 'block';
        }
      } catch (err) {
        console.error('Login error:', err);
        errorDiv.textContent = 'Terjadi kesalahan saat login';
        errorDiv.style.display = 'block';
      }
    });
  </script>
</body>
</html>
