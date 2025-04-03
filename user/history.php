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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dr. Andi Wijaya</td>
                        <td>Dokter Umum</td>
                        <td>Rabu, 12.00 - 15.00</td>
                        <td><span class="text-success">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>

</html>