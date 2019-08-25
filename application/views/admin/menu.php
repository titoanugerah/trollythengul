<li class="nav-item <?php if($view_name=='webconf' || $view_name=='category'){echo 'active';} ?>">
  <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
    <i class="fas fa-home"></i>
    <p>Konfigurasi</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="dashboard">
    <ul class="nav nav-collapse">
      <li>
        <a href="<?php echo base_url('webconf'); ?>">
          <span class="sub-item">Konfigurasi Web</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('category'); ?>">
          <span class="sub-item">Kategori</span>
        </a>
      </li>

    </ul>
  </div>
</li>
<li class="nav-section">
  <span class="sidebar-mini-icon">
    <i class="fa fa-ellipsis-h"></i>
  </span>
  <h4 class="text-section">Components</h4>
</li>

<li class="nav-item <?php if($view_name=='promo'){echo 'active';} ?>">
  <a href="<?php echo base_url('promo'); ?>">
    <i class="far fa-credit-card"></i>
    <p>Promo</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='account' || $view_name == 'detailAccountMerchant' || $view_name == 'detailAccountCustomer'){echo 'active';}  ?>">
  <a href="<?php echo base_url('account/1'); ?>">
    <i class="fas fa-user"></i>
    <p>Akun</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='paymentVerification'){echo 'active';}  ?>">
  <a href="<?php echo base_url('paymentVerification'); ?>">
    <i class="fas fa-check"></i>
    <p>Verifikasi Pembayaran</p>
  </a>
</li>

<li class="nav-item" hidden>
  <a href="<?php echo base_url('promo'); ?>">
    <i class="far fa-credit-card"></i>
    <p>Akun</p>
    <span class="badge badge-<?php echo $webconf->theme_color;?>">4</span>
  </a>
</li>
