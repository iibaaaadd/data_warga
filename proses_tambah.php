<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_kk = $_POST['nomor_kk'];
    $alamat = $_POST['alamat'];
    $kondisi_rumah = $_POST['kondisi_rumah'];
    $pemilik_rumah = $_POST['pemilik_rumah'];
    $luas_tanah = $_POST['luas_tanah'];
    $luas_bangunan = $_POST['luas_bangunan'];
    $jumlah_kamar_tidur = $_POST['jumlah_kamar_tidur'];
    $jumlah_kamar_mandi = $_POST['jumlah_kamar_mandi'];
    $jenis_material_bangunan = $_POST['jenis_material_bangunan'];
    $listrik_watt = $_POST['listrik_watt'];
    $npbb = $_POST['npbb'];
    
    // Proses file upload
    $uploadDir = 'uploads/';  // Folder tempat menyimpan file
    $kondisi_rumah = $uploadDir . basename($_FILES['kondisi_rumah']['name']);
    move_uploaded_file($_FILES['kondisi_rumah']['tmp_name'], $kondisi_rumah);

    // Selanjutnya, lakukan penyimpanan data ke database sesuai dengan kebutuhan

    // Contoh query untuk menyimpan ke tabel KK
    $query = "INSERT INTO KK (nomor_kk, alamat, kondisi_rumah, pemilik_rumah, 
              luas_tanah, luas_bangunan, jumlah_kamar_tidur, jumlah_kamar_mandi,
              jenis_material_bangunan, listrik_watt, npbb) 
              VALUES ('$nomor_kk', '$alamat', '$kondisi_rumah', '$pemilik_rumah', 
                      '$luas_tanah', '$luas_bangunan', '$jumlah_kamar_tidur', 
                      '$jumlah_kamar_mandi', '$jenis_material_bangunan', 
                      '$listrik_watt', '$npbb')";

    if (mysqli_query($conn, $query)) {
      echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
}
?>
