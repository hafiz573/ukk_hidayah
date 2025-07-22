<?php
include 'check.php';
include '../backend/config/connect.php'; // koneksi $connect

// ================== JUMLAH WARGA ==================
$total_warga = 0;
$q_warga = mysqli_query($connect, "SELECT COUNT(*) AS total_warga FROM warga");
if ($q_warga && $row = mysqli_fetch_assoc($q_warga)) {
    $total_warga = $row['total_warga'];
}

// ================== JUMLAH KAS ==================
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>

    <!-- css -->
    <?php include 'includes/css.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'includes/header.php'; ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

<div class="row">
    <!-- Warga -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_warga ?></h3>
                <p>Warga</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Jumlah Kas -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= number_format($total_kas, 0, ',', '.') ?><sup style="font-size:20px"> IDR</sup></h3>
                <p>Jumlah Kas</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
</div>

                </div>

            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<!-- JS -->
<?php include 'includes/js.php'; ?>
</body>
</html>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
</div>

                </div>

            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<!-- JS -->
<?php include 'includes/js.php'; ?>
</body>
</html>
