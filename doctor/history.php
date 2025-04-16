<?php
session_start();

require "../config/constants.php";

if (!isset($_COOKIE[COOKIE_KEY_USER_ID])) {
    header('Location: login.php');
    return;
}

if (!isset($_COOKIE[COOKIE_KEY_POLI_ID])) {
    header('Location: ../user');
    return;
}

require "../config/db.php";

$id_pasien = $_COOKIE[COOKIE_KEY_USER_ID];

$sql = "SELECT pasien.nama_lengkap as nama_pasien, poli.nama as nama_poli, pasien.no_telepon as telp_pasien, booking.id as id_booking, booking.status, jadwal_dokter.* FROM booking INNER JOIN pasien ON pasien.id_pasien = booking.id_pasien INNER JOIN jadwal_dokter ON jadwal_dokter.id = booking.id_jadwal INNER JOIN dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN poli ON poli.id = dokter.id_poli WHERE jadwal_dokter.id_dokter = ? AND booking.status != 'pending';";
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
    <title>Riwayat Pemeriksaan | Dasbor Sehat Sentosa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <?php include "../components/doctor/navbar.php" ?>

    <div class="container p-4">
        <div class="col-md-9">
            <h2 class="text-primary mb-4">Riwayat Pemeriksaan</h2>
            <table class="table table-hover mt-4 border table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama Poli</th>
                        <th>No Telepon</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $i => $jadwal): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $jadwal['nama_pasien'] ?></td>
                            <td><?= $jadwal['nama_poli'] ?></td>
                            <td><?= $jadwal['telp_pasien'] ?></td>
                            <td class="text-capitalize"><?= $jadwal['hari'] . ", " . $jadwal['waktu_mulai'] . " - " . $jadwal['waktu_selesai'] ?></td>
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