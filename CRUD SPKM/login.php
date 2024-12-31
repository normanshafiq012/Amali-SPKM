<?php
// Mulakan sesi
session_start();

// Sambung ke pangkalan data
$conn = new mysqli("localhost", "root", "", "maklumat_pekerja");

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Semak jika borang log masuk dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Semak jika nama pengguna wujud dalam pangkalan data
    $sql = "SELECT * FROM pengguna WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Semak jika kata laluan adalah betul
        if (password_verify($password, $row["password"])) {
            // Simpan ID pengguna dalam sesi
            $_SESSION["username"] = $username;
            // Arahkan ke halaman utama
            header("Location: index.php");
            exit();
        } else {
            $error = "Kata laluan salah!";
        }
    } else {
        $error = "Nama pengguna tidak dijumpai!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk - Maklumat Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eef2f3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
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
            padding: 20px;
        }
        .form-control {
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            font-size: 1.2rem;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .error {
            color: red;
            font-size: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log Masuk</h1>
        <div class="card">
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Laluan</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
                <button type="submit" class="btn btn-primary">Log Masuk</button>
            </form>
            <div class="mt-3 text-center">
                <a href="register.php" class="btn btn-secondary">Daftar Akaun Baru</a>
            </div>
        </div>
    </div>
</body>
</html>
