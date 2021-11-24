<?php
session_start();
require "function.php";
if_logged_in_back_to_home();


if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   $query = "SELECT username FROM customers WHERE id_customer = '$id';";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);

   if ($key === hash('sha256', $row['username'])) {
      $_SESSION['user'] = true;
      $_SESSION['username'] = $row["username"];
   }
}

if (isset($_POST["btn_login"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM customers WHERE username = '$username';");

   // cek username
   if (mysqli_num_rows($result) === 1) {
      //cek password
      $row = mysqli_fetch_assoc($result);
      // var_dump($row);
      if (password_verify($password, $row["PASSWORD"])) {
         // set session
         $_SESSION['user'] = true;
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

   <title>Login | Modern Meds</title>
   <link rel="icon" type="image/x-icon" href="images/healthstore.ico">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background: url('images/login_bg.jpeg'); background-size:cover; box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.4); position:fixed; top:0; bottom:0; left:0; right:0">
   <div class="container">
      <div class="login-page">
         <div class="form" style="border-radius: 0.5em;">
            <h1 style="margin:-0.6em 0em 1em 0em; font-size:2em">MASUK</h1>
            <form class="login-form" method="post">
               <div class="div" style="text-align: left;">
                  <label for="username"><b>Username</b></label><br>
                  <input type=" text" name="username" placeholder="Your Username" required />
               </div>
               <div class="div" style="text-align: left;">
                  <label for="password"><b>Password</b></label><br>
                  <input type="password" name="password" placeholder="********" required />
               </div>
               <button type="submit" name="btn_login" style="width: 50%; border-radius:100em; font-weight:600;">log in</button>
               <?php if (isset($error)) : ?>
                  <p class="message" style="color: red;"> Username / Password salah</p>
               <?php endif; ?>
               <p class="message">Belum punya aku? <a href="register">Buat Akun</a></p>
            </form>
         </div>
      </div>
   </div>
</body>

</html>