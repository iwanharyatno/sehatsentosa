<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | RS Sehat Sentosa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container p-4">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <h3 class="card-title text-primary text-center mb-4">Buat akun baru</h3>
                        <p class="form-text text-center">Halo selamat datang! silahkan isi data berikut untuk membuat akun pasien dan mendapatkan akses ke sistem!</p>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label d-block">Jenis Kelamin</label>
                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" required>
                            <label for="jenis_kelamin_l">Laki-laki</label>
                            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" required>
                            <label for="jenis_kelamin_p">Perempuan</label>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                            <span class="form-text">Tambahkan kode negara dibelakangnya. cth: +62882xxxxx</span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                             <input type="checkbox" name="show_password" id="show_password">
                             <label for="show_password">Tampilkan Kata Sandi</label>
                        </div>
                        <button class="btn btn-primary w-100 mb-3">Kirim</button>
                        <p class="form-text text-center">Sudah punya akun? <a href="login.php">Masuk disini</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('#show_password').addEventListener('click', function() {
            const password = document.querySelector('#password');
            const konfirmasiPassword = document.querySelector('#konfirmasi_password');
            if (password.type == 'password') {
                password.type = 'text';
                konfirmasiPassword.type = 'text';
            } else {
                password.type = 'password';
                konfirmasiPassword.type = 'password';
            }
        });
    </script>
</body>

</html>