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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #1d3557, #457b9d); /* Gradasi biru elegan */
        color: #fff;
    }
    .header {
        text-align: center;
        padding: 20px;
        background-color: rgba(29, 53, 87, 0.9); /* Warna header lebih gelap */
    }
    .header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 600;
        color: #f1faee; /* Warna teks header */
    }
    .container {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        background: #f1faee; /* Warna putih krem */
        color: #1d3557; /* Warna teks yang kontras */
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Bayangan lebih lembut */
        box-sizing: border-box; /* Hitung padding dan border dalam ukuran container */
        overflow: hidden; /* Pastikan konten tidak meluap */
    }
    .form-group {
        margin-bottom: 20px;
        width: 100%; /* Pastikan elemen form menyesuaikan ukuran container */
        box-sizing: border-box; /* Hitung padding dan border dalam ukuran elemen */
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500; /* Sedikit lebih tebal untuk kejelasan */
        font-size: 1rem;
        color: #1d3557;
    }
    input, select, textarea {
        width: 100%;
        max-width: 100%; /* Hindari elemen form melebihi container */
        padding: 12px;
        border: 1px solid #457b9d; /* Garis input biru elegan */
        border-radius: 8px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.9);
        color: #1d3557;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
        box-sizing: border-box; /* Pastikan padding dan border dihitung */
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #1d3557; /* Warna fokus lebih tajam */
        box-shadow: 0 0 8px rgba(69, 123, 157, 0.8);
    }
    textarea {
        resize: none;
    }
    button {
        background: #457b9d;
        color: #f1faee;
        font-weight: 600;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s;
        width: 100%; /* Sesuaikan tombol dengan lebar container */
        box-sizing: border-box;
    }
    button:hover {
        background: #1d3557;
        transform: scale(1.05); /* Efek hover sedikit membesar */
    }
</style>


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
                <label for="project_name">Nama Proyek:</label>
                <input type="text" name="project_name" id="project_name" placeholder="Masukkan nama proyek" required>
            </div>
            <div class="form-group">
                <label for="tutorial_link">link:</label>
                <input type="url" name="tutorial_link" id="tutorial_link" placeholder="Masukkan link project" required>
            </div>
            <div class="form-group">
                <label for="description">Keterangan:</label>
                <textarea name="description" id="description" rows="4" placeholder="Masukkan keterangan proyek" required></textarea>
            </div>
            <div class="form-group">
                <label for="tutorial_link">Video Tutorial (Link):</label>
                <input type="url" name="tutorial_link" id="tutorial_link" placeholder="Masukkan link video tutorial" required>
            </div>
            <button type="submit" class="btn">Unggah</button>
        </form>
    </div>
</body>
</html>
