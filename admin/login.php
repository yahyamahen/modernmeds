<?php
session_start();
require "function.php";

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   $query = "SELECT username FROM users WHERE id_user = '$id';";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);

   if ($key === hash('sha256', $row['username'])) {
      $_SESSION['admin'] = true;
   }
}

if (isset($_SESSION["admin"]) && $_SESSION['admin'] = true) {
   header("Location: produk");
   exit;
}

if (isset($_POST["btn_login"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username';");

   // cek username
   if (mysqli_num_rows($result) === 1) {
      //cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["PASSWORD"])) {
         // set session
         $_SESSION['admin'] = true;
         $_SESSION['username'] = $row["username"];

         if (isset($_POST['remember'])) {
            setcookie('id', $row['id'], time() + 3600);
            setcookie('key', hash('sha256', $row['username']), time() + 3600);
         }

         header("Location: produk");
         exit;
      }
   }

   $error = true;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Login | Admin</title>
   <link rel="icon" type="image/x-icon" href="../images/healthstore.ico">
   <link rel="stylesheet" href="css/style_auth.css">
</head>

<body>
   <div class="container">
      <div class="login-page">
         <div class="form">
            <form class="login-form" method="post">
               <input type="text" name="username" placeholder="username" required style="margin-top:0.4em;" />
               <input type="password" name="password" placeholder="password" required />
               <button type="submit" name="btn_login"><b>login</b></button>
               <?php if (isset($error)) : ?>
                  <p class="message" style="color: red;"> Username / Password salah</p>
               <?php endif; ?>
               <p class="message">Belum Terdaftar? <a href="register"><b>Buat Akun</b></a></p>
            </form>
         </div>
      </div>
   </div>
</body>

</html>