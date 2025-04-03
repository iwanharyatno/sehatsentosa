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
            <form action="">
                <div class="mb-3">
                    <label for="poli" class="form-label">Poli</label>
                    <select name="poli" id="poli" class="form-control">
                        <option value="1">Umum</option>
                        <option value="2">Gigi</option>
                        <option value="3">Anak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-control">
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                        <option value="minggu">Minggu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jadwal" class="form-label">Jadwal</label>
                    <select name="jadwal" id="jadwal" class="form-control">
                        <option>-- Pilih jadwal ---</option>
                    </select>
                </div>
                <button class="btn btn-primary mb-3">Buat janji</button>
            </form>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>

</html>