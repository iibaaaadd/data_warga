<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kk = $_POST['id_kk'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    // Proses file upload
    $uploadDir = 'uploads/';
    $foto_ktp = $uploadDir . basename($_FILES['foto_ktp']['name']);
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $foto_ktp);

    // Query untuk menambahkan anggota baru ke tabel KTP
    $query = "INSERT INTO KTP (nik, nama, tempat_lahir, tanggal_lahir, alamat, jenis_kelamin, foto_ktp, id_kk) 
              VALUES ('$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin', '$foto_ktp', '$id_kk')";

    if (mysqli_query($conn, $query)) {
        echo "Anggota berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Arahkan kembali ke kk.php setelah proses tambah anggota selesai
    header('Location: index.php');
    exit();
} else {
    echo "Permintaan tidak valid.";
}
?>
