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

                <!-- Tombol Tambah -->
                <div class="row mb-3">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i> Add New Warga
                        </button>
                    </div>
                </div>

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
                                    <th width="150px">Action</th>
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
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $w['id_nik'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <!-- Tombol Delete -->
                                        <a href="delete_warga.php?id=<?= $w['id_nik'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete this entry?')">
                                           <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal<?= $w['id_nik'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="update_warga.php" method="POST">
                                                <input type="hidden" name="id_nik" value="<?= $w['id_nik'] ?>">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Warga</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nomor KK</label>
                                                        <input type="text" name="nomor_kk" class="form-control" value="<?= $w['nomor_kk'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nama" class="form-control" value="<?= $w['nama'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" value="<?= $w['alamat'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" name="pekerjaan" class="form-control" value="<?= $w['pekerjaan'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Status Keluarga</label>
                                                        <input type="text" name="status_keluarga" class="form-control" value="<?= $w['status_keluarga'] ?>">
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
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="addModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="tambah_warga.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Warga</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>ID NIK</label>
                                        <input type="text" name="id_nik" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor KK</label>
                                        <input type="text" name="nomor_kk" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Status Keluarga</label>
                                        <input type="text" name="status_keluarga" class="form-control">
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
