<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "model_produk.php";
global $conn;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produk | Modern Meds</title>
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <?php require_once "navbar.php" ?>
   <?php require_once "cart_floating_button.php" ?>

   <div class="section_w440 margin_r_20" style="position: fixed; bottom:0; top:50px;">
      <div class=""><span></span></div>
      <div class="sub_content" style="margin-top: 2rem;">
         <h2 style="display:inline; margin-bottom:1rem;">Kategori</h2>
         <a href="produk" style="float:right; text-decoration:none;">Reset</a>
         <ul class="service_list" style="margin-top:0.7rem">
            <!-- <li></li> -->
            <?php foreach ($daftar_kategori as $kt) : ?>
               <li><a href="produk?kategori=<?= $kt['kategori']; ?>" style="text-decoration:none;"><?= $kt['kategori']; ?></a></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <div class=""><span></span></div>
   </div>
   <div id="content">
      <form class="my-form" action="" method="GET" style="margin-bottom: 1rem; text-align:center; width:30%; margin:auto; display:flex;">
         <input type="text" name="search" style="display:inline; background-color:white; border-radius:10rem;  padding-left: 1.4em; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2)" placeholder="Cari Produk">
         <button style="width:25%; height:10%; margin-left:-5rem; display:inline; border-radius:10rem; font-weight:600" type="submit"><img style="width: 30px; margin:-10px;" src="images/search_icon.png" alt=""></button>
      </form>

      <div class="cleaner_h30"></div>
      <div class="section_w940" style="margin: auto; padding-bottom:99em">
         <?php foreach ($produk as $pr) : ?>
            <div class="section_w210 margin_r_20" style="border-radius: 0.2rem; padding: 1rem 5px 1rem 5px; margin:0.7rem; box-shadow: 0 0px 1px 0 rgba(0, 0, 0, 0.2)">
               <div class="sub_content">
                  <img style="width: 10rem; margin-top:1em;" src="admin/images/<?= $pr['nama_produk'] ?>/<?= $pr['gambar'] ?>" alt="" />
                  <a style="font-size: 1.3em; font-weight:1000; text-decoration:none; display:block; margin-bottom:0.2em;" href="detail_produk?id_produk=<?= $pr['id_produk'] ?>"><?= $pr['nama_produk']; ?></a>
                  <span style="font-size: 1.2em;"><b>Rp. <?= number_format($pr['harga_produk'], 0, ",", "."); ?></b> </span>
                  <p><?= $pr['deskripsi_produk']; ?></p>
                  <form action="" method="post">
                     <input type="hidden" name="id_produk" id="id_produk" value="<?= $pr['id_produk']; ?>">
                     <input type="hidden" name="nama_produk" id="nama_produk" value="<?= $pr['nama_produk']; ?>">
                     <input type="hidden" name="stok_produk" id="stok_produk" value="<?= $pr['stok_produk']; ?>">
                     <?php if ($pr['stok_produk'] == "0") : ?>
                        <p style="text-align:center; font-size:1.1em; color:red;"><b>Kosong</b></p>
                     <?php else : ?>
                        <div class="my-form" style="float: right; text-align:center">
                           <button type="submit" style="margin-top:-4px; border-radius:100em; font-size:1em; line-height:5px; font-weight:600; height:25px; width:80px;" name="btn_pesan">Pesan</button>
                        </div>
                        <p style=" font-size:1.1em;"><b>Stok : <?= $pr['stok_produk'] ?></b></p>
                     <?php endif; ?>
                  </form>
               </div>
            </div>
         <?php endforeach; ?>
      </div>

      <!-- end of a section_w940 -->
      <div class="cleaner"></div>
   </div>
</body>

<script src="js/script.js"></script>

</html>