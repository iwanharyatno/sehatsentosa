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
            <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                Data berhasil disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                Data gagal disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
                    <tr>
                        <td>1</td>
                        <td>Dr. Andi Wijaya</td>
                        <td>Dokter Umum</td>
                        <td>Rabu, 12.00 - 15.00</td>
                        <td>
                            <a href="../common/update-booking.php?id=1&status=batal&return=../user" class="btn btn-danger btn-sm">Batalkan</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>

</html>