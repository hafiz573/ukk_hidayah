<?php
session_start(); // WAJIB di atas
include 'backend/config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Ambil user dari database
    $query = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Simpan ke session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role']; // Pastikan kolom 'role' ada di tabel users

        echo "<script>alert('Login berhasil!'); window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - SI-KAMPUNG JOS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: "Roboto", sans-serif;
    }
    .login-container {
      max-width: 400px;
      background: #fff;
      padding: 30px;
      margin: 80px auto;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    .login-container img {
      width: 150px; /* logo diperbesar */
      margin-bottom: 20px;
    }
    .login-container h4 {
      margin-bottom: 25px;
      font-weight: 500;
    }
    .form-control {
      padding: 10px;
    }
    .btn-primary {
      width: 100%;
      padding: 10px;
    }
    .footer-text {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Logo -->
    <img src="backend/cssadmin/logodepan.jpg" alt="Logo SI-KAMPUNG JOS">

    <!-- Judul -->
    <h4>Silahkan Login</h4>

    <!-- Form Login -->
    <form action="" method="post">
      <div class="mb-3">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="mb-3 text-start">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>
  </div>

  <!-- Footer -->
  <div class="footer-text">
    <p>&copy; 2025 SI-KAMPUNG JOS. All rights reserved.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
