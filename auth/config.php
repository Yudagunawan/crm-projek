<?php
$host = 'localhost';        // Sesuaikan dengan host Anda
$dbname = 'crm-prjk';       // Nama database
$username = 'root';         // Username MySQL
$password = '';             // Password MySQL (kosong jika default)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
