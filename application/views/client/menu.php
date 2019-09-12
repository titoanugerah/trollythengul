<li class="nav-item <?php if($view_name=='shopPage'){echo 'active';} ?>">
  <a href="<?php echo base_url('shopPage'); ?>">
    <i class="fas fa-shopping-cart"></i>
    <p>Halaman Belanja</p>
  </a>
</li>
<li class="nav-item <?php if($view_name=='myCart'){echo 'active';} ?>">
  <a href="<?php echo base_url('myCart'); ?>">
    <i class="fas fa-shopping-bag"></i>
    <p>Keranjang Saya</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='myOrder'){echo 'active';} ?>">
  <a href="<?php echo base_url('myOrder'); ?>">
    <i class="fas fa-tags"></i>
    <p>Pesanan Saya</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='promoList'){echo 'active';} ?>">
  <a href="<?php echo base_url('promoList'); ?>">
    <i class="far fa-credit-card"></i>
    <p>Promo</p>
  </a>
</li>
