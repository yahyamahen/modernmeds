<?php
require 'function.php';

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
   <title>Registrasi | Admin</title>

   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <link rel="stylesheet" href="css/style_auth.css">
</head>

<body>
   <div class="container">
      <div class="register-page">
         <div class="form">
            <form class="register-form" method="post">
               <input type="text" name="username" placeholder="Username" required />
               <input type="password" name="password" placeholder="Password" required />
               <input type="password" name="password2" placeholder="Konfirmasi Password" required />
               <input type="text" name="email" placeholder="E-Mail" required />
               <!-- <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" />
               <select id="gender" name="gender" aria-placeholder="Gender">
                  <option value="">-- Gender --</option>
                  <option value="laki-laki">Laki-laki</option>
                  <option value="perempuan">Perempuan</option>
               </select>
               <textarea name="alamat" rows="10" cols="30" placeholder="Alamat"></textarea>
               <select id="kota" name="kota" aria-placeholder="Kota">
                  <option value="">-- Kota --</option>
                  <option value="Surabaya">Surabaya</option>
                  <option value="Jakarta">Jakarta</option>
                  <option value="Bandung">Bandung</option>
               </select>
               <input type="text" name="no_telp" placeholder="No Telp" />
               <input type="text" name="paypal_id" placeholder="Paypal ID" /> -->

               <button type="submit" name="btn_register"><b>Register</b></button>
               <p class="message">Sudah memiliki akun?<a href="login"> <b>Masuk</b> </a></p>
            </form>
         </div>
      </div>
   </div>
</body>

</html>