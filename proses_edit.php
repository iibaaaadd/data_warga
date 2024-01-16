<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kk = $_POST['id_kk'];
    $nomor_kk = $_POST['nomor_kk'];
    $kondisi_rumah = $_POST['kondisi_rumah'];
    $alamat = $_POST['alamat'];
    $pemilik_rumah = $_POST['pemilik_rumah'];
    $luas_tanah = $_POST['luas_tanah'];
    $luas_bangunan = $_POST['luas_bangunan'];
    $jumlah_kamar_tidur = $_POST['jumlah_kamar_tidur'];
    $jumlah_kamar_mandi = $_POST['jumlah_kamar_mandi'];
    $jenis_material_bangunan = $_POST['jenis_material_bangunan'];
    $listrik_watt = $_POST['listrik_watt'];
    $npbb = $_POST['npbb'];

    // Proses file upload
    if ($_FILES['kondisi_rumah']['size'] > 0) {
        $uploadDir = 'uploads/';
        $kondisi_rumah = $uploadDir . basename($_FILES['kondisi_rumah']['name']);
        move_uploaded_file($_FILES['kondisi_rumah']['tmp_name'], $kondisi_rumah);

        // Update data KK dengan gambar baru
        $query = "UPDATE KK SET nomor_kk='$nomor_kk', alamat='$alamat', kondisi_rumah='$kondisi_rumah', pemilik_rumah='$pemilik_rumah',
                  luas_tanah='$luas_tanah', luas_bangunan='$luas_bangunan', jumlah_kamar_tidur='$jumlah_kamar_tidur',
                  jumlah_kamar_mandi='$jumlah_kamar_mandi', jenis_material_bangunan='$jenis_material_bangunan',
                  listrik_watt='$listrik_watt', npbb='$npbb', kondisi_rumah='$kondisi_rumah' WHERE id_kk='$id_kk'";
    } else {
        // Update data KK tanpa mengubah gambar
        $query = "UPDATE KK SET nomor_kk='$nomor_kk', alamat='$alamat', pemilik_rumah='$pemilik_rumah',
                  luas_tanah='$luas_tanah', luas_bangunan='$luas_bangunan', jumlah_kamar_tidur='$jumlah_kamar_tidur',
                  jumlah_kamar_mandi='$jumlah_kamar_mandi', jenis_material_bangunan='$jenis_material_bangunan',
                  listrik_watt='$listrik_watt', npbb='$npbb' WHERE id_kk='$id_kk'";
    }

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Arahkan kembali ke kk.php
    header('Location: index.php');
    exit();
}
?>
