<?php
// Sambung ke pangkalan data
$conn = new mysqli("localhost", "root", "", "maklumat_pekerja");

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Semak jika borang pendaftaran dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Semak jika kata laluan sepadan
    if ($password != $confirm_password) {
        $error = "Kata laluan tidak sepadan!";
    } else {
        // Hash kata laluan untuk keselamatan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Semak jika nama pengguna sudah wujud
        $sql = "SELECT * FROM pengguna WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Nama pengguna sudah wujud!";
        } else {
            // Masukkan pengguna baru ke dalam pangkalan data
            $sql = "INSERT INTO pengguna (username, password) VALUES ('$username', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                // Arahkan ke halaman log masuk selepas pendaftaran berjaya
                header("Location: login.php");
                exit();
            } else {
                $error = "Ralat semasa mendaftar: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Maklumat Pekerja</title>
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
        .error {
            color: red;
            font-size: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pendaftaran Pengguna</h1>
        <div class="card">
            <form method="POST" action="register.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Laluan</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Sahkan Kata Laluan</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>
