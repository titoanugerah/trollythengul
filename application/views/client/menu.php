<li class="nav-item <?php if($view_name=='shopPage'){echo 'active';} ?>">
  <a href="<?php echo base_url('shopPage'); ?>">
    <i class="flaticon-store"></i>
    <p>Halaman Belanja</p>
  </a>
</li>
<li class="nav-item <?php if($view_name=='myCart'){echo 'active';} ?>">
  <a href="<?php echo base_url('myCart'); ?>">
    <i class="flaticon-cart-1"></i>
    <p>Keranjang Saya</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='myOrder'){echo 'active';} ?>">
  <a href="<?php echo base_url('myOrder'); ?>">
    <i class="flaticon-box"></i>
    <p>Pesanan Saya</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='promoList'){echo 'active';} ?>">
  <a href="<?php echo base_url('promoList'); ?>">
    <i class="flaticon-price-tag"></i>
    <p>Promo</p>
  </a>
</li>
