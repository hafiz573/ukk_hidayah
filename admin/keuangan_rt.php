<?php
include 'check.php';
include '../backend/config/connect.php';

// Ambil total kas dari tabel kas (sama seperti di halaman KAS Warga)
$total_kas = 0;
$q_kas = mysqli_query($connect, "
    SELECT 
        SUM(
            IFNULL(bln_1,0) + IFNULL(bln_2,0) + IFNULL(bln_3,0) +
            IFNULL(bln_4,0) + IFNULL(bln_5,0) + IFNULL(bln_6,0) +
            IFNULL(bln_7,0) + IFNULL(bln_8,0) + IFNULL(bln_9,0) +
            IFNULL(bln_10,0) + IFNULL(bln_11,0) + IFNULL(bln_12,0)
        ) AS total_kas 
    FROM kas
");
if ($q_kas && $row = mysqli_fetch_assoc($q_kas)) {
    $total_kas = $row['total_kas'];
}

// Ambil data kas dan nama warga
$kas_data = [];
$result = mysqli_query($connect, "
    SELECT k.*, w.nama 
    FROM kas k 
    LEFT JOIN warga w ON k.id_nik = w.id_nik
");
$total_semua = 0;
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total_bayar = 0;
        for($i=1; $i<=12; $i++){
            $total_bayar += $row["bln_$i"];
        }
        $row['total_bayar'] = $total_bayar;
        $total_semua += $total_bayar;
        $row['status'] = $total_bayar > 0 ? "Sudah" : "Belum";#
        $kas_data[] = $row;
    }
}

$bulan_list = [
    1=>"Januari", 2=>"Februari", 3=>"Maret", 4=>"April", 5=>"Mei", 6=>"Juni",
    7=>"Juli", 8=>"Agustus", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Desember"
];

// Ambil data keuangan RT
$keuangan_data = [];
$total_pemasukan = 0;
$total_pengeluaran = 0;

$result = mysqli_query($connect, "SELECT * FROM keuangan_rt ORDER BY id_kas ASC");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total_pemasukan += $row['pendapatan'];
        $total_pengeluaran += $row['pengeluaran'];
        $keuangan_data[] = $row;
    }
}

// Calculate Saldo Akhir dynamically
$saldo_akhir = $total_pemasukan - $total_pengeluaran;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan RT</title>
    <?php include 'includes/css.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php include 'includes/header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <!-- Card Total Kas (dari tabel kas), Pemasukan, Pengeluaran -->
            <div class="row mb-3">
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rp<?= number_format($total_kas,0,",",".") ?></h3>
                            <p>Total Kas (Warga)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rp<?= number_format($total_pemasukan,0,",",".") ?></h3>
                            <p>Total Pemasukan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp<?= number_format($total_pengeluaran,0,",",".") ?></h3>
                            <p>Total Pengeluaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right mb-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addKegiatanModal">
                        <i class="fas fa-plus"></i> Add Kegiatan
                    </button>
                    <button class="btn btn-success" onclick="window.print()">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </button>
                </div>
            </div>

            <!-- Modal Add Kegiatan -->
            <div class="modal fade" id="addKegiatanModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="tambah_kegiatan.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Kegiatan Keuangan RT</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Item Kegiatan</label>
                                    <input type="text" name="item_kegiatan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Pemasukan</label>
                                    <input type="number" name="pendapatan" class="form-control" value="0" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Pengeluaran</label>
                                    <input type="number" name="pengeluaran" class="form-control" value="0" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Kegiatan -->
            <?php foreach ($keuangan_data as $row): ?>
            <div class="modal fade" id="editKegiatanModal<?= $row['id_kas'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="update_kegiatan.php" method="POST">
                            <input type="hidden" name="id_kas" value="<?= $row['id_kas'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kegiatan Keuangan RT</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Item Kegiatan</label>
                                    <input type="text" name="item_kegiatan" class="form-control" value="<?= htmlspecialchars($row['item_kegiatan']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Pemasukan</label>
                                    <input type="number" name="pendapatan" class="form-control" value="<?= $row['pendapatan'] ?>" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Pengeluaran</label>
                                    <input type="number" name="pengeluaran" class="form-control" value="<?= $row['pengeluaran'] ?>" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="<?= htmlspecialchars($row['keterangan']) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal'] ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Tabel Keuangan RT -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item Kegiatan</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($keuangan_data)): ?>
                            <tr><td colspan="6" class="text-center">Belum ada data keuangan</td></tr>
                        <?php else: ?>
                        <?php $no = 1; foreach ($keuangan_data as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['item_kegiatan']) ?></td>
                                <td>Rp<?= number_format($row['pendapatan'],0,",",".") ?></td>
                                <td>Rp<?= number_format($row['pengeluaran'],0,",",".") ?></td>
                                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editKegiatanModal<?= $row['id_kas'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="delete_kegiatan.php?id=<?= $row['id_kas'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Hapus kegiatan ini?')">
                                       <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan="2" class="text-right">Total</th>
                            <th>Rp<?= number_format($total_pemasukan,0,",",".") ?></th>
                            <th>Rp<?= number_format($total_pengeluaran,0,",",".") ?></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-right">Saldo Akhir</th>
                            <th colspan="3">Rp<?= number_format($saldo_akhir,0,",",".") ?></th>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="alert alert-info mt-4">
                <b>Catatan:</b> Laporan ini menampilkan rekap pemasukan dan pengeluaran kas RT. Jika ada pemasukan dadakan, saldo kas akan otomatis bertambah.
            </div>

        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/js.php'; ?>
</body>
</html>
