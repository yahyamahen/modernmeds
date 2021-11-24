<?php
session_start();
require "function.php";
require "model.php";
global $conn;

if (isset($_GET['id_produk'])) {
   $id_produk = $_GET["id_produk"];
   $produk = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
}

if (isset($_POST["submit"])) {
   if (update_produk($_POST) > 0) {
      echo
      "<script>
			alert('Data Produk Terupdate');
			document.location.href = 'produk';
		</script>";
   } else {
      echo
      "<script>
            alert('Data Produk Tidak Dapat Terupdate');
            document.location.href = 'produk';
		</script>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Update Produk | Admin</title>
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php require_once "sidebar.php"; ?>

   <div id="content">
      <div style="background-color: white; padding: 30px; width:50%; margin:auto;">
         <h1>Ubah Produk</h1>
         <form class="my-form" action="update_produk" method="post" enctype="multipart/form-data" style="margin-top: 1rem;">
            <input type="hidden" name="gambarLama" value="<?= $produk["gambar"]; ?>">
            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"]; ?>">
            <div>
               <label>Nama Produk</label>
               <input type="text" name="nama_produk" id="Nama Produk" required value="<?= $produk["nama_produk"]; ?>" placeholder="Nama Produk">
            </div>
            <div>
               <label>Kategori</label>
               <input type="text" name="kategori" required value="<?= $produk["kategori"]; ?>" placeholder="Kategori">
            </div>
            <div>
               <label>Deskripsi Produk</label>
               <input type="text" name="deskripsi_produk" required value="<?= $produk["deskripsi_produk"]; ?>" placeholder="Deskripsi Produk">
            </div>
            <div>
               <label>Harga Produk</label>
               <input type="number" name="harga_produk" required value="<?= $produk["harga_produk"]; ?>" placeholder="Harg Produk" min="0">
            </div>
            <div>
               <label>Stok Produk</label>
               <input type="number" name="stok_produk" required value="<?= $produk["stok_produk"]; ?>" placeholder="Stok Produk" min="0">
            </div>
            <div>
               <label>Gambar</label>
               </br>
               <img height="130px" src="images/<?= $produk['nama_produk']; ?>/<?= $produk['gambar'] ?>" alt="<?= $produk['nama_produk']; ?>"><br>
               <input type="file" name="gambar" id="gambar">
            </div>
            <div style="text-align: center;">
               <button style="width: 20rem;" type="submit" name="submit">Update Produk</button>
            </div>
         </form>
      </div>
   </div>
</body>

</html>