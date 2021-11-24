<?php
session_start();
require 'function.php';
if_logged_in_back_to_home();

if (isset($_POST["btn_register"])) {
   if (registrasi($_POST) > 0) {
      echo "<script>
               alert('User baru berhasil ditambahkan');
               document.location.href='login';
            </script> ";
   } else {
      echo mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <title>Registrasi | Modern Meds</title>

   <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background: url('images/register_bg.jpeg'); background-size:cover; box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.4)">
   <div class="container">
      <div class="register-page">
         <div class="form" style="border-radius: 0.5em;">
            <h1 style="margin:-0.6em 0em 1em 0em; font-size:2em">DAFTAR</h1>
            <form class="register-form" method="post">
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="nama_lengkap"><b>Nama Lengkap</b></label>
                  <input type="text" name="nama_lengkap" placeholder="Nama Lengkap Anda" required autocomplete="off">
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="username"><b>Username</b></label>
                  <input type="text" name="username" placeholder="Buat Username" required autocomplete="off">
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="password"><b>Password</b></label>
                  <input type="password" name="password" placeholder="Buat Password" required>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="password"><b>Konfirmasi Password</b></label>
                  <input type="password" name="password2" placeholder="Konfirmasi Password" required>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="email"><b>E-Mail</b></label>
                  <input type="email" name="email" placeholder="E-Mail" required>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="no_telp"><b>No Telepon</b></label>
                  <input type="number" name="no_telp" placeholder="No Telepon" autocomplete="off" min="0">
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="tgl_lahir"><b>Tanggal Lahir</b></label>
                  <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir">
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="gender"><b>Gender</b></label>
                  <select id="gender" name="gender" aria-placeholder="Gender">
                     <option value="">-- Gender --</option>
                     <option value="Laki-laki">Laki-laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="alamat"><b>Alamat</b></label>
                  <textarea name=" alamat" rows="5" cols="30" placeholder="Alamat"></textarea>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="kota"><b>Kota Domisili</b></label>
                  <select id="kota" name="kota" aria-placeholder="Kota">
                     <option value="">-- Kota --</option>
                     <option value="Surabaya">Surabaya</option>
                     <option value="Jakarta">Jakarta</option>
                     <option value="Bandung">Bandung</option>
                  </select>
               </div>
               <div style="text-align: left; margin-top:-0.5em;">
                  <label for="paypal_id"><b>Paypal ID</b></label>
                  <input type="number" name="paypal_id" placeholder="Paypal ID" min="0" autocomplete="off">
               </div>
               <button type="submit" name="btn_register" style="border-radius: 100em; width:50%; font-weight:600">Register</button>
               <p class="message">Sudah memiliki akun?<a href="login"> Masuk</a></p>
            </form>
         </div>
      </div>
   </div>
</body>

</html>