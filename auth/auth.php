<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLogin()
{
    if (!isset($_SESSION['login'])) { // Jika session login tidak ada
        header('Location: ../login.php'); // Arahkan ke halaman login
        exit(); // Hentikan eksekusi skrip
    }
}

// Fungsi untuk memeriksa apakah pengguna adalah admin
function isAdmin()
{
    return isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin';
}

// Fungsi untuk memeriksa apakah pengguna adalah user biasa
function isUser()
{
    return isset($_SESSION['userType']) && $_SESSION['userType'] === 'user';
}
?>
