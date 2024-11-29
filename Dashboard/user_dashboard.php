<?php
session_start();

// Cek apakah user sudah login dan bukan admin
if (!isset($_SESSION['username']) || $_SESSION['userType'] !== 'user') {
    header('Location:../login.php'); // Redirect ke halaman login jika belum login atau bukan user
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
        .sidenav {
            width: 250px;
            background: #333;
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidenav a {
            display: block;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
        }
        .sidenav a:hover {
            background: #575757;
        }
        .main-content {
            margin-left: 250px;
            padding: 80px 20px 20px 20px;
        }
        .dashboard-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>User Dashboard</h1>
    </div>

    <div class="sidenav">
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Settings</a>
        <a href="#">Messages</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <div class="dashboard-container">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>This is your personalized dashboard. Use the navigation menu to explore.</p>
        </div>
    </div>
</body>
</html>
