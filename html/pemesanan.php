<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/pemesanan.css">
    <title>Pemesanan</title>
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
              <a class="nav-link active" aria-current="page" href="pemesanan.php">Pemesanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dataPesanan.php">Daftar Pesanan</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- navbar -->
    <div class="formPemesanan py-5 px-4 bg-light">
      <form class="row g-3" method="POST">
        <div class="col-md-12">
          <label for="nama" class="form-label">Nama</label>
          <input required type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="col-md-6">
          <label for="noHP" class="form-label">Nomor HP</label>
          <input required type="number" class="form-control" id="noHP" name="noHP">
        </div>
        <div class="col-md-6">
          <label for="kodePos" class="form-label">Kode Pos</label>
          <input required type="text" class="form-control" id="kodePos" name="kodePos">
        </div>
        <div class="col-md-6">
          <label for="jumlahPesanan" class="form-label">Jumlah Pesanan</label>
          <input required type="number" min="1" class="form-control" id="jumlahPesanan" name="jumlahPesanan" placeholder="1">
        </div>
        <div class="col-md-6">
          <label for="jenisTeh" class="form-label">Jenis Teh</label>
          <select id="jenisTeh" class="form-select" name="jenisTeh">
            <option selected value="Es Teh Manis,2000">Es Teh Manis</option>
            <option value="Es Teh Tawar,3000">Es Teh Tawar</option>
            <option value="Es Lemon Tea,4000">Es Lemon Tea</option>
            <option value="Es Teh Jumbo,5000">Es Teh Jumbo</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="total" class="form-label">Total</label>
          <input required type="number" class="form-control" id="total" name="total" placeholder="0" readonly>
        </div>
        <div class="col-6">
          <button type="button" id="hitung" class="btn btn-primary">Hitung</button>
        </div>
        <div class="col-6">
          <button type="submit" name="submit" class="btn btn-success">Pesan</button>
        </div>
      </form>
    </div>
    <!-- form pemesanan -->

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