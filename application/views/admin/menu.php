<li class="nav-item <?php if($view_name=='dashboard'){echo 'active';} ?>">
  
    <a href="<?php echo base_url('dashboard'); ?>">
      <i class="flaticon-home"></i>
      <p>Dashboard</p>
    </a>
  
</li>
<li class="nav-item <?php if($view_name=='webconf' || $view_name=='category'){echo 'active';} ?>">
  <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
    <i class="flaticon-settings"></i>
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
    <i class="flaticon-price-tag"></i>
    <p>Promo</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='account' || $view_name == 'detailAccountMerchant' || $view_name == 'detailAccountCustomer'){echo 'active';}  ?>">
  <a href="<?php echo base_url('account/1'); ?>">
    <i class="flaticon-user"></i>
    <p>Akun</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='paymentVerification'){echo 'active';}  ?>">
  <a href="<?php echo base_url('paymentVerification'); ?>">
    <i class="flaticon-check"></i>
    <p>Verifikasi Pembayaran</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='redeemMerchant'){echo 'active';}  ?>">
  <a href="<?php echo base_url('redeemMerchant'); ?>">
    <i class="flaticon-success"></i>
    <p>Redeem Merchant</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='promote'){echo 'active';} ?>">
  <a href="<?php echo base_url('promote'); ?>">
    <i class="flaticon-picture"></i>
    <p>Slider</p>
  </a>
</li>

<li class="nav-item <?php if($view_name=='downloadReport'){echo 'active';}  ?>">
  <a href="<?php echo base_url('downloadReport'); ?>">
    <i class="flaticon-download"></i>
    <p>Unduh Laporan</p>
  </a>
</li>

<li class="nav-item" hidden>
  <a href="<?php echo base_url('promo'); ?>">
    <i class="far fa-credit-card"></i>
    <p>Akun</p>
    <span class="badge badge-<?php echo $webconf->theme_color;?>">4</span>
  </a>
</li>
