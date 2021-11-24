<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "../model_produk.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produk | Admin</title>

   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <?php require_once "sidebar.php"; ?>

   <div id="content">
      <div style="background-color: white; padding: 30px">
         <h1 style="display:inline; font-size:2em;">Halaman Produk</h1>
         <a class="button floating_button" style="color:white; font-size: 12pt; font-weight:600; text-decoration:none;" href="create_produk">Tambah Produk</a>
         <div style="margin-top:1rem;">
            <div style="float:left;">
               <h2 style="display:inline;">Kategori</h2>
               <ul style="margin-top: 0.4rem;">
                  <?php foreach ($daftar_kategori as $kt) : ?>
                     <li style="display:inline; margin-right:10px;"><a href="produk?kategori=<?= $kt['kategori']; ?>" style="text-decoration: none;"><?= $kt['kategori']; ?></a></li>
                  <?php endforeach; ?>
               </ul>
            </div>

            <div style="float: right;">
               <form class="my-form" action="" method="GET" style="margin-top: -2rem; text-align:center; width:130%; height:4em; margin:auto; display:flex; float:right;">
                  <input type="text" name="search" style="display:inline; background-color:#e3e3e3; border-radius:10rem;  padding-left: 1.4em; box-shadow: 0 0px 2px 0 rgba(0, 0, 0, 0.3)" placeholder="Cari Produk">
                  <button style="background-color:#e3e3e3; width:20%; height:70%; margin-left:-3rem; display:inline; border-radius:10rem; font-weight:600" type="submit"><img style="width: 30px; margin-top:-1em;" src="../.../../images/search_icon_2.png" alt=""></button>
               </form>
            </div>
            <a href="produk" style="text-decoration: none; margin:0.6em 8em 0em 0em; font-weight:600; float:right;">Reset</a>
         </div>
         <br><br><br>
         <table style="display: block;">
            <thead>
               <tr align="center" style="font-size:11pt">
                  <th width="2%">No</th>
                  <th width="10%">Gambar</th>
                  <th width="15%">Nama Produk</th>
                  <th width="10%">Kategori</th>
                  <th width="20%">Deskripsi Produk</th>
                  <th width="10%">Harga Produk</th>
                  <th width="10%">Stok Produk</th>
                  <th width="10%"></th>
               </tr>
            </thead>
            <tbody>
               <?php $i = 1;
               foreach ($produk as $pr) : ?>
                  <tr style="font-size:10pt">
                     <td align="center"><?= $i ?></td>
                     <td><img style="width:5rem; text-align:center; margin:auto;" src="images/<?= $pr["nama_produk"]; ?>/<?= $pr["gambar"] ?>" alt="<?= $pr["gambar"] ?>"></td>
                     <td><a style="text-decoration: none; font-weight:600;" href="detail_produk?id_produk=<?= $pr['id_produk'] ?>"><?= $pr["nama_produk"]; ?></a></td>
                     <td align="center"><?= $pr["kategori"]; ?></td>
                     <td><?= $pr["deskripsi_produk"]; ?></td>
                     <td align="right">Rp. <?= number_format($pr["harga_produk"], 0, ',', '.'); ?></td>
                     <?php if ($pr['stok_produk'] == "0") : ?>
                        <td align="center" style="color: red;">Kosong</td>
                     <?php else : ?>
                        <td align="center"><?= $pr["stok_produk"]; ?></td>
                     <?php endif; ?>
                     <td align="center">
                        <a style="text-decoration: none;" href="update_produk?id_produk=<?= $pr["id_produk"]; ?>"><img src="../images/edit.png" style="width:17px;" alt=""></a>
                        <a style="text-decoration: none;" href=" delete_produk?id_produk=<?= $pr["id_produk"]; ?>" onclick="return confirm('Yaking ingin menghapus produk?');"><img src="../images/delete.png" style="width:24px;" alt=""></a>
                     </td>
                  </tr>
               <?php $i++;
               endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</body>

<script src="../js/script.js"></script>

</html>