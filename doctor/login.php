<?php
session_start();

$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "../config/db.php";
    require "../config/functions.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM dokter WHERE email = ?";
    $stmt = $db->prepare($sql);

    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $inputError = false;

    if (!$user) {
        $_SESSION['error'] = 'Email <strong>' . $email . '</strong> tidak ditemukan';
        $inputError = true;
    }

    if (!$inputError && !password_verify($password, $user['password_hash'])) {
        $_SESSION['error'] = 'Password salah';
        $inputError = true;
    }

    if (!$inputError) {
        save_login($user['id'], $user['id_poli']);

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
    <title>Masuk | RS Sehat Sentosa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container p-4">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <h3 class="card-title text-primary text-center mb-4">Masuk Dokter</h3>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                                <?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php session_unset(); ?>
                        <?php endif; ?>
                        <p class="form-text text-center">Selamat datang kembali! silahkan masuk menggunakan email dan kata sandi yang sudah terdaftar!</p>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="show_password" id="show_password">
                            <label for="show_password">Tampilkan Kata Sandi</label>
                        </div>
                        <button class="btn btn-primary w-100 mb-3">Kirim</button>
                        <p class="form-text text-center">Belum punya akun? <a href="register.php">Daftar sekarang!</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('#show_password').addEventListener('click', function() {
            const password = document.querySelector('#password');
            if (password.type == 'password') password.type = 'text';
            else password.type = 'password';
        });
    </script>
</body>

</html>