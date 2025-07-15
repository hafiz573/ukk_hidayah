<?php
// contoh data dummy (nantinya bisa diambil dari database)
$warga = [
  ["id" => "001", "nama" => "Alexander With Drove", "alamat" => "Jl. A Yani No.5", "pekerjaan" => "Wiraswasta bengkel", "status" => "Suami Nyaihem", "foto" => "Alexander.png"],
  ["id" => "002", "nama" => "Ngatinem", "alamat" => "Jl. Melati No.3", "pekerjaan" => "Guru", "status" => "Istri/Aurorak W Drove", "foto" => "Ngatinem.jpg"],
];
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
      <a href="data-warga.php" class="block py-2 px-3 rounded hover:bg-gray-700">📋 Data Warga</a>
      <a href="data-kas.php" class="block py-2 px-3 rounded hover:bg-gray-700">💰 Data Kas</a>
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
            <th class="py-2 px-4 text-left">ID</th>
            <th class="py-2 px-4 text-left">Nama</th>
            <th class="py-2 px-4 text-left">Alamat</th>
            <th class="py-2 px-4 text-left">Pekerjaan</th>
            <th class="py-2 px-4 text-left">Status</th>
            <th class="py-2 px-4 text-center">Foto</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($warga as $row): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2 px-4"><?= $row['id'] ?></td>
            <td class="py-2 px-4"><?= $row['nama'] ?></td>
            <td class="py-2 px-4"><?= $row['alamat'] ?></td>
            <td class="py-2 px-4"><?= $row['pekerjaan'] ?></td>
            <td class="py-2 px-4"><?= $row['status'] ?></td>
            <td class="py-2 px-4 text-center">
              <img src="assets/img/foto_warga/<?= $row['foto'] ?>" class="w-10 h-10 rounded-full mx-auto">
            </td>
          </tr>
          <?php endforeach; ?>
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
