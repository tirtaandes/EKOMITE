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

// Proses input siswa jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gantilah dengan logika penyimpanan data siswa sesuai kebutuhan Anda
    $nama_siswa = $_POST["nama_siswa"];
    $kelas = $_POST["kelas"];
    $nomor_induk = $_POST["nomor_induk"];
    $alamat = $_POST["alamat"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk menyimpan data siswa ke dalam tabel siswa
    $query = "INSERT INTO siswa (nama_siswa, kelas, nomor_induk, alamat, tanggal_lahir, jenis_kelamin, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssssss", $nama_siswa, $kelas, $nomor_induk, $alamat, $tanggal_lahir, $jenis_kelamin, $username, $password);

    if ($stmt->execute()) {
        // Redirect ke halaman ini sendiri agar data baru terlihat
        header("Location: siswa.php");
        exit;
    } else {
        $error_message = "Gagal menambahkan data siswa.";
    }

    $stmt->close();
}

    // Simpan data siswa ke database atau lakukan tindakan lainnya
    // ...

    // Setelah berhasil menyimpan data, Anda bisa mengalihkan pengguna kembali ke halaman ini atau halaman lainnya
    // header("Location: siswa.php");
    // exit;

?>
