<?php
session_start();
session_destroy(); // Mhancurkan session
header('Location:/index.php'); // Arahkan kembali ke halaman login
exit();
