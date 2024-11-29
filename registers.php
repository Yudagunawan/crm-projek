<?php
require 'auth/config.php';

$error = ''; // Variabel untuk error message

if (!$pdo) {
    die("Koneksi ke database gagal.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi.";
    } else {
        try {
            // Cek apakah username sudah terdaftar
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM login WHERE username = :username");
            $checkStmt->bindParam(':username', $username);
            $checkStmt->execute();
            $userExists = $checkStmt->fetchColumn();

            if ($userExists > 0) {
                $error = "Username sudah terdaftar.";
            } else {
                // Hash password dan masukkan data ke database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO login (username, password, userType) VALUES (:username, :password, :userType)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':userType', $userType);

                if ($stmt->execute()) {
                    header("Location: login.php"); // Redirect ke halaman login setelah sukses
                    exit;
                } else {
                    $error = "Gagal menambahkan pengguna.";
                }
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            padding: 20px;
        }
        .register-container h1 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-register {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-register:hover {
            background: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>

        <!-- Menampilkan pesan error jika ada -->
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="registers.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="userType">User Type</label>
                <select id="userType" name="userType" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn-register">Register</button>
        </form>
        
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
