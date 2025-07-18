<?php
include '../backend/config/connect.php';

// Ambil data warga untuk dropdown
$query_warga = mysqli_query($connect, "SELECT id_nik, nama FROM warga ORDER BY nama ASC");

// Proses simpan jika form disubmit
if(isset($_POST['simpan'])){
    $id_nik     = mysqli_real_escape_string($connect, $_POST['id_nik']);

    // Jika tidak memilih warga
    if(empty($id_nik)){
        echo "<script>alert('Silakan pilih warga terlebih dahulu!');</script>";
    } else {
        // Ambil semua bulan (default 0)
        $bln = [];
        for($i=1; $i<=12; $i++){
            $bln[$i] = isset($_POST["bln_$i"]) && $_POST["bln_$i"] !== "" ? $_POST["bln_$i"] : 0;
        }

        $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);

        $sql = "INSERT INTO kas 
                (id_nik, bln_1, bln_2, bln_3, bln_4, bln_5, bln_6, bln_7, bln_8, bln_9, bln_10, bln_11, bln_12, keterangan)
                VALUES (
                    '$id_nik',
                    '{$bln[1]}','{$bln[2]}','{$bln[3]}','{$bln[4]}','{$bln[5]}','{$bln[6]}',
                    '{$bln[7]}','{$bln[8]}','{$bln[9]}','{$bln[10]}','{$bln[11]}','{$bln[12]}',
                    '$keterangan'
                )";

        if(mysqli_query($connect, $sql)){
            echo "<script>alert('✅ Data kas berhasil ditambahkan!'); window.location='data-kas.php';</script>";
        } else {
            echo "<script>alert('❌ Gagal menambahkan data: ".mysqli_error($connect)."');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Kas</title>
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
      <a href="logout.php" class="block py-2 px-3 rounded hover:bg-red-600 mt-auto">🚪 Keluar</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Tambah Data Kas Warga</h1>
    </header>

    <!-- Form Input -->
    <main class="p-6 overflow-auto">
      <form method="POST" class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
        
        <!-- Pilih Warga -->
        <div class="mb-4">
          <label class="block font-semibold mb-2">Pilih Warga</label>
          <select name="id_nik" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Warga --</option>
            <?php while($row = mysqli_fetch_assoc($query_warga)): ?>
              <option value="<?= $row['id_nik'] ?>">
                <?= htmlspecialchars($row['nama']) ?> (<?= htmlspecialchars($row['id_nik']) ?>)
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Input per bulan -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
          <?php 
          $bulan = [
            1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",
            7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember"
          ];
          foreach($bulan as $key=>$nama_bulan): ?>
            <div>
              <label class="block font-medium"><?= $nama_bulan ?></label>
              <input type="number" step="0.01" name="bln_<?= $key ?>" class="w-full border rounded px-2 py-1" placeholder="0">
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Keterangan -->
        <div class="mt-4">
          <label class="block font-semibold mb-2">Keterangan</label>
          <textarea name="keterangan" class="w-full border rounded px-3 py-2" rows="3" placeholder="Contoh: Pembayaran sebagian, cicilan, dll"></textarea>
        </div>

        <!-- Tombol -->
        <div class="mt-6 flex gap-4">
          <button type="submit" name="simpan" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Simpan</button>
          <a href="data-kas.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅ Kembali</a>
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
