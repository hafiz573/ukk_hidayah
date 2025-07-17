<?php
include 'backend/config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_nik = mysqli_real_escape_string($connect, $_POST['id_nik']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // cek apakah id_nik sudah ada di warga
        $cek = mysqli_query($connect, "SELECT id_nik FROM warga WHERE id_nik='$id_nik'");
        if (mysqli_num_rows($cek) == 0) {
            // kalau belum ada → otomatis tambahkan ke warga
            mysqli_query($connect, "INSERT INTO warga (id_nik, nama) VALUES ('$id_nik', '$username')");
        }

        // baru insert ke users
        $query = "INSERT INTO users (id_nik, username, password) VALUES ('$id_nik', '$username', '$password')";
        if (mysqli_query($connect, $query)) {
            echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <!-- Input NIK manual -->
            <div class="mb-3">
                <label for="id_nik" class="form-label">NIK (sudah terdaftar di tabel Warga)</label>
                <input type="text" class="form-control" id="id_nik" name="id_nik" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
