<nav>
   <!-- <form class="my-form" action="" method="GET" style="margin-bottom: 1rem; text-align:center; width:30%; margin:auto; display:flex;">
      <input type="text" name="search" style="display:inline; background-color:white; border-radius:10rem;  padding-left: 1.4em; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2)" placeholder="Cari Produk">
      <button style="width:30%; height:10%; margin-left:-5rem; display:inline; border-radius:10rem; font-weight:600" type="submit">Cari</button>
   </form> -->
   <ul>
      <li style="width: 12.8rem; text-align:center">
         <img style="width: 4em; float:left; margin:-13px -15px -20px 10px;" src="images/ModernMeds.png" alt="ModernMeds.png">
         <a href="produk" style="color:white; text-decoration:none;">MODERNMEDS</a>
      </li>
      <?php if (isset($_SESSION['user'])) : ?>
         <li>
            <a href="cart" style="color:white; text-decoration:none;">Cart<img src="images/cart.png" alt="cart.png" style="width: 3em; float:left; margin:-8px 0px -20px -2px;"> </a>
            <span style="padding:1.4px 5px 1.4px 5px; border-radius: 100%; width: 20px; height: 20px; display:inline; background: #fff; text-align: center; font-weight:bold;"><?= $count_cart['count_cart']; ?></span>
         </li>
         <li><a href="pemesanan" style="color:white; text-decoration:none;"><img src="images/history_bill.png" alt="history_bill.png" style="width: 2.5em; float:left; margin:-5px 4px -20px -2px;">Daftar Pemesanan</a></li>
         <li style="float:right;"><a href="Logout" style="color:white; text-decoration:none;"><img src="images/logout.png" alt="history_bill.png" style="width: 2.3em; float:left; margin:-4px 2px -20px -2px;">Log out </a></li>
      <?php else : ?>
         <li style="float:right;"><a href="login" style="color:white; text-decoration:none;"><img src="images/login.png" alt="history_bill.png" style="width: 2.3em; float:left; margin:-4px 2px -20px -2px;">Log in </a></li>
      <?php endif; ?>
      <li><a href="login">login</a></li>
   </ul>
</nav>