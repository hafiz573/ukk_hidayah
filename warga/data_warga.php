<?php
include 'check.php'; 
include '../backend/config/connect.php'; // koneksi ke DB

// Ambil semua data warga
$warga_data = [];
$result = mysqli_query($connect, "SELECT * FROM warga");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $warga_data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warga Management</title>

    <?php include 'includes/css.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?php include 'includes/header.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <!-- Tabel Warga -->
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>ID NIK</th>
                                    <th>Nomor KK</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>Status Keluarga</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; foreach ($warga_data as $w): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $w['id_nik'] ?></td>
                                    <td><?= $w['nomor_kk'] ?></td>
                                    <td><?= $w['nama'] ?></td>
                                    <td><?= $w['alamat'] ?></td>
                                    <td><?= $w['pekerjaan'] ?></td>
                                    <td><?= $w['status_keluarga'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</div>

<!-- JS -->
<?php include 'includes/js.php'; ?>
</body>
</html>
