<?php
session_start();
require_once "function.php";
if_not_login_back_to_home();
require_once "model.php";
require_once "model_pemesanan.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pemesanan | Modern Meds</title>

   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <?php require_once "navbar.php" ?>
   <div style="width:70%; clear: both;margin: auto; padding: 40px 20px; margin-top:2rem;">
      <div style="padding:20px; background-color:white;">
         <h1 style="margin-bottom:2rem; text-align:center; font-size:2em">Riwayat Pemesanan</h1>
         <table style="margin:auto">
            <thead>
               <tr style="font-size:13px;">
                  <th width="15%" align="center">Waktu Pemesanan</th>
                  <th width="15%" align="center">Kode Pemesanan</th>
                  <th width="15%" align="center">Produk</th>
                  <th width="10%" align="center">Total</th>
                  <th width="10%" align="center">Metode Pembayaran</th>
                  <th width="15%" align="center">Status Pemesanan</th>
                  <th width="15%" align="center"></th>
               </tr>
            </thead>
            <tbody>
               <?php $i = 1;
               foreach ($pemesanan as $psn) : ?>
                  <tr>
                     <td align="center"><?= $psn["waktu_pemesanan"]; ?></td>
                     <td align="center"><b><?= $psn["kode_pemesanan"]; ?></b></td>
                     <td>
                        <?php $produk = query("SELECT * FROM pemesanan, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = '" . $psn['username'] . "' AND pemesanan.kode_pemesanan = '" . $psn['kode_pemesanan'] . "';"); ?>

                        <!-- Nek bisa kyk gini enak -->

                        <?php foreach ($produk as $pr) : ?>
                           <a href="detail_produk?id_produk=<?= $pr['id_produk'] ?>" style="text-decoration: none; display:block; font-weight:700;"><?= $pr["nama_produk"]; ?></a>
                        <?php endforeach; ?>
                     </td>
                     <td align="center"><b><?= "Rp. " . number_format($psn["total"], 0, ',', '.'); ?></b></td>
                     <td align="center"><?= $psn["metode_pembayaran"]; ?></td>
                     <td align="center"><b><?= $psn["status_pemesanan"]; ?></b></td>
                     <?php if ($psn['status_pemesanan'] == 'Pesanan Selesai') : ?>
                        <td>
                           <form class="my-form" action="nota" method="post">
                              <input type="hidden" name="kode_pemesanan" value="<?= $psn['kode_pemesanan'] ?>">
                              <input type="hidden" name="username" value="<?= $psn['username'] ?>">
                              <button type="submit" name="detail_nota" style="font-size:0.9em; height:100%; width:75%; margin:none;">Detail Nota</button>
                           </form>
                        </td>
                     <?php endif; ?>
                  </tr>
               <?php $i++;
               endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</body>

<script src="js/script.js"></script>

</html>

<!-- Sippp dapet mamam
Berangkat sek -->