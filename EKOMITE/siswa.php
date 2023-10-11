<?php
// Gantilah dengan informasi koneksi database Anda
$host = "localhost";
$username = "root";
$password = "";
$database = "ekomite";

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
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

</head>
<body>
    <header>
        <h1>Selamat Datang di Website Pembayaran Komite</h1>
        <nav>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="pembayaran.php">Pembayaran</a></li>
                <li><a href="komite.html">Komite</a></li>
                <li><a href="siswa.php">Siswa</a></li>
                <li><a href="admin.html">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Formulir untuk input siswa -->
        <section class="add-student">
            <h2>Input Data Siswa</h2>
            <form action="input_siswa.php" method="POST">
                <label for="nama_siswa">Nama Siswa:</label>
                <input type="text" id="nama_siswa" name="nama_siswa" required>

                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" required>

                <label for="nomor_induk">Nomor Induk:</label>
                <input type="text" id="nomor_induk" name="nomor_induk" required>

                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required>

                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Tambahkan Siswa</button>
            </form>
        </section>

        <!-- Tabel data siswa -->
        <section class="student-data">
            <h2>Data Siswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>Siswa ID</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nomor Induk</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data dari tabel siswa
                    $query = "SELECT * FROM siswa";

                    // Menjalankan query
                    $result = $koneksi->query($query);

                    // Memeriksa apakah query berhasil dieksekusi
                    if (!$result) {
                        die("Error: " . $koneksi->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["siswa_id"] . "</td>";
                        echo "<td>" . $row["nama_siswa"] . "</td>";
                        echo "<td>" . $row["kelas"] . "</td>";
                        echo "<td>" . $row["nomor_induk"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["tanggal_lahir"] . "</td>";
                        echo "<td>" . $row["jenis_kelamin"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Website Pembayaran Komite</p>
    </footer>
</body>
</html>

<?php
// Menutup koneksi database
$koneksi->close();
?>
