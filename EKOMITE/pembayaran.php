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

// Variabel untuk pesan kesalahan
$error_message = "";

// Proses penambahan data pembayaran jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $siswa_id = $_POST["siswa_id"];
    $komite_id = $_POST["komite_id"];
    $tanggal_pembayaran = $_POST["tanggal_pembayaran"];
    $jumlah_pembayaran = $_POST["jumlah_pembayaran"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $status_pembayaran = $_POST["status_pembayaran"];

    // Gantilah dengan validasi dan logika penyimpanan data sesuai dengan kebutuhan Anda
    // Misalnya, Anda bisa menggunakan prepared statement untuk mencegah SQL injection

    $query = "INSERT INTO pembayaran (siswa_id, komite_id, tanggal_pembayaran, jumlah_pembayaran, metode_pembayaran, status_pembayaran) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iisdss", $siswa_id, $komite_id, $tanggal_pembayaran, $jumlah_pembayaran, $metode_pembayaran, $status_pembayaran);

    if ($stmt->execute()) {
        // Redirect ke halaman ini sendiri agar data baru terlihat
        header("Location: pembayaran.php");
        exit;
    } else {
        $error_message = "Gagal menambahkan data pembayaran.";
    }

    $stmt->close();
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
        <!-- Formulir untuk menambahkan data pembayaran -->
        <section class="add-payment">
            <h2>Tambah Data Pembayaran</h2>
            <?php
            if (!empty($error_message)) {
                echo '<p class="error">' . $error_message . '</p>';
            }
            ?>
            <form action="pembayaran.php" method="POST">
                <label for="siswa_id">Siswa ID:</label>
                <input type="text" id="siswa_id" name="siswa_id" required>
                <label for="komite_id">Komite ID:</label>
                <input type="text" id="komite_id" name="komite_id" required>
                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
                <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
                <input type="text" id="jumlah_pembayaran" name="jumlah_pembayaran" required>
                <label for="metode_pembayaran">Metode Pembayaran:</label>
                <input type="text" id="metode_pembayaran" name="metode_pembayaran" required>
                <label for="status_pembayaran">Status Pembayaran:</label>
                <input type="text" id="status_pembayaran" name="status_pembayaran" required>
                <button type="submit">Tambahkan Data</button>
            </form>
        </section>

        <!-- Tabel data pembayaran -->
        <section class="payment-data">
            <h2>Data Pembayaran</h2>
            <table>
                <thead>
                    <tr>
                        <th>Pembayaran ID</th>
                        <th>Siswa ID</th>
                        <th>Komite ID</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data dari tabel pembayaran
                    $query = "SELECT * FROM pembayaran";

                    // Menjalankan query
                    $result = $koneksi->query($query);

                    // Memeriksa apakah query berhasil dieksekusi
                    if (!$result) {
                        die("Error: " . $koneksi->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["pembayaran_id"] . "</td>";
                        echo "<td>" . $row["siswa_id"] . "</td>";
                        echo "<td>" . $row["komite_id"] . "</td>";
                        echo "<td>" . $row["tanggal_pembayaran"] . "</td>";
                        echo "<td>" . $row["jumlah_pembayaran"] . "</td>";
                        echo "<td>" . $row["metode_pembayaran"] . "</td>";
                        echo "<td>" . $row["status_pembayaran"] . "</td>";
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
