<?php
$daftar_kategori = query("SELECT kategori FROM produk");

$produkAll = query("SELECT * FROM pemesanan, produk, customers WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = customers.username GROUP BY produk.id_produk;");

$pemesanan = query("SELECT * FROM pemesanan WHERE username = '$username' GROUP BY kode_pemesanan ORDER BY waktu_pemesanan ASC");

$produk = query("SELECT * FROM pemesanan, produk WHERE pemesanan.id_produk = produk.id_produk AND pemesanan.username = '$username';");

if (isset($_GET['btn_search_pemesanan'])) {
   $keyword = $_GET['keyword'];
   // var_dump($keyword);
   // exit;
   $pemesananAll = query("SELECT * FROM pemesanan, customers, produk WHERE pemesanan.username = customers.username AND pemesanan.id_produk = produk.id_produk AND pemesanan.kode_pemesanan LIKE '%$keyword%' OR pemesanan.waktu_pemesanan LIKE '%$keyword%' OR customers.username LIKE '%$keyword%' OR pemesanan.total LIKE '%$keyword%' OR pemesanan.metode_pembayaran LIKE '%$keyword%' OR pemesanan.status_pemesanan LIKE '%$keyword%' GROUP BY pemesanan.kode_pemesanan ORDER BY pemesanan.waktu_pemesanan ASC");
} else {
   $pemesananAll = query("SELECT * FROM pemesanan, customers, produk WHERE pemesanan.username = customers.username AND pemesanan.id_produk = produk.id_produk GROUP BY pemesanan.kode_pemesanan ORDER BY pemesanan.waktu_pemesanan ASC");
}
