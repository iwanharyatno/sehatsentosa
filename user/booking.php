<?php
session_start();

require "../config/db.php";
require "../config/constants.php";

$sql = "SELECT * FROM poli";
$poli_result = $db->query($sql);

if (isset($_GET['poli'])) {
    $sql = "SELECT jadwal_dokter.*, dokter.nama FROM jadwal_dokter INNER JOIN dokter ON dokter.id = jadwal_dokter.id_dokter WHERE dokter.id_poli = ?";

    if (isset($_GET['hari']) && !empty($_GET['hari'])) {
        $sql .= " AND jadwal_dokter.hari = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('is', $_GET['poli'], $_GET['hari']);
        $stmt->execute();
    } else {
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $_GET['poli']);
        $stmt->execute();
    }

    $jadwal_result = $stmt->get_result();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pasien = $_COOKIE[COOKIE_KEY_USER_ID];
    $id_jadwal = $_POST['jadwal'];

    $sql = "INSERT INTO booking (id_jadwal, id_pasien) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ii', $id_jadwal, $id_pasien);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Janji temu berhasil dibuat!';
        $stmt->close();
        $db->close();

        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Janji Temu | Dasbor Sehat Sentosa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <?php include "../components/home/navbar.php" ?>

    <div class="container p-4">
        <div class="col-md-4">
            <h2 class="text-primary mb-4">Buat Janji Temu</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="poli" class="form-label">Poli</label>
                    <select name="poli" id="poli" class="form-control" onchange="updateParams('poli', event)">
                        <option value="">-- Pilih poli --</option>
                        <?php foreach ($poli_result as $poli): ?>
                            <option value="<?= $poli['id'] ?>" <?= isset($_GET['poli']) ? ($_GET['poli'] == $poli['id'] ? "selected" : "") : "" ?>><?= $poli['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-control" onchange="updateParams('hari', event)">
                        <option value="">-- Semua hari --</option>
                        <option value="senin" <?= isset($_GET['hari']) ? ($_GET['hari'] == "senin" ? "selected" : "") : "" ?>>Senin</option>
                        <option value="selasa" <?= isset($_GET['hari']) ? ($_GET['hari'] == "selasa" ? "selected" : "") : "" ?>>Selasa</option>
                        <option value="rabu" <?= isset($_GET['hari']) ? ($_GET['hari'] == "rabu" ? "selected" : "") : "" ?>>Rabu</option>
                        <option value="kamis" <?= isset($_GET['hari']) ? ($_GET['hari'] == "kamis" ? "selected" : "") : "" ?>>Kamis</option>
                        <option value="jumat" <?= isset($_GET['hari']) ? ($_GET['hari'] == "jumat" ? "selected" : "") : "" ?>>Jumat</option>
                        <option value="sabtu" <?= isset($_GET['hari']) ? ($_GET['hari'] == "sabtu" ? "selected" : "") : "" ?>>Sabtu</option>
                        <option value="minggu" <?= isset($_GET['hari']) ? ($_GET['hari'] == "minggu" ? "selected" : "") : "" ?>>Minggu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jadwal" class="form-label">Jadwal</label>
                    <select name="jadwal" id="jadwal" class="form-control">
                        <option>-- Pilih jadwal --</option>
                        <?php foreach ($jadwal_result as $jadwal): ?>
                            <option value="<?= $jadwal['id'] ?>"><?= $jadwal['nama'] . "(" . $jadwal['hari'] . ", " . $jadwal['waktu_mulai'] . " - " . $jadwal['waktu_selesai'] . ")" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary mb-3">Buat janji</button>
            </form>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>

    <script>
        function updateParams(name, event) {
            const value = event.target.value;
            const params = new URLSearchParams(window.location.search);

            params.set(name, value);
            if (value == '') {
                params.delete(name);
            }

            window.location.href = window.location.pathname + '?' + params.toString();
        }
    </script>
</body>

</html>