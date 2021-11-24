<?php
session_start();
require_once "function.php";
require_once "model.php";
require_once "model_produk.php";
require_once "model_cart.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart | Modern Meds</title>

   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <?php require_once "navbar.php" ?>
   <div class="section_w440 margin_r_20" style="position: fixed; bottom:0; top:50px;">
      <div class=""><span></span></div>
      <div class="sub_content" style="margin-top: 2rem;">
         <h2 style="display:inline; margin-bottom:1rem;">Kategori</h2>
         <a href="cart" style="float:right; text-decoration:none;">Reset</a>
         <ul class="service_list" style="margin-top:0.7rem">
            <!-- <li></li> -->
            <?php foreach ($daftar_kategori as $kt) : ?>
               <li><a href="cart?kategori=<?= $kt['kategori']; ?>" style="text-decoration:none;"><?= $kt['kategori']; ?></a></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <div class=""><span></span></div>
   </div>
   <div id="content">
      <div style=" float: left; background-color:white; padding:30px; width:40rem;">
         <h1 style="display:inline; font-size:1.8em;">Cart Pemesanan</h1>
         <form class="my-form" action="" method="GET" style="margin-top: -2rem; text-align:center; width:45%; height:4em; margin:auto; display:flex; float:right;">
            <input type="text" name="search" style="display:inline; background-color:#e3e3e3; border-radius:10rem;  padding-left: 1.4em; box-shadow: 0 0px 2px 0 rgba(0, 0, 0, 0.3)" placeholder="Cari Produk">
            <button style="background-color:#e3e3e3; width:20%; height:70%; margin-left:-3rem; display:inline; border-radius:10rem; font-weight:600" type="submit"><img style="width: 30px; margin-top:-7.5px;" src="images/search_icon_2.png" alt=""></button>
         </form>
         <table style="margin-top:1rem">
            <thead>
               <tr>
                  <th width=2%>No</th>
                  <th width=10%>Gambar</th>
                  <th width=20%>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Stok Produk</th>
                  <th width=5%>Total Pcs</th>
                  <th width=15%>Harga Produk</th>
                  <th width=20%>Jumlah</th>
                  <th width=7%></th>
               </tr>
            </thead>
            <tbody>
               <form action="" method="post" class="my-form">
                  <?php $i = 1;
                  foreach ($cart as $crt) : ?>
                     <tr>
                        <td align="center"><?= $i ?></td>
                        <td><img style="width: 4rem;" src="admin/images/<?= $crt["nama_produk"]; ?>/<?= $crt["gambar"] ?>" alt="<?= $crt["gambar"] ?>"></td>
                        <td><a style="text-decoration: none;" href="detail/<?= $crt["nama_produk"]; ?>"><b><?= $crt["nama_produk"]; ?></b></a></td>
                        <td><?= $crt["kategori"]; ?></td>
                        <td align="center"><?= $crt["stok_produk"]; ?></td>
                        <td><input type="number" style="text-align:center;" name="total_pcs[]" id="total_pcs" value="<?= $crt['total_pcs'] ?>" step="1" min="1" max="<?= $crt['stok_produk'] ?>" autocomplete="off"></td>
                        <td align="right"> Rp. <?= number_format($crt["harga_produk"], 0, ",", "."); ?></td>
                        <td align="right"><b> Rp. <?= number_format($crt["total_pcs"] * $crt["harga_produk"], 0, ",", "."); ?> </b></td>
                        <td align="center">
                           <input type="hidden" name="id_produk[]" id="id_produk" value="<?= $crt['id_produk'] ?>">
                           <input type="hidden" name="nama_produk[]" id="nama_produk" value="<?= $crt['nama_produk'] ?>">
                           <input type="hidden" name="stok_produk[]" id="stok_produk" value="<?= $crt['stok_produk'] ?>">
                           <input type="hidden" name="username" id="username" value="<?= $username ?>">
                           <input type="hidden" name="total_data_cart" id="total_data_cart" value="<?= $i; ?>">
                           <a href=" cart?delete_cart=<?= $crt["id_produk"]; ?>" style="display: block; text-decoration: none;" onclick="return confirm('Yakin akan dihapus?');"><img style="width: 18px;" src="images/delete.png" alt="delete.png"></a>
                        </td>
                     </tr>
                  <?php $i++;
                  endforeach ?>
                  <tr>
                     <td colspan="4"></td>
                     <td align="center">
                        <h3 style="font-size: 1.2em;">TOTAL</h5>
                     </td>
                     <td align="center" colspan="2">
                        <?php foreach ($total as $tl) : ?>
                           <h3 style="font-size: 1rem;">Rp. <?= number_format($tl['total'], 0, ',', '.'); ?></h3>
                        <?php endforeach; ?>
                     </td>
                     <td colspan="2" class="my-form" align="right">
                        <button type="submit" name="btn_update_cart" style="border-radius:100em; font-size: 12px; font-weight:bold;">Update Cart</button>
                     </td>
                  </tr>
               </form>
            </tbody>
         </table>
      </div>

      <div style="width: 28rem; padding:30px; background-color: white; float: right;">
         <h1 style="margin-bottom:1rem; font-size:1.8em;">Detail Pemesanan</h1>
         <form class="my-form" action="" method="post">
            <?php $i = 0;
            foreach ($cart as $crt) : ?>
               <input type="hidden" name="id_produk[]" id="id_produk" value="<?= $crt['id_produk'] ?>">
               <input type="hidden" name="nama_produk[]" id="nama_produk" value="<?= $crt['nama_produk'] ?> required" required>
               <input type="hidden" name="total_pcs[]" id="total_pcs" value="<?= $crt['total_pcs'] ?>" required>
               <input type="hidden" name="username" id="username" value="<?= $username ?>">
               <input type="hidden" name="total_data_cart" id="total_data_cart" value="<?= $i; ?>">
            <?php $i++;
            endforeach; ?>
            <?php foreach ($total as $tl) : ?>
               <input type="hidden" name="total" id="total" value="<?= $tl['total'] ?>">
            <?php endforeach; ?>
            <?php foreach ($user as $usr) : ?>
               <label for="nama_lengkap">Nama Lengkap</label><br>
               <input type="text" name="nama_lengkap" value="<?= $usr['nama_lengkap'] ?>" placeholder="Nama Lengkap" autocomplete="off" required>
               <label for="no_telp">No Telepon</label><br>
               <input type="number" name="no_telp" value="<?= $usr['no_telp'] ?>" placeholder="No Telp" required autocomplete="off" min="0">
               <label for="gender">Gender</label><br>
               <input type="hidden" value="<?= $usr['gender'] ?>" id="get_gender">
               <select name="gender" id="gender">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
               </select>
               <label for="alamat">Alamat</label><br>
               <textarea type="text" name="alamat" value="<?= $usr['alamat'] ?>" placeholder="Alamat" col=20 rows="4" required><?= $usr['alamat'] ?></textarea>
               <label for="kota">Kota</label><br>
               <input type="text" name="kota" value="<?= $usr['kota'] ?>" placeholder="Kota" required>
               <label for="paypal_id">Paypal ID</label><br>
               <input type="number" name="paypal_id" value="<?= $usr['paypal_id'] ?>" placeholder="Paypal ID" required autocomplete="off" min="0">
               <label for="catatan_pemesanan">Catatan Pemesanan</label><br>
               <textarea name="catatan_pemesanan" id="catatan_pemesanan" cols="30" rows="4" placeholder="(Opsional)"></textarea>
               <br>
            <?php endforeach; ?>
            <label for="metode_pembayaran">Metode Pembayaran</label><br>
            <select name=" metode_pembayaran" id="metode_pembayaran" required>
               <option value="debit">Debit</option>
               <option value="cash">Cash</option>
            </select>
            <button type="submit" name="btn_checkout" style="font-weight: bold; border-radius:100em;">Checkout</button>
         </form>
      </div>

      <div class="div" style="margin:2em 1em 1em 1em; float:left">
         <h1 style="font-size: 1.7em;">Produk Lain Kami</h1>
         <?php foreach ($produk_random_3 as $pr) : ?>
            <div class="section_w210 margin_r_20" style="border-radius: 0.2rem; padding: 1rem 5px 1rem 5px; margin:1em 0.8em 1em 0em; box-shadow: 0 0px 1px 0 rgba(0, 0, 0, 0.2); width:auto; height:auto;">
               <div class="sub_content" style="width:190px;">
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
   </div>
</body>
<script src="js/script.js"></script>

<script>
   var gender = document.getElementById("get_gender").value;
   console.log(gender);
   document.getElementById("gender").value = gender;
</script>

</html>