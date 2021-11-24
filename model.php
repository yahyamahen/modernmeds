<?php

if (isset($_SESSION['user']) && isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
   $user = query("SELECT * FROM customers WHERE username = '$username'");
   $count_cart = query("SELECT COUNT(cart.id) as count_cart FROM cart WHERE cart.username = '$username';")[0];
}
