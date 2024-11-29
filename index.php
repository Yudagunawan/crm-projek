<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: Dashboard/index.php'); // Jika sudah login, arahkan ke dashboard
    exit();
} else {
    header('Location: login.php'); // Jika belum login, arahkan ke login
    exit();
}
?>
