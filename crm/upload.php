<?php
require '../auth/config.php';  // Menggunakan PDO untuk koneksi database

// Ambil daftar departemen
$departments = [];
try {
    $stmt = $pdo->query("SELECT name FROM departments");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $departments[] = $row['name'];
    }
} catch (PDOException $e) {
    die("Gagal mengambil data departemen: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Proyek</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Unggah Proyek Baru</h1>
    </div>
    <div class="container">
        <form action="process_upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="dept">Pilih Departemen:</label>
                <select name="dept" id="dept" required>
                    <option value="">Pilih Departemen</option>
                    <?php foreach ($departments as $dept) : ?>
                        <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="file">Unggah File (Excel atau CSV):</label>
                <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv" required>
            </div>
            <button type="submit" class="btn">Unggah</button>
        </form>
    </div>
</body>
</html>
