<?php
session_start();

require "../config/constants.php";

if (!isset($_COOKIE[COOKIE_KEY_USER_ID])) {
    header('Location: ../login.php');
}

require "../config/db.php";

$id_pasien = $_COOKIE[COOKIE_KEY_USER_ID];

$sql = "SELECT dokter.nama as nama_dokter, poli.nama as nama_poli, booking.id as id_booking, booking.status, booking.created_at, jadwal_dokter.* FROM booking INNER JOIN jadwal_dokter ON jadwal_dokter.id = booking.id_jadwal INNER JOIN dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN poli ON poli.id = dokter.id_poli WHERE booking.id_pasien = ? AND booking.status != 'pending' ORDER BY booking.created_at DESC;";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $id_pasien);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Periksa | Dasbor Sehat Sentosa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <?php include "../components/home/navbar.php" ?>

    <div class="container p-4">
        <div class="col-md-9">
            <h2 class="text-primary mb-4">Riwayat Periksa</h2>
            <a href="booking.php" class="btn btn-primary">+ Tambah janji</a>
            <table class="table table-hover mt-4 border table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Waktu</th>
                        <th>Dibuat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $i => $jadwal): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $jadwal['nama_dokter'] ?></td>
                            <td><?= $jadwal['nama_poli'] ?></td>
                            <td class="text-capitalize"><?= $jadwal['hari'] . ", " . $jadwal['waktu_mulai'] . " - " . $jadwal['waktu_selesai'] ?></td>
                            <td><?= $jadwal['created_at'] ?></td>
                            <td class="text-capitalize <?= $jadwal['status'] == 'batal' ? 'text-danger' : 'text-success' ?>"><?= $jadwal['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>

</html>