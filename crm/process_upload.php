<?php
require '../auth/config.php';  // Memasukkan koneksi PDO
require '/vendor/autoload.php'; // Autoload PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dept = $_POST['dept'] ?? null;

    if (!$dept || !isset($_FILES['file'])) {
        die("Departemen atau file tidak valid.");
    }

    $file = $_FILES['file']['tmp_name'];

    try {
        // Membaca file spreadsheet menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Iterasi data dari file
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Lewati header

            $nama_project = $row[0] ?? null;
            $link = $row[1] ?? null;
            $keterangan = $row[2] ?? null;
            $tugas_pending = $row[3] ?? null;

            // Cek apakah nama_project dan link tidak kosong
            if ($nama_project && $link) {
                // Gunakan prepared statement PDO untuk menambah data
                $query = "INSERT INTO projects (dept, nama_project, link, keterangan, tugas_pending) VALUES (:dept, :nama_project, :link, :keterangan, :tugas_pending)";
                $stmt = $pdo->prepare($query);

                // Bind parameter
                $stmt->bindParam(':dept', $dept);
                $stmt->bindParam(':nama_project', $nama_project);
                $stmt->bindParam(':link', $link);
                $stmt->bindParam(':keterangan', $keterangan);
                $stmt->bindParam(':tugas_pending', $tugas_pending);

                // Eksekusi query
                $stmt->execute();
            }
        }

        // Setelah berhasil, arahkan ke halaman index
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        die("Terjadi kesalahan saat membaca file: " . $e->getMessage());
    }
} else {
    // Jika request bukan POST, redirect ke halaman upload
    header("Location: upload.php");
    exit();
}
?>
