<?php
// Proses login di sini
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Gantilah dengan validasi dan logika otentikasi sesuai dengan kebutuhan Anda
    if ($username === "contohuser" && $password === "contohpassword") {
        // Jika berhasil login, Anda dapat mengatur sesi atau mengalihkan pengguna ke halaman lain
        // Misalnya, untuk mengatur sesi, Anda bisa menggunakan:
        // session_start();
        // $_SESSION["username"] = $username;
        header("Location: dashboard.html"); // Ganti dengan URL dashboard sesuai dengan kebutuhan Anda
        exit;
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Pembayaran Komite</title>
    <!-- Tambahkan tautan ke berkas CSS Anda di sini -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
</head>
<head>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .login h2 {
            text-align: center;
        }

        .login label,
        .login input,
        .login button {
            display: block;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang di Website Pembayaran Komite</h1>
        <nav>
            <ul>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="pembayaran.php">Pembayaran</a></li>
                <li><a href="komite.html">Komite</a></li>
                <li><a href="siswa.php">Siswa</a></li>
                <li><a href="admin.html">Admin</a></li>
            </ul>
        </nav>
    </header>

    <div class="login">
        <h2>Login</h2>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Website Pembayaran Komite</p>
    </footer>
</body>
</html>
