<?php
// Sambung ke pangkalan data
$conn = new mysqli("localhost", "root", "", "maklumat_pekerja");

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}

// Semak jika ID pekerja disertakan dalam URL
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Pastikan ID adalah integer

    // Dapatkan data pekerja berdasarkan ID
    $result = $conn->query("SELECT * FROM pekerja WHERE id = $id");

    if ($result && $result->num_rows > 0) {
        $pekerja = $result->fetch_assoc();
    } else {
        echo "<script>alert('Maklumat pekerja tidak dijumpai!'); window.location.href = 'index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak sah!'); window.location.href = 'index.php';</script>";
    exit();
}

// Jika borang dikemaskini
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $ic = $conn->real_escape_string($_POST["no_ic"]);
    $hp = $conn->real_escape_string($_POST["no_hp"]);
    $jantina = $conn->real_escape_string($_POST["jantina"]);

    // Kemas kini maklumat pekerja
    $sql = "UPDATE pekerja SET 
                nama = '$nama', 
                no_ic = '$ic', 
                no_hp = '$hp', 
                jantina = '$jantina' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Maklumat pekerja berjaya dikemaskini!'); window.location.href = 'index.php';</script>";
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
    <title>Kemaskini Maklumat Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f1f1;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 70px;
        }
        .card {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
        }
        .card-header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            border-bottom: 2px solid #2980b9;
            text-align: center;
            font-size: 1.5rem;
        }
        .card-body {
            background-color: white;
            padding: 30px;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 12px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #2980b9;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #3498db;
        }
        .btn-secondary {
            background-color: #7f8c8d;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #95a5a6;
        }
        .back-btn {
            font-size: 1rem;
            padding: 8px 20px;
            border-radius: 10px;
            background-color: #7f8c8d;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background-color: #95a5a6;
        }
        h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Butang Kembali di luar Kotak Tajuk -->
        <a href="list.php" class="back-btn">BACK</a>
        
        <div class="card">
            <div class="card-header">
                Kemaskini Maklumat Pekerja
            </div>
            <div class="card-body">
                <form method="POST" action="update.php?id=<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" 
                               value="<?php echo isset($pekerja['nama']) ? htmlspecialchars($pekerja['nama']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_ic" class="form-label">No. IC</label>
                        <input type="text" name="no_ic" id="no_ic" class="form-control" 
                               value="<?php echo isset($pekerja['no_ic']) ? htmlspecialchars($pekerja['no_ic']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. Telefon</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" 
                               value="<?php echo isset($pekerja['no_hp']) ? htmlspecialchars($pekerja['no_hp']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jantina" class="form-label">Jantina</label>
                        <select name="jantina" id="jantina" class="form-control" required>
                            <option value="">-- Sila Pilih --</option>
                            <option value="Lelaki" <?php echo (isset($pekerja['jantina']) && $pekerja['jantina'] == 'Lelaki') ? 'selected' : ''; ?>>Lelaki</option>
                            <option value="Perempuan" <?php echo (isset($pekerja['jantina']) && $pekerja['jantina'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
