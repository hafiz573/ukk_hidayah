<?php
include '../backend/config/connect.php';

// Ambil semua data warga
$query = mysqli_query($connect, "SELECT * FROM warga");

$warga = [];
while($row = mysqli_fetch_assoc($query)){
    $warga[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Warga</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="p-4 text-center border-b border-gray-700">
      <h2 class="text-lg font-bold">Menu - Warga</h2>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="data-warga.php" class="block py-2 px-3 rounded bg-gray-700">📋 Data Warga</a>
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
      <h1 class="text-xl font-bold">Data Warga RT 04 / RW 02</h1>
      <img src="backend/cssadmin/logodepan.jpg" alt="Logo RT" class="w-24">
    </header>

    <!-- Table Data -->
    <main class="p-6 overflow-auto">
      <table class="min-w-full bg-white rounded-lg shadow">
        <thead>
          <tr class="bg-gray-200 text-gray-700">
            <th class="py-2 px-4 text-left">NIK</th>
            <th class="py-2 px-4 text-left">Nama</th>
            <th class="py-2 px-4 text-left">Alamat</th>
            <th class="py-2 px-4 text-left">Pekerjaan</th>
            <th class="py-2 px-4 text-left">Status</th>
            <th class="py-2 px-4 text-center">Foto</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($warga)): ?>
            <tr>
              <td colspan="6" class="text-center py-4">Belum ada data warga</td>
            </tr>
          <?php else: ?>
            <?php foreach($warga as $row): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 px-4"><?= $row['id_nik'] ?></td>
              <td class="py-2 px-4"><?= $row['nama'] ?></td>
              <td class="py-2 px-4"><?= $row['alamat'] ?></td>
              <td class="py-2 px-4"><?= $row['pekerjaan'] ?></td>
              <td class="py-2 px-4"><?= $row['status_keluarga'] ?></td>
              <td class="py-2 px-4 text-center">
                <?php if(!empty($row['foto'])): ?>
                  <img src="assets/img/foto_warga/<?= $row['foto'] ?>" class="w-10 h-10 rounded-full mx-auto">
                <?php else: ?>
                  <span class="text-gray-400 italic">Belum ada foto</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-3">
      © 2025 | SI-KAMPUNG JOS - dibuat oleh Hafiz
    </footer>
  </div>
</div>

</body>
</html>
