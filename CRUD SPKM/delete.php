<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pekerja WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Paparkan popup berjaya dipadam
        echo "<script>
                alert('Rekod berjaya dipadam!');
                window.location.href = 'list.php'; // Arahkan pengguna ke senarai pekerja
              </script>";
    } else {
        // Paparkan mesej ralat jika gagal
        echo "<script>
                alert('Ralat: " . $conn->error . "');
              </script>";
    }
}
?>
