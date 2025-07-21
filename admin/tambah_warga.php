    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'ukk_hidayah');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_nik = $_POST['id_nik'];
        $nomor_kk = $_POST['nomor_kk'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $status_keluarga = $_POST['status_keluarga'];

        $stmt = $connect->prepare("INSERT INTO warga (id_nik, nomor_kk, nama, alamat, pekerjaan, status_keluarga) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id_nik, $nomor_kk, $nama, $alamat, $pekerjaan, $status_keluarga);
        $stmt->execute();
    }

    header("Location: data_warga.php");
    ?>