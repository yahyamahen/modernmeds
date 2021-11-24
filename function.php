<?php
date_default_timezone_set('Asia/Bangkok');

$conn = mysqli_connect("localhost", "root", "", "modernmeds");

function if_logged_in_back_to_home()
{
	if (isset($_SESSION['user'])) {
		echo "<script>document.location.href='produk';</script>";
	}
}

function if_not_login_back_to_home()
{
	if (!isset($_SESSION["user"])) {
		echo "<script>
            alert('Login terlebih dahulu');
            document.location.href= 'login';
      </script>";
		exit;
	}
}

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$record = [];

	while ($data = mysqli_fetch_assoc($result)) {
		$record[] = $data;
	}

	mysqli_error($conn);
	return $record;
}

function registrasi($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
	$email = htmlspecialchars($data["email"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$gender = htmlspecialchars($data["gender"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kota = htmlspecialchars($data["kota"]);
	$no_telp = htmlspecialchars($data["no_telp"]);
	$paypal_id = htmlspecialchars($data["paypal_id"]);

	$result = mysqli_query($conn, "SELECT username FROM customers WHERE username= '$username'");
	$row = mysqli_fetch_assoc($result);

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
               alert('Username sudah terdaftar, gunakan username yang lain'); 
            </script>";
		return false;
	}

	if ($password !== $password2) {
		echo "<script>
            alert('konfirmasi password tidak sesuai');
         </script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	// $password = md5($password);
	// var_dump($password);
	// die;

	mysqli_query($conn, "INSERT INTO customers VALUES ('$username','$password', '$nama_lengkap','$email','$tgl_lahir','$gender','$alamat','$kota','$no_telp','$paypal_id')");

	// echo mysqli_error($conn);
	return mysqli_affected_rows($conn);
}

function pesan($data)
{
	global $conn;

	$username = $_SESSION['username'];
	$id_produk = htmlspecialchars($data['id_produk']);
	$nama_produk = htmlspecialchars($data['nama_produk']);
	$stok_produk = htmlspecialchars($data['stok_produk']);
	$total_pcs = 1;

	$result = mysqli_query($conn, "SELECT * FROM cart WHERE username = '$username' && id_produk = '$id_produk';");

	if (mysqli_fetch_assoc($result)) {
		echo
		"<script>
               alert('Produk sudah dipesan');
            </script>";
		return false;
	}

	if ($total_pcs > $stok_produk) {
		echo
		"<script>
               alert('Produk " . $nama_produk . " hanya " . $stok_produk . "');
            </script>";
		return false;
	}
	// var_dump($username, $id_produk, $total_pcs);
	// exit;

	$insertsql = "INSERT INTO cart (id, username, id_produk, total_pcs) VALUES ('', '$username', '$id_produk', '$total_pcs');";
	mysqli_query($conn, $insertsql);

	echo mysqli_error($conn);
	return mysqli_affected_rows($conn);
}

function checkout($data)
{
	global $conn;

	// var_dump($data);
	// exit;
	$var_pemesanan = rand(1, 10000);

	if ($data['metode_pembayaran'] == 'debit') {
		$var_harga = rand(1, 500);
	} else {
		$var_harga = 0;
	}

	$kode_pemesanan = "PG" . $var_pemesanan;
	// $total_data_cart = $data['total_data_cart'];
	$total_data_cart = count($data['id_produk']);

	for ($i = 0; $i < $total_data_cart; $i++) {
		$username = htmlspecialchars($data['username']);
		$id_produk = htmlspecialchars($data['id_produk'][$i]);
		$total_pcs = htmlspecialchars($data['total_pcs'][$i]);
		$total = htmlspecialchars($data['total']) + $var_harga;
		$metode_pembayaran = htmlspecialchars($data['metode_pembayaran']);
		$waktu_pemesanan = date("Y-m-d H:i:s", time());
		$status_pemesanan = "Menunggu Pembayaran";
		$catatan_pemesanan = htmlspecialchars($data['catatan_pemesanan']);

		// echo "<br> Data - $i <br>";
		// echo "Kode Pemesanan : " . $kode_pemesanan . " <br>";
		// echo "Username : " . $username . " <br>";
		// echo "ID Produk : " . $id_produk . "<br>";
		// echo "Total Pcs : " . $total_pcs . "<br>";
		// echo "Total : " . $total . "<br>";
		// echo "Metode Pembayaran : " . $metode_pembayaran . "<br>";
		// echo "Waktu Pemesanan : " . $waktu_pemesanan . "<br>";
		// echo "Status Pemesanan : " . $status_pemesanan . "<br>";
		// echo "Catatan Pemesanan : " . $catatan_pemesanan . "<br>";
		// echo "<br>";

		// $result = mysqli_query($conn, "SELECT id_pemesanan FROM pemesanan WHERE kode_pemesanan = '$kode_pemesanan'");
		// if (mysqli_fetch_assoc($result)) {
		// 	$kode_pemesanan = "PG" . rand();
		// }

		// echo $kode_pemesanan;


		$insertsql = "
		INSERT INTO pemesanan 
		(id_pemesanan, kode_pemesanan, username, id_produk, total_pcs, total, metode_pembayaran,  waktu_pemesanan, status_pemesanan, catatan_pemesanan) 
		VALUES 
		('', '$kode_pemesanan', '$username', '$id_produk', '$total_pcs', '$total', '$metode_pembayaran', '$waktu_pemesanan', '$status_pemesanan', '$catatan_pemesanan')";
		mysqli_query($conn, $insertsql);

		$updatesql = "UPDATE produk SET stok_produk = stok_produk - $total_pcs WHERE id_produk = '$id_produk';";
		mysqli_query($conn, $updatesql);
	}

	$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
	$no_telp = htmlspecialchars($data['no_telp']);
	$gender = htmlspecialchars($data['gender']);
	$alamat = htmlspecialchars($data['alamat']);
	$kota = htmlspecialchars($data['kota']);
	$paypal_id = htmlspecialchars($data['paypal_id']);

	$updatesql = "UPDATE customers SET nama_lengkap = '$nama_lengkap', no_telp='$no_telp', gender='$gender', alamat='$alamat', kota='$kota', paypal_id='$paypal_id' WHERE username = '$username';";
	mysqli_query($conn, $updatesql);

	$deletesql = "DELETE FROM cart WHERE username = '$username';";
	mysqli_query($conn, $deletesql);

	echo mysqli_error($conn);
	return mysqli_affected_rows($conn);
}

function delete_cart($username, $id_produk)
{
	global $conn;
	$query = "DELETE FROM cart WHERE username = '$username' && id_produk = '$id_produk';";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function update_cart($data)
{
	global $conn;

	$total_data_cart = count($data['id_produk']);
	// $total_data_cart = ($data['total_data_cart']);
	// echo "Total Data = " . $total_data_cart . "<br>";

	for ($i = 0; $i < $total_data_cart; $i++) {
		$id_produk = $data['id_produk'][$i];
		$username = $data['username'];
		$nama_produk = htmlspecialchars($data['nama_produk'][$i]);
		$total_pcs = htmlspecialchars($data['total_pcs'][$i]);
		$stok_produk = htmlspecialchars($data['stok_produk'][$i]);

		if ($total_pcs > $stok_produk) {
			echo
			"<script>
		         alert('Stok " . $nama_produk . " hanya " . $stok_produk . " ');   
		      </script>";
			// break;
			// exit;
		}

		// echo "<br>id_produk : " . $id_produk;
		// echo "<br>username : " . $username;
		// echo "<br>nama_produk : " . $nama_produk;
		// echo "<br>total_pcs : " . $total_pcs;
		// echo "<br>stok_produk : " . $stok_produk;
		// echo "<br>";

		$query = "UPDATE cart SET total_pcs = '$total_pcs' WHERE username = '$username' && id_produk = '$id_produk';";
		mysqli_query($conn, $query);
	}

	// echo mysqli_affected_rows($conn);
	return mysqli_affected_rows($conn);
}
