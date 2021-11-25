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
   <title><?= $produk['nama_produk'] ?> | Admin</title>
   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php require_once "sidebar.php"; ?>

   <div id="content">
      <div style="width:100%; min-height:33rem; background-color:white; border-radius: 0.4rem; padding: 2rem; margin:1rem;">
         <h1><?= $produk['nama_produk'] ?></h1>
         <div class="sub_content">
            <div style="float: left; margin-right:1.5em;">
               <img style="width: 20rem; margin-top:2em;" src="images/<?= $produk['nama_produk'] ?>/<?= $produk['gambar'] ?>" alt="" />
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
            <a class=" button" style="width: auto; padding:-1em 2em; padding-right:2.4em; background-color:orange; float:left; color:white; margin-right:1em; font-weight:800; text-decoration:none;" href="update_produk?id_produk=<?= $produk['id_produk'] ?>"><img src="../images/edit.png" style="width:17px;" alt=""><img src="../images/edit_light.png" style="width:19px; padding-top:0.2em" alt=""></a></a>
            <a class="button" onclick="return confirm('Yakin ingin menghapus produk?');" style="width: auto; padding:0em 2em; background-color:red; float:left; color:white; margin-right:1em; font-weight:800; text-decoration:none;" href="produk?delete_produk=<?= $produk['id_produk'] ?>">
               <img src="../images/delete_light.png" style="width:22px; padding-top:0.5em" alt=""></a>
            <a class="button" style="background-color: #a0a0a0; float:left; color:white; margin-right:1em; font-weight:800; text-decoration:none;" href="produk">Kembali</a>
         </div>
      </div>
   </div>
</body>

<script src="../js/script.js"></script>

</html>