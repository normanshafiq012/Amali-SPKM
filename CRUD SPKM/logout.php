<?php
// Mulakan sesi
session_start();

// Hapuskan semua sesi
session_unset();

// Musnahkan sesi
session_destroy();

// Arahkan ke halaman log masuk
header("Location: login.php");
exit();
?>
