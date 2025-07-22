<?php
include 'check.php'; 
include '../backend/config/connect.php';

$kas_data = [];
$result = mysqli_query($connect, "
    SELECT k.*, w.nama 
    FROM kas k 
    LEFT JOIN warga w ON k.id_nik = w.id_nik
");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total_bayar = 0;
        for($i=1; $i<=12; $i++){
            $total_bayar += $row["bln_$i"];
        }
        $row['total_bayar'] = $total_bayar;
        $row['status'] = $total_bayar > 0 ? "Sudah" : "Belum";
        $kas_data[] = $row;
    }
}

$query_warga = mysqli_query($connect, "SELECT id_nik, nama FROM warga ORDER BY nama ASC");

$bulan_list = [
    1=>"Januari", 2=>"Februari", 3=>"Maret", 4=>"April", 5=>"Mei", 6=>"Juni",
    7=>"Juli", 8=>"Agustus", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Desember"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kas</title>
    <?php include 'includes/css.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>ID NIK</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Total Bayar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($kas_data)): ?>
                            <tr><td colspan="7" class="text-center">Belum ada data kas</td></tr>
                        <?php else: ?>
                        <?php $no = 1; foreach ($kas_data as $k): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $k['id_nik'] ?></td>
                                <td><?= $k['nama'] ?? 'Tidak Diketahui' ?></td>
                                <td>
                                    <?php if($k['status']=="Sudah"): ?>
                                        <span class="badge badge-success">✅ Sudah</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">❌ Belum</span>
                                    <?php endif; ?>
                                </td>
                                <td>Rp<?= number_format($k['total_bayar'],0,",",".") ?></td>
                                <td><?= htmlspecialchars($k['keterangan'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/js.php'; ?>
</body>
</html>
