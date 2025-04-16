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

$sql = "SELECT pasien.nama_lengkap as nama_pasien, poli.nama as nama_poli, pasien.no_telepon as telp_pasien, booking.id as id_booking, jadwal_dokter.* FROM booking INNER JOIN pasien ON pasien.id_pasien = booking.id_pasien INNER JOIN jadwal_dokter ON jadwal_dokter.id = booking.id_jadwal INNER JOIN dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN poli ON poli.id = dokter.id_poli WHERE jadwal_dokter.id_dokter = ? AND booking.status = 'pending';";
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
    <title>Jadwal Saya | Dasbor Sehat Sentosa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <?php include "../components/doctor/navbar.php" ?>

    <div class="container p-4">
        <div class="col-md-9">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset(); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset(); ?>
            <?php endif; ?>
            <h2 class="text-primary mb-4">Jadwal Saya</h2>
            <table class="table table-hover mt-4 border table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama Poli</th>
                        <th>No Telepon</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $i => $booking): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $booking['nama_pasien'] ?></td>
                            <td><?= $booking['telp_pasien'] ?></td>
                            <td><?= $booking['nama_poli'] ?></td>
                            <td class="text-capitalize"><?= $booking['hari'] . ", " . $booking['waktu_mulai'] . " - " . $booking['waktu_selesai'] ?></td>
                            <td>
                                <a href="../common/update-booking.php?id=<?= $booking['id_booking'] ?>&status=selesai&return=../doctor" class="btn btn-success btn-sm">Selesaikan</a>
                                <a href="../common/update-booking.php?id=<?= $booking['id_booking'] ?>&status=batal&return=../doctor" class="btn btn-danger btn-sm">Batalkan</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>

</html>