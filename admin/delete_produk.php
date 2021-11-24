<?php

require "function.php";

$id_produk = $_GET["id_produk"];
// saranku jangan diget, dipost  
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


// wes gaopo, sing penting iso sek yawes lanjutin, proses pesan aja mending, nah ituu gaero :()