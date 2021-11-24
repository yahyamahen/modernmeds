<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "../model_produk.php";

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
   <title>Admin | <?= $produk['nama_produk'] ?></title>

   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php require_once "sidebar.php"; ?>

   <div id="content">
      <div style="width:100%; height:33rem; background-color:white; border-radius: 1rem; padding: 2rem; margin:1rem;">
         <h1><?= $produk['nama_produk'] ?></h1>
         <div class="sub_content">
            <div style="float: left;">
               <img style="width: 20rem; margin-top:2em;" src="images/<?= $produk['nama_produk'] ?>/<?= $produk['gambar'] ?>" alt="" />
            </div>
            <p><?= $produk['deskripsi_produk']; ?></p>
            <div class="button button_01" style="float: left;">
               <a href="update_produk?id_produk=<?= $produk['id_produk'] ?>"> Update Produk</a>
            </div>
            <div class="button button_01" style="float: left;">
               <a href="delete_produk?id_produk=<?= $produk['id_produk'] ?>"> Delete Produk</a>
            </div>
            <div class="button button_01" style="float: left;">
               <a href="produk">Kembali</a>
            </div>
         </div>
      </div>
   </div>
</body>

<script src="../js/script.js"></script>

</html>