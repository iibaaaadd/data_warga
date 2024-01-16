<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_kk'])) {
    $id_kk = $_GET['id_kk'];

    // Hapus data KK dari database
    $query = "DELETE FROM KK WHERE id_kk='$id_kk'";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Arahkan kembali ke kk.php
    header('Location: index.php');
    exit();
} else {
    echo "Permintaan tidak valid.";
}
?>
