<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/login.css" />
    <title>Login - Sistem Inventaris Lab</title>
</head>
<body>
    <div class="login-container">
      <div class="logo-container">
        <img src="assets/logo.jpeg" alt = "logo" width="100" height="auto">
       </div>
        <h2>Login</h2>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Masuk</button>
            <div class="error" id="login-error">Login gagal. Periksa kembali username dan password Anda.</div>
        </form>
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
                window.location.href = 'dashboard.php';
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
