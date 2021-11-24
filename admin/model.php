<?php

if (!isset($_SESSION["admin"])) {
   echo "<script>
         alert('Login terlebih dahulu');
         document.location.href= 'login';
   </script>";
   exit;
}

if (isset($_SESSION['admin']) && isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
   $user = query("SELECT * FROM users WHERE username = '$username'");
}
