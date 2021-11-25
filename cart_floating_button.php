<?php if (isset($_SESSION['user'])) : ?>
   <?php foreach ($total as $tl) : ?>
      <?php if (isset($_SESSION['user'])) : ?>
         <?php if ($tl['total'] == 0) : ?>
            <a class="button floating_button" style="width:auto; color:white; font-size: 11pt; font-weight:600; text-decoration:none; cursor:pointer;">Cart kosong nih, isi yuk!</a>
         <?php else : ?>
            <a class="button floating_button" style="color:white; font-size: 12pt; font-weight:600; text-decoration:none;" href="cart"><img src="images/cart.png" alt="cart.png" style="width: 2.7em; float:left; margin:-6px -20px -0px 15px;"> Rp. <?= number_format($tl['total'], 0, ",", ".") ?></a>
         <?php endif; ?>
      <?php endif; ?>
   <?php endforeach; ?>
<?php endif ?>