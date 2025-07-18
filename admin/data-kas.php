<?php
include 'backend/config/connect.php';

// Ambil data kas dari database
$query = mysqli_query($connect, "SELECT * FROM kas");
$kas = [];
while($row = mysqli_fetch_assoc($query)){
    // Hitung total pembayaran
    $total_bayar = 0;
    for($i=1; $i<=12; $i++){
        $bulan = "bln_".$i;
        $total_bayar += $row[$bulan];
    }

    // Cek status: jika semua bulan = 0 berarti belum
    $status = ($total_bayar > 0) ? "Sudah" : "Belum";

    $kas[] = [
        "nama"   => $row['id_nik'], // bisa diganti join dengan tabel warga
        "status" => $status,
        "jumlah" => "Rp".number_format($total_bayar,0,",",".")
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pembayaran Kas</title>
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
      <h1 class="text-xl font-bold">Data Pembayaran Kas Warga</h1>
      <div class="flex gap-4 items-center">
        <select class="border rounded px-3 py-1">
          <option>Pilih Bulan</option>
          <option>Januari</option>
          <option>Februari</option>
          <option>Maret</option>
          <option>April</option>
          <option>Mei</option>
          <option>Juni</option>
          <option>Juli</option>
          <option>Agustus</option>
          <option>September</option>
          <option>Oktober</option>
          <option>November</option>
          <option>Desember</option>
        </select>
        <img src="backend/cssadmin/logodepan.jpg" alt="Logo RT" class="w-24">
      </div>
    </header>

    <!-- Table Data -->
    <main class="p-6 overflow-auto">
      <table class="min-w-full bg-white rounded-lg shadow">
        <thead>
          <tr class="bg-gray-200 text-gray-700">
            <th class="py-2 px-4 text-left">NIK / Nama</th>
            <th class="py-2 px-4 text-center">Status Pembayaran</th>
            <th class="py-2 px-4 text-right">Total Bayar</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($kas)): ?>
            <tr><td colspan="3" class="text-center py-4">Belum ada data kas</td></tr>
          <?php else: ?>
            <?php foreach($kas as $row): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 px-4"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="py-2 px-4 text-center">
                <?php if($row['status']=="Sudah"): ?>
                  <span class="text-green-600 font-semibold">✅ Sudah</span>
                <?php else: ?>
                  <span class="text-red-600 font-semibold">❌ Belum</span>
                <?php endif; ?>
              </td>
              <td class="py-2 px-4 text-right"><?= $row['jumlah'] ?></td>
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
