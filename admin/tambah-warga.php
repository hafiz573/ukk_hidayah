<?php
include '../backend/config/connect.php';

if(isset($_POST['simpan'])){
    $id_nik         = mysqli_real_escape_string($connect, $_POST['id_nik']);
    $nomor_kk       = mysqli_real_escape_string($connect, $_POST['nomor_kk']);
    $nama           = mysqli_real_escape_string($connect, $_POST['nama']);
    $alamat         = mysqli_real_escape_string($connect, $_POST['alamat']);
    $pekerjaan      = mysqli_real_escape_string($connect, $_POST['pekerjaan']);
    $status_keluarga= mysqli_real_escape_string($connect, $_POST['status_keluarga']);
    
    // Proses upload foto
    $foto_name = "";
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name = $id_nik."_".time().".".$ext;
        $upload_dir = "assets/img/foto_warga/".$foto_name;
        move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir);
    }

    // Simpan ke DB
    $sql = "INSERT INTO warga (id_nik, nomor_kk, nama, alamat, pekerjaan, status_keluarga, foto)
            VALUES ('$id_nik', '$nomor_kk', '$nama', '$alamat', '$pekerjaan', '$status_keluarga', '$foto_name')";

    if(mysqli_query($connect, $sql)){
        echo "<script>alert('Data warga berhasil ditambahkan!'); window.location='data-warga.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: ".mysqli_error($connect)."');</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Warga</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="p-4 text-center border-b border-gray-700">
      <h2 class="text-lg font-bold">Menu</h2>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="data-warga.php" class="block py-2 px-3 rounded hover:bg-gray-700">📋 Data Warga</a>
      <a href="data-kas.php" class="block py-2 px-3 rounded hover:bg-gray-700">💰 Data Kas</a>
        <a href="tambah-kas.php" class="block py-2 px-3 rounded hover:bg-gray-700">➕ Tambah Data Kas</a>
      <a href="tambah-warga.php" class="block py-2 px-3 rounded hover:bg-gray-700">➕ Tambah Warga</a>
      <a href="logout.php" class="block py-2 px-3 rounded hover:bg-red-600 mt-4">🚪 Keluar</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Tambah Data Warga</h1>
    </header>

    <!-- Form Input -->
    <main class="p-6 overflow-auto">
      <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-3xl mx-auto">

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold mb-2">NIK</label>
            <input type="text" name="id_nik" class="w-full border rounded px-3 py-2" required>
          </div>
          <div>
            <label class="block font-semibold mb-2">Nomor KK</label>
            <input type="text" name="nomor_kk" class="w-full border rounded px-3 py-2" required>
          </div>
        </div>

        <div class="mt-4">
          <label class="block font-semibold mb-2">Nama Lengkap</label>
          <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mt-4">
          <label class="block font-semibold mb-2">Alamat</label>
          <textarea name="alamat" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
          <div>
            <label class="block font-semibold mb-2">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block font-semibold mb-2">Status Keluarga</label>
            <input type="text" name="status_keluarga" class="w-full border rounded px-3 py-2">
          </div>
        </div>

        <div class="mt-4">
          <label class="block font-semibold mb-2">Foto Warga</label>
          <input type="file" name="foto" class="w-full border rounded px-3 py-2" accept="image/*">
        </div>

        <!-- Tombol -->
        <div class="mt-6 flex gap-4">
          <button type="submit" name="simpan" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Simpan</button>
          <a href="data-warga.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅ Kembali</a>
        </div>

      </form>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-3">
      © 2025 | SI-KAMPUNG JOS - dibuat oleh Hafiz
    </footer>
  </div>
</div>

</body>
</html>
