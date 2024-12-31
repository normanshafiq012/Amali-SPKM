<?php
// Mulakan sesi
session_start();

// Semak jika pengguna telah log masuk
if (!isset($_SESSION["username"])) {
    // Jika tidak log masuk, arahkan ke halaman log masuk
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Utama - Maklumat Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eef2f3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4e73df;
        }
        .card-text {
            font-size: 1rem;
            color: #666;
        }
        .btn {
            width: 100%;
            padding: 15px;
            font-size: 1.2rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .row {
            display: flex;
            justify-content: center;
        }
        .col-md-4 {
            margin-bottom: 30px;
        }
        .welcome-message {
            font-size: 1.2rem;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang ke Sistem Maklumat Pekerja</h1>
        
        <!-- Menunjukkan nama pengguna yang sedang log masuk -->
        <p class="welcome-message">Selamat datang, <?php echo $_SESSION["username"]; ?>!</p>

        <p class="text-center mb-5" style="font-size: 1.1rem; color: #555;">Pilih salah satu tindakan di bawah untuk menguruskan maklumat pekerja.</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tambah Pekerja</h5>
                        <p class="card-text">Masukkan maklumat pekerja baru ke dalam sistem.</p>
                        <a href="add.php" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Senarai Pekerja</h5>
                        <p class="card-text">Lihat dan uruskan senarai pekerja yang sedia ada.</p>
                        <a href="list.php" class="btn btn-success">Senarai</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Butang Log Keluar -->
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-danger">Log Keluar</a>
        </div>
    </div>
</body>
</html>
