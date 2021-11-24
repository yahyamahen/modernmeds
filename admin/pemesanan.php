<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "../model_pemesanan.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pemesanan | Admin </title>
   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php require_once "sidebar.php"; ?>
   <div id="content">
      <div style="background-color: white; padding: 30px">
         <form class="my-form" action="" method="GET" style="margin-top: -2rem; text-align:center; width:30%; height:4em; margin:auto; display:flex; float:right;">
            <input type="text" name="keyword" style="display:inline; background-color:#e3e3e3; border-radius:10rem;  padding-left: 1.4em; box-shadow: 0 0px 2px 0 rgba(0, 0, 0, 0.3)" placeholder="Cari Pemesanan ">
            <button style="background-color:#e3e3e3; width:20%; height:70%; margin-left:-3rem; display:inline; border-radius:10rem; font-weight:600" type="submit" name="btn_search_pemesanan"><img style="width: 30px; margin-top:-1em;" src="../.../../images/search_icon_2.png" alt=""></button>
         </form>
         <a href="pemesanan" style="float:right; text-decoration:none; margin:0.6em 2em 0em 0em; font-weight:600;">Reset</a>
         <div>
            <h1 style="font-size: 2em; display:inline;">Daftar Pemesanan</h1>
            <br><br><br>

            <table>
               <thead>
                  <tr style="font-size: 10.5pt;">
                     <th align="center">Waktu Pemesanan</th>
                     <th align="center">Kode Pemesanan</th>
                     <th align="center">Username</th>
                     <th align="center">Produk</th>
                     <th align="center">Total</th>
                     <th align="center">Metode Pembayaran</th>
                     <th align="center">Status Pemesanan</th>
                     <th align="center"></th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1;
                  foreach ($pemesananAll as $psn) : ?>
                     <tr style="font-size: 10pt;">
                        <td width="15%" align="center"><?= $psn["waktu_pemesanan"]; ?></td>
                        <td width="10%" align="center" style="font-weight: 600;"><?= $psn["kode_pemesanan"]; ?></td>
                        <td width="10%" align="left"><?= $psn["username"]; ?></td>
                        <td width="15%">
                           <?php
                           $produkAll = query("SELECT * FROM pemesanan, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = '" . $psn['username'] . "' AND pemesanan.kode_pemesanan = '" . $psn['kode_pemesanan'] . "';"); ?>
                           <?php foreach ($produkAll as $pr) : ?>
                              <a href="detail_produk?id_produk=<?= $pr['id_produk'] ?>" style="display: block; text-decoration:none;"><b> <?= $pr["nama_produk"]; ?> </b></a>
                           <?php endforeach; ?>
                        </td>
                        <td width="10%" align="center" style="font-weight: 600;"><?= "Rp. " . number_format($psn["total"], 0, ',', '.'); ?></td>
                        <td width="5%" align="center"><?= $psn["metode_pembayaran"]; ?></td>
                        <td width="15%" align="center" style="font-weight: 600;"><?= $psn["status_pemesanan"]; ?></td>
                        <td align="center">
                           <?php if ($psn['status_pemesanan'] == 'Pesanan Selesai') : ?>
                              <form class="my-form"" action=" nota" method="post">
                                 <input type="hidden" name="kode_pemesanan" value="<?= $psn['kode_pemesanan'] ?>">
                                 <input type="hidden" name="username" value="<?= $psn['username'] ?>">
                                 <input type="hidden" name="email" value="<?= $psn['email'] ?>">
                                 <button type="submit" class="button" style="margin-top:0.4em; font-size: 0.7em; width:auto; line-height:0em;" name="btn_kirim"><img src="../images/send_email.png" style="width:24px; margin-top:-1.4em;" alt=""></button>
                              </form>
                           <?php endif; ?>
                           <?php if ($psn['status_pemesanan'] == 'Menunggu Pembayaran') : ?>
                              <form class="my-form"" action=" nota" method="post">
                                 <input type="hidden" name="kode_pemesanan" value="<?= $psn['kode_pemesanan'] ?>">
                                 <input type="hidden" name="username" value="<?= $psn['username'] ?>">
                                 <input type="hidden" name="email" value="<?= $psn['email'] ?>">
                                 <button type="submit" class="button" style="margin-top:0.4em; font-size: 0.7em; width:auto; line-height:0em;" name="btn_konfirmasi">Konfirmasi</button>
                              </form>
                           <?php else : ?>
                              <form class="my-form" action=" nota" method="post">
                                 <input type="hidden" name="kode_pemesanan" value="<?= $psn['kode_pemesanan'] ?>">
                                 <input type="hidden" name="username" value="<?= $psn['username'] ?>">
                                 <button type="submit" class="button" style="margin-top:0.4em; background-color:#7d7d7d; font-size: 0.7em; width:auto; line-height:0em;" name="detail_nota"><img src="../images/inovice.png" style="width:24px; margin-top:-1.4em;" alt=""></button>
                              </form>
                           <?php endif; ?>
                        </td>
                     </tr>
                  <?php $i++;
                  endforeach ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</body>
<script src="../js/script.js"></script>

</html>