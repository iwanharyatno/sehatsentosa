<?php
session_start();

require "../config/constants.php";

if (!isset($_COOKIE[COOKIE_KEY_USER_ID])) {
    header('Location: ../login.php');
}

require "../config/db.php";

$id_pasien = $_COOKIE[COOKIE_KEY_USER_ID];

$sql = "SELECT dokter.nama as nama_dokter, poli.nama as nama_poli, booking.id as id_booking, jadwal_dokter.* FROM booking INNER JOIN jadwal_dokter ON jadwal_dokter.id = booking.id_jadwal INNER JOIN dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN poli ON poli.id = dokter.id_poli WHERE booking.id_pasien = ? AND booking.status = 'pending';";
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
    <?php include "../components/home/navbar.php" ?>

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
            <a href="booking.php" class="btn btn-primary">+ Tambah janji</a>
            <table class="table table-hover mt-4 border table-light">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $i => $booking): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $booking['nama_dokter'] ?></td>
                            <td><?= $booking['nama_poli'] ?></td>
                            <td class="text-capitalize"><?= $booking['hari'] . ", " . $booking['waktu_mulai'] . " - " . $booking['waktu_selesai'] ?></td>
                            <td>
                                <a href="../common/update-booking.php?id=<?= $booking['id_booking'] ?>&status=batal&return=../user" class="btn btn-danger btn-sm">Batalkan</a>
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