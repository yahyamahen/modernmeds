<?php
$daftar_kategori = query("SELECT kategori FROM produk GROUP BY kategori;");
$produk_random = query("SELECT * FROM produk ORDER BY RAND() LIMIT 10");
$produk_random_3 = query("SELECT * FROM produk WHERE stok_produk != 0 ORDER BY RAND() LIMIT 3");

if (isset($_GET['kategori'])) {
   $kategori = $_GET['kategori'];
   if (isset($_GET['kategori']) && isset($_GET['search'])) {
      $kategori = $_GET['kategori'];
      $keyword = $_GET['search'];
      $produk = query("SELECT * FROM produk WHERE kategori = '$kategori' 
                                                AND id_produk LIKE '%$keyword%'
                                                OR nama_produk LIKE '%$keyword%'
                                                OR deskripsi_produk LIKE '%$keyword%'");
   } else {
      $produk = query("SELECT * FROM produk WHERE kategori = '$kategori';");
   }
} else {
   if (isset($_GET['search'])) {
      $keyword = $_GET['search'];
      $produk = query("SELECT * FROM produk WHERE id_produk LIKE '%$keyword%' OR nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%';");
   } else {
      $produk = query("SELECT * FROM produk;");
   }
}

if (isset($_GET['delete_produk'])) {
   $id_produk = $_GET["delete_produk"];
   if (delete_produk($id_produk) > 0) {
      echo
      "<script>
		alert('Data Produk Terhapus');
		document.location.href = 'produk';
	</script>";
   } else {
      echo
      "<script>
		alert('Data Produk Tidak Dapat Terhapus');
	</sciprt>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}

if (isset($_POST["btn_pesan"])) {
   if (isset($_SESSION['user'])) {
      if (pesan($_POST) > 0) {
         echo "
      <script>
      alert('Produk berhasil ditambahkan');
      window.history.replaceState( null, null, window.location.href );
      </script>
      ";
      } else {
         echo "
      <script>
      alert('Produk gagal ditambahkan');
      window.history.replaceState( null, null, window.location.href );
      </script>
      ";
      }
   } else {
      echo "
      <script>
      alert('Login terlebih dahulu');
      document.location.href = 'login';
      </script>";
   }
}
