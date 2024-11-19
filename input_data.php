<?php
// Koneksi ke database (sesuaikan dengan pengaturan database Anda)
$host = '35.219.47.204'; // Alamat server
$username = 'root'; // Username database
$password = 'root12345'; // Password database
$dbname = 'experimental001'; // Nama database yang ingin diakses

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $data = $_POST['data'];
    $loop_count = $_POST['loop_count'];

    // Validasi jumlah loop
    if ($loop_count < 1) {
        echo "Jumlah loop harus lebih dari 0.";
    } else {
        // Menyisipkan data sebanyak jumlah loop
        for ($i = 0; $i < $loop_count; $i++) {
            // Query untuk menyisipkan data ke tabel (misalnya tabel 'data_table')
            $sql = "INSERT INTO data_table (data_column) VALUES (?)";
            
            // Menyiapkan statement untuk mencegah SQL Injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $data);

            // Eksekusi query
            if ($stmt->execute()) {
                echo "Data berhasil dimasukkan ke dalam database. Iterasi ke-" . ($i + 1) . "<br>";
            } else {
                echo "Terjadi kesalahan: " . $stmt->error . "<br>";
            }

            // Menutup statement
            $stmt->close();
        }
    }
}

// Menutup koneksi
$conn->close();
?>
