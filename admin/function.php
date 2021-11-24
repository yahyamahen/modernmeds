<?php
date_default_timezone_set('Asia/Bangkok');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";


$conn = mysqli_connect("localhost", "root", "", "modernmeds");

function query($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);
   $record = [];

   while ($data = mysqli_fetch_assoc($result)) {
      $record[] = $data;
   }

   echo mysqli_error($conn);
   return $record;
}

function registrasi($data)
{
   global $conn;

   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $password2 = mysqli_real_escape_string($conn, $data["password2"]);
   $email = strtolower(stripslashes($data["email"]));

   $result = mysqli_query($conn, "SELECT username FROM users WHERE username= '$username'");
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

   mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password','$email')");

   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);
}

function create_produk($data)
{
   global $conn;
   $nama_produk = htmlspecialchars($data["nama_produk"]);
   $kategori = htmlspecialchars($data["kategori"]);
   $deskripsi_produk = htmlspecialchars($data["deskripsi_produk"]);
   $harga_produk = htmlspecialchars($data["harga_produk"]);
   $stok_produk = htmlspecialchars($data["stok_produk"]);
   $gambar = upload();

   if (!$gambar) {
      return false;
   }

   $query = "INSERT INTO produk VALUES ('','$nama_produk','$kategori','$deskripsi_produk','$harga_produk','$stok_produk','$gambar');";

   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function upload()
{
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   if ($error === 4) {
      echo
      "<script>
			alert('Pilih gambar terlebih dahulu');
		</script>";
      return false;
   }

   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo
      "<script>
			alert('Yang diupload harus gambar');
		</script>";
      return false;
   }

   if ($ukuranFile > 1000000) {
      echo
      "<script>
			alert('File gambar minimal berukuran 1024kb');
		</script>";
      return false;
   }

   $namaFileBaru = $_POST['nama_produk']  . "_" . uniqid() . "." . $ekstensiGambar;

   $path = "images/" . $_POST['nama_produk'];
   if (file_exists($path)) {
      move_uploaded_file($tmpName, 'images/' . $_POST['nama_produk'] . "/" . $namaFileBaru);
   } else {
      mkdir($path, 0777, true);
      move_uploaded_file($tmpName, 'images/' . $_POST['nama_produk'] . "/" . $namaFileBaru);
   }

   return $namaFileBaru;
}

function konfirmasi($data)
{
   global $conn;
   $kode_pemesanan = $data['kode_pemesanan'];
   $username = $data['username'];
   $nota_pemesanan = $username . "_" . $kode_pemesanan . ".pdf";

   $pemesanan = query("SELECT * FROM pemesanan WHERE kode_pemesanan = '$kode_pemesanan' AND username = '$username'")[0];

   if ($pemesanan['status_pemesanan'] == 'Menunggu Pembayaran') {
      $status_pemesanan = 'Pesanan Selesai';
   } else if ($pemesanan['status_pemesanan'] == 'Pesanan Selesai') {
      echo "
      <script>
         alert('Pemesanan sudah selesai');
         document.location.href='pemesanan';
      </script>";
      return false;
   } else {
      echo "
      <script>
         alert('Waktu pembayaran sudah expired');
         document.location.href='pemesanan';
      </script>";
   }

   // echo "<br>" . $kode_pemesanan;
   // echo "<br>" . $username;
   // echo "<br>" . $status_pemesanan;
   // exit;

   $query = "UPDATE pemesanan SET status_pemesanan = '$status_pemesanan', nota_pemesanan = '$nota_pemesanan' WHERE kode_pemesanan = '$kode_pemesanan' && username = '$username';";
   mysqli_query($conn, $query);

   kirim($data);
   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);
}

function kirim($data)
{
   global $conn;
   $kode_pemesanan = htmlspecialchars($data["kode_pemesanan"]);
   $username = htmlspecialchars($data["username"]);
   $email = htmlspecialchars($data["email"]);

   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->Host = "tls://smtp.gmail.com";
   $mail->SMTPAuth = true;
   $mail->Username = "kiky.mahendra21@gmail.com";
   $mail->Password = "It'sallconnected1";
   $mail->addAttachment("files/" . $username . "/nota/" .  $username . "_" . $kode_pemesanan . ".pdf");
   $mail->SMTPSecure = "ssl";
   $mail->Port = 587;
   $mail->From = "kiky.mahendra21@gmail.com";
   $mail->FromName = "Modern Meds";
   $mail->addAddress($email, $username);
   $mail->isHTML(true);
   $mail->Subject = "[Modern Meds] - Nota Pemesanan " . $kode_pemesanan;
   $mail->Body    = "Terlampir nota pembayaran $kode_pemesanan pembelian obat di Modern Meds";
   $mail->AltBody = "Termakasih, terlah berbelanja di Modern Meds";

   if (!$mail->send()) {
      echo "
         <script> 
            alert('Mailer Error: " . $mail->ErrorInfo . "');
         </script>";
   } else {
      "<script>
         alert('Nota berhasil dikirim pada email : " . $email . "');
      </script>";
   }
}

function update_produk($data)
{
   global $conn;
   $key = $data["id_produk"];

   $id_produk = htmlspecialchars($data["id_produk"]);
   $nama_produk = htmlspecialchars($data["nama_produk"]);
   $kategori = htmlspecialchars($data["kategori"]);
   $deskripsi_produk = htmlspecialchars($data["deskripsi_produk"]);
   $harga_produk = htmlspecialchars($data["harga_produk"]);
   $stok_produk = htmlspecialchars($data["stok_produk"]);
   $gambarLama = htmlspecialchars($data["gambarLama"]);

   if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
   } else {
      $gambar = upload();
   }

   $query = "UPDATE produk SET id_produk = '$id_produk', nama_produk = '$nama_produk' , kategori = '$kategori' , deskripsi_produk = '$deskripsi_produk' , harga_produk = '$harga_produk' , stok_produk = '$stok_produk' , gambar = '$gambar' WHERE id_produk = '$key';";

   mysqli_query($conn, $query);

   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);
}

function delete_produk($id_produk)
{
   global $conn;
   $query = "DELETE FROM produk WHERE id_produk = $id_produk;";
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}
