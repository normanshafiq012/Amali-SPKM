<?php
// Sambung ke pangkalan data
$conn = new mysqli("localhost", "root", "", "maklumat_pekerja");

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Jika borang dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $ic = $conn->real_escape_string($_POST["no_ic"]);
    $hp = $conn->real_escape_string($_POST["no_hp"]);
    $jantina = $conn->real_escape_string($_POST["jantina"]);

    // Masukkan data ke dalam jadual pekerja
    $sql = "INSERT INTO pekerja (nama, no_ic, no_hp, jantina) 
            VALUES ('$nama', '$ic', '$hp', '$jantina')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Maklumat pekerja berjaya ditambah!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Ralat: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Maklumat Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f5f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2rem;
            color: #333;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            color: #4C8BF5; /* Blue Accent Color */
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .btn {
            font-size: 1rem;
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #4C8BF5;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3875D7;
        }
        .btn-clear {
            background-color: #FF9F00;
            border: none;
        }
        .btn-clear:hover {
            background-color: #E88900;
        }
        .btn-reset {
            background-color: #6c757d;
            border: none;
        }
        .btn-reset:hover {
            background-color: #5a6268;
        }
        .btn-back {
            background-color: #28a745;
            border: none;
        }
        .btn-back:hover {
            background-color: #218838;
        }
        .mb-3 input, .mb-3 select {
            border-radius: 8px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .mb-3 select {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Butang Kembali di luar kotak atas -->
    <div class="container mt-3">
        <button type="button" class="btn btn-back" onclick="window.history.back()">BACK</button>
    </div>

    <div class="container">
        <h2>Tambah Maklumat Pekerja</h2>
        <form method="POST" action="add.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_ic" class="form-label">No. IC</label>
                <input type="text" name="no_ic" id="no_ic" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. Telefon</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jantina" class="form-label">Jantina</label>
                <select name="jantina" id="jantina" class="form-control" required>
                    <option value="">-- Sila Pilih --</option>
                    <option value="Lelaki">Lelaki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-clear">Clear</button>
            </div>
        </form>
    </div>
</body>
</html>
