<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/dataPesanan.css">
    <title>Data Pesanan</title>
  </head>
  <!-- halaman ini dibuat untuk user melakukan pemesanan esteh di website ini -->
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../img/tea.png" alt="" width="30" height="24">
          Estehku
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="pemesanan.php">Pemesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="dataPesanan.php">Daftar Pesanan</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- navbar -->
    <div class="container p-3" style="min-height:500px;">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Paket</th>
                <th scope="col">Nomor Telpon</th>
                <th scope="col">Tanggal Pemesanan</th>
                <th scope="col">Jumlah Pemesanan</th>
                <th scope="col">Durasi Pemesanan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("../php/koneksiDatabase.php");
                    $sql = "SELECT * FROM datapesanan";
                    $result = mysqli_query($koneksi, $sql);
                    $index=0; //inisiasi nomor
                    if (mysqli_num_rows($result) > 0) :
                    while ($data_pesanan = mysqli_fetch_array($result)) : 
                        $index++; // increament nomor
                        ?>
                    <tr style="text-align: center;">
                    <td><?=$index?></td>
                    <td><?=$data_pesanan['nama']?></td>
                    <td><?=$data_pesanan['noHP']?></td>
                    <td><?=$data_pesanan['kodePos']?></td>
                    <td><?=$data_pesanan['jumlahPesanan']?></td>
                    <td><?=$data_pesanan['jenisTeh']?></td>
                    <td><?=$data_pesanan['total']?></td>
                    </tr>
                    <?php endwhile;
                    else: ?>
                    <td colspan="7"><p>tidak ada pesanan</p></td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- tabel data pesanan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      function hitungTotalBelanja() {
        const jumlahPesanan = document.getElementById("jumlahPesanan").value;
        const hargaJenisPaket = document.getElementById("jenisTeh").value.split(',');
        const hargaJenisPaket1 = parseInt(hargaJenisPaket[1]);

        const totalHarga = jumlahPesanan * hargaJenisPaket1;
        document.getElementById("total").value = totalHarga;
      }

      document.getElementById("hitung").addEventListener("click", hitungTotalBelanja);
    </script>
  </body>
</html>

<?php
require_once "../php/koneksiDatabase.php";

// Inisialisasi nilai variabel
$nama = "";
$noTelp = "";
$kodePos = "";
$jumlahPesanan = "";
$jenisTeh = "";
$totalHarga = "";

// Proses data yang ada di form pemesanan
if (isset($_POST["submit"])) {
    $nama = trim($_POST["nama"]);
    $noTelp = trim($_POST["noHP"]);
    $kodePos = trim($_POST["kodePos"]);
    $jumlahPesanan = trim($_POST["jumlahPesanan"]);
    $jenisTeh1 = trim($_POST["jenisTeh"]); // mengambil data jenis teh dan harga
    $jenisTeh2 = explode(",", $jenisTeh1); //memecahnya menjadi 2 bagian
    $jenisTeh = $jenisTeh2[0];
    $totalHarga = $jenisTeh2[1]*$jumlahPesanan;

    // Validasi inputan data
        $sql = "INSERT INTO datapesanan (id, nama, noHP, kodePos, jumlahPesanan, jenisTeh, total) VALUES ('', '$nama', '$noTelp', '$kodePos', '$jumlahPesanan', '$jenisTeh', '$totalHarga')";
    
    if (mysqli_query($koneksi, $sql)) {
        //berpindah ke halaman data pesanan
        echo "<script>alert('pemesananBerhasil');window.location.href = 'dataPesanan.php';</script>";
        // Reset form fields
        $nama = "";
        $noTelp = "";
        $kodePos = "";
        $jumlahPesanan = "";
        $jenisTeh = "";
        $totalHarga = "";

    }
}
?>