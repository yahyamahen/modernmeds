<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
ob_start();

if (isset($_POST['detail_nota'])) {
   $kode_pemesanan = $_POST['kode_pemesanan'];
   $username = $_POST['username'];
   $pemesanan = query("SELECT * FROM pemesanan, customers, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = '$username' AND pemesanan.kode_pemesanan = '$kode_pemesanan' AND customers.username = '$username' GROUP BY pemesanan.kode_pemesanan ORDER BY waktu_pemesanan DESC;");
   // $produk = query("SELECT * FROM pemesanan, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.kode_pemesanan = '$kode_pemesanan' AND pemesanan.username = '$username'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <title>Nota | Modern Meds</title>

   <link rel="stylesheet" href="css/styles.css">

   <style>
      table {
         width: 100%;
         border-collapse: collapse;
         text-align: center;
         border: 1px solid grey;
         font-size: 12px;
      }
   </style>
</head>

<body>
   <?php foreach ($pemesanan as $psn) : ?>
      <div style="text-align: center;">
         <img style="width: 7em; display:inline;" src="images/modernmeds_logo.png" alt="">
         <h1 style="text-align: center; display:inline;">HEALTH STORE</h1>
      </div>
      <p style=" text-align: center;">Jl. Manukan Kulon No. 57, Kec. Tandes, Kota. Surabaya</p>
      <h3 style="text-decoration:underline; text-align: center; line-height:-0.1em; margin-top:1.5em;">NOTA PEMBAYARAN</h3>
      <h4 style="text-align: center; line-height:-10em;">Kode : <?= $psn['kode_pemesanan'] ?></h4>

      <div style="margin-bottom: 1em;">
         <div style="width:49%; float:left;">
            <p>Nama Pelanggan : <?= $psn['nama_lengkap'] ?></p>
            <p style="line-height: 0em;">Alamat : <?= $psn['alamat'] ?></p>
            <p>Email : <?= $psn['email'] ?></p>
            <p>No Telp Pelanggan : <?= $psn['no_telp'] ?></p>
         </div>
         <div style="width:50%; float:right;">
            <p>Waktu Pemesanan : <?= $psn['waktu_pemesanan'] ?></p>
            <p>Metode Pembayaran : <?= $psn['metode_pembayaran'] ?></p>
            <?php if ($psn['metode_pembayaran'] == 'debit') : ?>
               <p>Paypal ID : <?= $psn['paypal_id'] ?></p>
            <?php endif; ?>
            <p>Catatan Pemesanan : <?= $psn['catatan_pemesanan'] ?></p>
            <p>Status Pemesanan : <?= $psn['status_pemesanan'] ?></p>
         </div>

      </div>

      <p>Daftar Produk : </p>
      <table border="1">
         <thead>
            <tr>
               <th width="5%">No</th>
               <th width="40%">Nama Produk</th>
               <th width="15%">Jumlah Produk</th>
               <th width="20%">Harga Produk</th>
               <th width="20%">Jumlah</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1;
            $total_jumlah = 0;
            $produk = query("SELECT * FROM pemesanan, customers, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = '$username' AND pemesanan.kode_pemesanan = '$kode_pemesanan' AND customers.username = '$username' GROUP BY pemesanan.id_produk ORDER BY waktu_pemesanan DESC;");
            foreach ($produk as $pr) : ?>
               <tr>
                  <td align="center"><?= $i++; ?></td>
                  <td><?= $pr['nama_produk'] ?></td>
                  <td align="center"><?= $pr['total_pcs'] ?></td>
                  <td align="right">Rp. <?= number_format($pr['harga_produk'], 2, ',', '.') ?></td>
                  <td align="right">Rp. <?= number_format($pr['total_pcs'] * $pr['harga_produk'], 2, ',', '.') ?></td>
                  <?php $total_jumlah = $total_jumlah + $pr['total_pcs'] * $pr['harga_produk'] ?>
               </tr>
            <?php endforeach; ?>
            <?php if ($psn['metode_pembayaran'] == 'debit') : ?>
               <tr>
                  <td align="center"><?= $i++; ?></td>
                  <td>Kode Unik </td>
                  <td></td>
                  <td align="right">Rp. <?= number_format($psn['total'] - $total_jumlah, 0, ',', '.') ?></td>
                  <td align="right">Rp. <?= number_format($psn['total'] - $total_jumlah, 0, ',', '.') ?></td>
               </tr>
            <?php endif; ?>
            <tr>
               <td colspan="3"></td>
               <td align="center"> Total</td>
               <td align="right">Rp. <?= number_format($psn['total'], 2, ',', '.') ?></td>
            </tr>
         </tbody>
      </table>


      <div style="float:right; text-align:right; margin-right:5em">
         <img style="width: 18em; bottom: 0; margin:2em -5em -4em 0em;" src="images/ttd.png" alt="">
         <p class="mt-4 mb-n1" style="text-decoration: underline;"> <strong>Rizqi Yahya Mahendra</strong> </p>
      </div>


      <?php
      $html = ob_get_contents();
      ob_end_clean();
      $mpdf->WriteHTML(utf8_encode($html));
      $filename = $psn['username'] . "_" . $psn['kode_pemesanan'] . ".pdf";

      if ($psn['kode_pemesanan'] != null) {
         $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
      }
      ?>
   <?php endforeach; ?>
</body>

</html>