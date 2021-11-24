<?php
if_not_login_back_to_home();
$jumlah_cart = query("SELECT COUNT(cart.id) as total_cart FROM cart WHERE username = '$username'")[0];

if ($jumlah_cart['total_cart'] == 0) {
   echo
   "<script>
      alert('Masukan produk pada cartmu terlebih dahulu');
      document.location.href = 'produk';
   </script>";
}

$daftar_kategori = query("SELECT kategori FROM produk GROUP BY kategori");

$total = query("SELECT SUM(produk.harga_produk * cart.total_pcs) AS total FROM produk, cart WHERE cart.id_produk = produk.id_produk AND cart.username = '$username';");

if (isset($_GET['kategori'])) {
   $kategori = $_GET['kategori'];
   if (isset($_GET['kategori']) && isset($_GET['search'])) {
      $kategori = $_GET['kategori'];
      $keyword = $_GET['search'];
      $cart = query("SELECT * FROM cart, produk, customers WHERE cart.id_produk = produk.id_produk AND customers.username = '$username' AND cart.username = '$username' AND produk.kategori = '$kategori' AND produk.id_produk LIKE '%$keyword%' OR produk.nama_produk LIKE '%$keyword%' OR produk.deskripsi_produk LIKE '%$keyword%' GROUP BY produk.id_produk;");
   } else {
      $cart = query("SELECT * FROM cart, produk, customers WHERE cart.id_produk = produk.id_produk AND customers.username = '$username' AND cart.username = '$username' AND produk.kategori = '$kategori';");
   }
} else {
   if (isset($_GET['search'])) {
      $keyword = $_GET['search'];
      $cart = query("SELECT * FROM cart, produk, customers WHERE cart.id_produk = produk.id_produk AND customers.username = '$username' AND cart.username = '$username' AND produk.id_produk LIKE '%$keyword%' OR produk.nama_produk LIKE '%$keyword%' OR produk.deskripsi_produk LIKE '%$keyword%' GROUP BY produk.id_produk;");
   } else {
      $cart = query("SELECT * FROM cart, produk, customers WHERE cart.id_produk = produk.id_produk AND customers.username = '$username' AND cart.username = '$username';");
   }
}

if (isset($_GET['delete_cart'])) {
   if (delete_cart($username, $_GET['delete_cart']) > 0) {
      echo
      "<script>
		alert('Data Produk pada Cart Terhapus');
		document.location.href = 'cart';
	</script>";
   } else {
      echo
      "<script>
         alert('Data Produk pada Cart Tidak Dapat Terhapus');
      </sciprt>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}

if (isset($_POST['btn_update_cart'])) {
   if (update_cart($_POST) > -1) {
      echo
      "<script>
		alert('Data Cart Terupdate');
		document.location.href = 'cart';
	</script>";
   } else {
      echo
      "<script>
         alert('Data Cart Tidak Dapat Terupdate');
      </sciprt>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}

if (isset($_POST['btn_checkout'])) {
   if (checkout($_POST) > 0) {
      echo
      "<script>
		alert('Pemesanan diproses');
		document.location.href = 'pemesanan';
	</script>";
   } else {
      echo
      "<script>
         alert('Pemesanan tidak dapat diproses');
      </sciprt>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}
