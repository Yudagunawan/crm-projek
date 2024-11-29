<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Spreadsheet - Master Link</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px 20px;
            text-align: left;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .main-content {
            margin: 80px auto;
            width: 60%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .main-content h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="file"] {
            display: block;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Upload Spreadsheet - Master Link</h1>
    </div>

    <div class="main-content">
        <h2>Unggah Data Master Link</h2>
        <form method="POST" action="process_upload.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih File Spreadsheet (Excel atau CSV):</label>
                <input type="file" id="file" name="file" accept=".xlsx, .xls, .csv" required>
            </div>
            <button type="submit" class="btn">Upload</button>
        </form>
    </div>
</body>
</html>
