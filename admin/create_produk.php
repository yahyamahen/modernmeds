<?php
session_start();
require "function.php";
require "model.php";

if (isset($_POST["submit"])) {
   if (create_produk($_POST) > 0) {
      echo "
				<script>
					alert('data berhasil ditambahkan');
					document.location.href = 'produk';
				</script>
			";
   } else {
      echo "
				<script>
					alert('data gagal ditambahkan');
					document.location.href = 'create_produk';
				</script>
			";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create Produk | Admin</title>
   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php require_once "sidebar.php"; ?>

   <div id="content">
      <div style="background-color: white; padding: 30px; width:50%; margin:auto;">
         <h1 style="font-size: 2em;">Create Produk</h1>
         <form class="my-form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <br>
            <label>Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>

            <br>
            <label>Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori" required>

            <br>
            <label>Deskripsi Produk</label>
            <input type="text" class="form-control" id="deskripsi_produk" name="deskripsi_produk" placeholder="Deskripsi Produk" required>

            <br>
            <label>Harga Produk</label>
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga Produk" min="1" required>

            <br>
            <label>Stok Produk</label>
            <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Stok Produk" min="1" required>

            <br>
            <label>Gambar</label>
            </br>
            <input type="file" name="gambar" id="gambar">

            <div style="text-align: center;">
               <button style="width: 20rem; margin:auto" type="submit" name="submit">Submit</button>
            </div>
         </form>
      </div>
   </div>
</body>

<script src="../js/script.js"></script>

</html>