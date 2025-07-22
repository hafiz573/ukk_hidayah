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

            <div class="row mb-3">
                <div class="col-12 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addKasModal">
                        <i class="fas fa-plus"></i> Add New Kas
                    </button>
                </div>
            </div>

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
                                <th width="150px">Action</th>
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
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editKasModal<?= $k['id_kas'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="delete_kas.php?id=<?= $k['id_kas'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Hapus data kas ini?')">
                                       <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah Kas -->
            <div class="modal fade" id="addKasModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="tambah_kas.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Kas</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Pilih Warga</label>
                                    <select name="id_nik" class="form-control" required>
                                        <option value="">-- Pilih Warga --</option>
                                        <?php while($w = mysqli_fetch_assoc($query_warga)): ?>
                                            <option value="<?= $w['id_nik'] ?>"><?= $w['id_nik'] ?> - <?= $w['nama'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <?php foreach($bulan_list as $i => $nama_bulan): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?= $nama_bulan ?></label>
                                                <input type="number" name="bln_<?= $i ?>" class="form-control" placeholder="0">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" placeholder=""></textarea>
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

            <!-- Modal Edit Kas -->
            <?php foreach ($kas_data as $k): ?>
            <div class="modal fade" id="editKasModal<?= $k['id_kas'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="update_kas.php" method="POST">
                            <input type="hidden" name="id" value="<?= $k['id_kas'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Kas - <?= $k['nama'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php foreach($bulan_list as $i => $nama_bulan): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?= $nama_bulan ?></label>
                                                <input type="number" name="bln_<?= $i ?>" class="form-control" value="<?= $k["bln_$i"] ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"><?= htmlspecialchars($k['keterangan'] ?? '') ?></textarea>
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

        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/js.php'; ?>
</body>
</html>
