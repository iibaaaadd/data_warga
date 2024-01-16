<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KK</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3 text"><b>DATA WARGA</b></h2>
        <!-- Tombol Tambah -->
        <div class="">
            <button type="button" class="btn btn-primary text-center mb-2 " data-toggle="modal" data-target="#tambahModal">
                Tambah
            </button>
        </div>

        <table id="dttb" class="table table-bordered text-center table-hover mt-3">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Nomor KK</th>
                    <th>Alamat</th>
                    <th>Jumlah Anggota</th>
                    <th>Kondisi Rumah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                $query = "SELECT KK.*, COUNT(KTP.id_ktp) AS jumlah_anggota
                FROM KK
                LEFT JOIN KTP ON KK.id_kk = KTP.id_kk
                GROUP BY KK.id_kk";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= str_repeat('*', strlen($row['nomor_kk']) - 3) . substr($row['nomor_kk'], -3) ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td class="text-center">
                            <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#detail_anggota<?= $row['id_kk'] ?>'>Detail</button>
                            <br>
                            <?= $row['jumlah_anggota'] ?>
                        </td>
                        <td class="text-center">
                            <button type='button' class='btn btn-info btn-sm mb-2' data-toggle='modal' data-target='#detail_rumah<?= $row['id_kk'] ?>'>Detail</button>
                            <br>
                            <img src='<?= $row['kondisi_rumah'] ?>' alt='Gambar' style='max-width: 100px; max-height: 100px;' class="rounded">
                        </td>
                        <td class="text-nowrap">
                            <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal<?= $row['id_kk'] ?>'>Edit</button>
                            <a href='proses_hapus.php?id_kk=<?= $row['id_kk'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Apakah Anda yakin ingin menghapus data?")'>Hapus</a>
                            <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#tambahAnggotaModal<?= $row['id_kk'] ?>'>Tambah Anggota</button>
                        </td>
                    </tr>


                    <div class='modal' id='editModal<?= $row['id_kk'] ?>'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>

                                <div class='modal-header'>
                                    <h4 class='modal-title'>Edit Data</h4>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                </div>
                                <form action='proses_edit.php' method='post' enctype="multipart/form-data">

                                    <div class='modal-body'>
                                        <input type='hidden' name='id_kk' value='<?= $row['id_kk'] ?>'>
                                        <div class='form-group'>
                                            <label for='nomor_kk'>Nomor KK :</label>
                                            <input type='text' class='form-control' id='nomor_kk' name='nomor_kk' value='<?= $row['nomor_kk'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='alamat'>Alamat :</label>
                                            <input type='text' class='form-control' id='alamat' name='alamat' value='<?= $row['alamat'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='kondisi_rumah'>Kondisi Rumah :</label>
                                            <input type='file' class='form-control-file' id='kondisi_rumah' name='kondisi_rumah' accept='image/*'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='pemilik_rumah'>Pemilik Rumah :</label>
                                            <input type='text' class='form-control' id='pemilik_rumah' name='pemilik_rumah' value='<?= $row['pemilik_rumah'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='luas_tanah'>Luas Tanah :</label>
                                            <input type='text' class='form-control' id='luas_tanah' name='luas_tanah' value='<?= $row['luas_tanah'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='luas_bangunan'>Pemilik Bangunan :</label>
                                            <input type='text' class='form-control' id='luas_bangunan' name='luas_bangunan' value='<?= $row['luas_bangunan'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='jumlah_kamar_tidur'>Jumlah Kamar Tidur :</label>
                                            <input type='text' class='form-control' id='jumlah_kamar_tidur' name='jumlah_kamar_tidur' value='<?= $row['jumlah_kamar_tidur'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='jumlah_kamar_mandi'>Jumlah Kamar Mandi :</label>
                                            <input type='text' class='form-control' id='jumlah_kamar_mandi' name='jumlah_kamar_mandi' value='<?= $row['jumlah_kamar_mandi'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='jenis_material_bangunan'>Jenis Material Bangunan :</label>
                                            <input type='text' class='form-control' id='jenis_material_bangunan' name='jenis_material_bangunan' value='<?= $row['jenis_material_bangunan'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='listrik_watt'>Listrik (Watt) :</label>
                                            <input type='text' class='form-control' id='listrik_watt' name='listrik_watt' value='<?= $row['listrik_watt'] ?>' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='npbb'>NPBB :</label>
                                            <input type='text' class='form-control' id='npbb' name='npbb' value='<?= $row['npbb'] ?>' required>
                                        </div>

                                    </div>

                                    <div class='modal-footer'>
                                        <button type='submit' class='btn btn-success'>Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class='modal' id='tambahAnggotaModal<?= $row['id_kk'] ?>'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>

                                <div class='modal-header'>
                                    <h4 class='modal-title'>Tambah Anggota Keluarga</h4>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                </div>
                                <form action='proses_tambah_anggota.php' method='post' enctype="multipart/form-data">
                                <div class='modal-body'>
   
                                        <input type='hidden' name='id_kk' value='<?= $row['id_kk'] ?>'>
                                        <div class='form-group'>
                                            <label> NIK:</label>
                                            <input type='text' class='form-control' id='nik' name='nik' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Nama :</label>
                                            <input type='text' class='form-control' id='nama' name='nama' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Tempat Lahir:</label>
                                            <input type='text' class='form-control' id='tempat_lahir' name='tempat_lahir' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Tanggal Lahir:</label>
                                            <input type='date' class='form-control' id='tanggal_lahir' name='tanggal_lahir' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Alamat:</label>
                                            <input type='text' class='form-control' id='alamat' name='alamat' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Jenis Kelamin:</label>
                                            <input type='text' class='form-control' id='jenis_kelamin' name='jenis_kelamin' required>
                                        </div>
                                        <div class='form-group'>
                                            <label> Foto KTP:</label>
                                            <input type='file' class='form-control' id='foto_ktp' name='foto_ktp' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='nomor_kk'>Nomor KK:</label>
                                            <input type='text' class='form-control' id='nomor_kk' name='nomor_kk' value='<?= $row['nomor_kk'] ?>' required>
                                        </div>
                                </div>

                                <div class='modal-footer'>
                                    <button type='submit' class='btn btn-success'>Tambah</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class='modal' id='detail_anggota<?= $row['id_kk'] ?>'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>

                        <div class='modal-header'>
                            <h4 class='modal-title'>Detail Anggota</h4>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        </div>

                        <div class='modal-body'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Foto KTP</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $idk = $row['id_kk'];
                                    $queryAnggota = "SELECT * FROM KTP WHERE id_kk ='$idk'";
                                    $resultAnggota = mysqli_query($conn, $queryAnggota);

                                    while ($anggota = mysqli_fetch_assoc($resultAnggota)) { ?>
                                        <tr>
                                            <td><?= str_repeat('*', strlen($anggota['nik']) - 3) . substr($anggota['nik'], -3) ?></td>
                                            <td><?= $anggota['nama'] ?></td>
                                            <td><?= $anggota['tempat_lahir'] ?></td>
                                            <td><?= $anggota['tanggal_lahir'] ?></td>
                                            <td><?= $anggota['alamat'] ?></td>
                                            <td><?= $anggota['jenis_kelamin'] ?></td>
                                            <td><img src="<?= $anggota['foto_ktp'] ?>" alt='Foto KTP' style='max-width: 100px; max-height: 100px;'></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tutup</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class='modal' id='detail_rumah<?= $row['id_kk'] ?>'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>

                        <div class='modal-header text-center'>
                            <h4 class='modal-title'>DETAIL RUMAH</h4>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        </div>

                        <div class='modal-body'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Pemilik Rumah</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Jumlah Kamar Tidur</th>
                                        <th>Jumlah Kamar Mandi</th>
                                        <th>Jenis Material bangunan</th>
                                        <th>Listrik (watt)</th>
                                        <th>NPBB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $row['pemilik_rumah'] ?></td>
                                        <td><?= $row['luas_tanah'] ?></td>
                                        <td><?= $row['luas_bangunan'] ?></td>
                                        <td><?= $row['jumlah_kamar_mandi'] ?></td>
                                        <td><?= $row['jumlah_kamar_tidur'] ?></td>
                                        <td><?= $row['jenis_material_bangunan'] ?></td>
                                        <td><?= $row['listrik_watt'] ?></td>
                                        <td><?= $row['npbb'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tutup</button>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Modal Tambah -->
        <div class="modal" id="tambahModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Header Modal -->
                    <div class="modal-header">
                        <h4 class="modal-title ">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Body Modal -->
                    <div class="modal-body">
                        <!-- Form tambah data KK -->
                        <form action="proses_tambah.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nomor_kk">Nomor KK:</label>
                                <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="kondisi_rumah">Kondisi Rumah:</label>
                                <input type="file" class="form-control" id="kondisi_rumah" name="kondisi_rumah" required>
                            </div>
                            <div class="form-group">
                                <label for="pemilik_rumah">Pemilik Rumah:</label>
                                <input type="text" class="form-control" id="pemilik_rumah" name="pemilik_rumah" required>
                            </div>
                            <div class="form-group">
                                <label for="luas_tanah">Luas Tanah:</label>
                                <input type="number" class="form-control" id="luas_tanah" name="luas_tanah" required>
                            </div>
                            <div class="form-group">
                                <label for="luas_bangunan">Luas Bangunan:</label>
                                <input type="number" class="form-control" id="luas_bangunan" name="luas_bangunan" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_kamar_tidur">Jumlah Kamar Tidur:</label>
                                <input type="number" class="form-control" id="jumlah_kamar_tidur" name="jumlah_kamar_tidur" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_kamar_mandi">Jumlah Kamar Mandi:</label>
                                <input type="number" class="form-control" id="jumlah_kamar_mandi" name="jumlah_kamar_mandi" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_material_bangunan">Jenis Material Bangunan:</label>
                                <input type="text" class="form-control" id="jenis_material_bangunan" name="jenis_material_bangunan" required>
                            </div>
                            <div class="form-group">
                                <label for="listrik_watt">Listrik (watt):</label>
                                <input type="number" class="form-control" id="listrik_watt" name="listrik_watt" required>
                            </div>
                            <div class="form-group">
                                <label for="npbb">NPBB:</label>
                                <input type="number" class="form-control" id="npbb" name="npbb" required>
                            </div>
                            <!-- Anda dapat menambahkan lebih banyak kolom sesuai kebutuhan -->

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>

                    <!-- Footer Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan Popper.js (diperlukan oleh Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
      // Inisialisasi DataTable
      $('#dttb').DataTable();
    });
  </script>
</body>

</html>