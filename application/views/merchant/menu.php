<li class="nav-item <?php if($view_name=='dashboard'){echo 'active';} ?>">
  <li class="nav-item <?php if($view_name=='dashboard'){echo 'active';} ?>">
    <a href="<?php echo base_url('dashboard'); ?>">
      <i class="fas fa-home"></i>
      <p>Dasbor</p>
    </a>
  </li>
</li>
<li class="nav-item <?php if($view_name=='shopPage'){echo 'active';} ?>">
  <li class="nav-item <?php if($view_name=='shopPage'){echo 'active';} ?>">
    <a href="<?php echo base_url('shopPage'); ?>">
      <i class="fas fa-shopping-cart"></i>
      <p>Halaman Belanja</p>
    </a>
  </li>
</li>

<li class="nav-item <?php if($view_name=='product'){echo 'active';} ?>">
  <li class="nav-item <?php if($view_name=='product'){echo 'active';} ?>">
    <a href="<?php echo base_url('product'); ?>">
      <i class="fas fa-box-open"></i>
        <p>Produk</p>
    </a>
  </li>
</li>

<li class="nav-item <?php if($view_name=='order'){echo 'active';} ?>">
  <li class="nav-item <?php if($view_name=='order'){echo 'active';} ?>">
    <a href="<?php echo base_url('order'); ?>">
      <i class="fas fa-tasks"></i>
        <p>Pesanan</p>
    </a>
  </li>
</li>
