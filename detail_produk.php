<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "model_produk.php";
global $conn;

if (isset($_GET['id_produk'])) {
   $id_produk = $_GET['id_produk'];
   $produk = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $produk['nama_produk'] ?> | Modern Meds</title>
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <?php require_once "navbar.php" ?>
   <div class="section_w440 margin_r_20" style="position: fixed; bottom:0; top:50px;">
      <div class=""><span></span></div>
      <div class="sub_content" style="margin-top: 2rem;">
         <h2 style="display:inline; margin-bottom:1rem;">Produk Lain</h2>
         <ul class="service_list" style="margin-top:0.7rem">
            <!-- <li></li> -->
            <?php foreach ($produk_random as $prd) : ?>
               <li><a href="detail_produk?id_produk=<?= $prd['id_produk']; ?>" style="text-decoration:none;"><?= $prd['nama_produk']; ?></a></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <div class=""><span></span></div>
   </div>
   <div id="content">
      <!-- <form class="my-form" action="" method="GET" style="margin-bottom: 1rem; text-align:center; width:30%; margin:auto; display:flex;">
         <input type="text" name="search" style="display:inline; background-color:white; border-radius:10rem;">
         <button style="width:30%; height:10%; margin-left:-5rem; display:inline; border-radius:10rem;" type="submit">Cari</button>
      </form> -->

      <div style="margin: auto;">
         <div style="width:100%; height:33rem; background-color:white; border-radius: 0.2rem; padding: 2rem; margin:1rem;">
            <h1><?= $produk['nama_produk'] ?></h1>
            <div class="sub_content">
               <div style="float: left; margin-right:1.5em;">
                  <img style="width: 20rem; margin-top:2em;" src="admin/images/<?= $produk['nama_produk'] ?>/<?= $produk['gambar'] ?>" alt="" />
               </div>
               <p style="font-size: 1.3em;"><strong>Kategori : <?= $produk['kategori'] ?></strong></p>
               <p style="font-size: 1.3em;"><strong>Harga : Rp. <?= number_format($produk['harga_produk'], 0, ",", ".") ?></strong></p>
               <?php if ($produk['stok_produk'] == 0) : ?>
                  <p style="font-size: 1.3em; color:red"><strong>Kosong</strong></p>
               <?php else : ?>
                  <p style="font-size: 1.3em;"><strong>Stok Produk : <?= $produk['stok_produk']; ?></strong></p>
               <?php endif; ?>
               <label style="display: block; font-size: 1.3em;"" for=" deskripsi"><strong>Deskripsi Produk</strong></label>
               <p style="font-size: 1.2em;"><?= $produk['deskripsi_produk']; ?></p>
               <div class="my-form" style="float: left;"><button type="FALSE" style="background-color:#aeaeae; border-radius: 100em; font-weight:600 ;; padding:0.8em 1em;">Stok : <?= $produk['stok_produk'] ?></button></div>
               <form action="" method="post" class="my-form">
                  <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id_produk']; ?>">
                  <input type="hidden" name="nama_produk" id="nama_produk" value="<?= $produk['nama_produk']; ?>">
                  <input type="hidden" name="stok_produk" id="stok_produk" value="<?= $produk['stok_produk']; ?>">
                  <div class="my-form">
                     <button style="width: 6rem; margin-left:1rem; font-weight:600; border-radius:100em" type="submit" name="btn_pesan">Pesan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <!-- end of a section_w940 -->
      <div class="cleaner"></div>
   </div>
</body>

<script src="js/script.js"></script>

</html>