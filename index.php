<?php 

$host = '10.125.131.226'; 
$username = 'adminpoc'; // Username database
$password = 'adminpoc123'; // Password database
$dbname = 'pocdb'; // Nama database yang ingin diakses

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

    // Menutup koneksi
$conn->close();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data dengan Loop</title>
</head>
<body>
    <h2>Form Input Data</h2>
    <form action="input_data.php" method="POST">
        <label for="data">Data:</label>
        <input type="text" id="data" name="data" required><br><br>

        <label for="loop_count">Jumlah Loop:</label>
        <input type="number" id="loop_count" name="loop_count" min="1" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>




