<?php
include 'connection.php';

$sql = "SELECT * FROM pekerja";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Maklumat Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 10px;
            background-color: #283593;
            border-radius: 10px;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .card-header {
            background-color: #283593;
            color: white;
            padding: 5px 20px; /* Mengecilkan padding dalam header */
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: auto; /* Tidak menetapkan ketinggian tetap */
        }
        .table {
            border-radius: 15px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px 25px;
            color: #333;
        }
        .table th {
            background-color: #1e2a8a;
            color: white;
            font-weight: 600;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #e8f0fe;
        }
        .table-striped tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        .table-hover tbody tr:hover {
            background-color: #c5cae9;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #1e2a8a;
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background-color: #283593;
        }
        .btn-danger {
            background-color: #f44336;
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
        }
        .btn-secondary {
            background-color: #8e8e8e;
            border: none;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #757575;
        }
        .back-btn {
            font-size: 1rem;
            padding: 8px 20px;
            border-radius: 10px;
            background-color: #8e8e8e;
            color: white;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #757575;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Senarai Maklumat Pekerja</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No IC</th>
                            <th>No HP</th>
                            <th>Jantina</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['no_ic']}</td>
                                <td>{$row['no_hp']}</td>
                                <td>{$row['jantina']}</td>
                                <td>
                                    <a href='update.php?id={$row['id']}' class='btn btn-primary btn-sm'>Update</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="index.php" class="back-btn">BACK</a>
            </div>
        </div>
    </div>
</body>
</html>
