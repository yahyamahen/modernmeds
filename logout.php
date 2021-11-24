<?php
session_start();

if (!isset($_SESSION["user"])) {
   echo "<script>
         alert('Login terlebih dahulu');
         document.location.href= 'produk';
   </script>";
   exit;
} else {
   echo
   "<script>
      alert('Terimakasih dan kembali lagi');
      document.location.href= 'produk';
   </script>";

   $_SESSION = [];
   session_unset();
   session_destroy();

   setcookie('id', '', time() - 3600);
   setcookie('key', '', time() - 3600);

   exit;
}
