<?php
// <<<<<<< dev-yudha
// // // Koneksi ke database (sesuaikan dengan pengaturan database Anda)
// // $host = 'mysql-poc-db.apps.ocp-gcp-poc.poctestingocp.com'; // Alamat server
// =======
// // Koneksi ke database (sesuaikan dengan pengaturan database Anda)
// //$host = 'mysql-poc-db.apps.ocp-gcp-poc.poctestingocp.com'; // Alamat server
// // $host = '10.125.131.226'; 
// >>>>>>> main
// $username = 'adminpoc'; // Username database
// $password = 'adminpoc123'; // Password database
// $dbname = 'pocdb'; // Nama database yang ingin diakses

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbuser = getenv("MYSQL_USER");
$pwd = getenv("MYSQL_PASSWORD");
$dbname = getenv("MYSQL_DATABASE");

// Create connection
$conn = new mysqli($dbhost, $dbuser, $pwd, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed. Please make sure you have the MYSQL_SERVICE_HOST, MYSQL_USER, MYSQL_PASSWORD, and MYSQL_DATABASE environment variables : " . $conn->connect_error);
}

// // Membuat koneksi
// $conn = new mysqli($host, $username, $password, $dbname);

// // Mengecek koneksi
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

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
