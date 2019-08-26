<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Akun</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan Akun</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('account/'.($limit-1)); ?>" class="btn btn-success btn-round" <?php if($limit==1){echo 'hidden';}?>>Sebelumnya</a>
        <a href="<?php echo base_url('account/'.($limit+1)); ?>" class="btn btn-success btn-round">Selanjutnya</a>
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Akun Pelanggan</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab2">Akun Merchant</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="tab-content mt-2 mb-3" >
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
      <div class="card-body row">
        <?php foreach ($account as $customer): if($customer->role!='client'){continue;} ?>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="p-2">
                <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$customer->display_picture);?>" alt="Product 1">
              </div>
              <div class="card-body pt-2">
                <h4 class="mb-1 fw-bold"><?php echo $customer->fullname; ?></h4>
                <p class="text-muted small mb-2"><?php echo '@'.$customer->username; ?></p>
                <br>
                <center>
                  <a href="<?php echo base_url('detailAccount/'.$customer->role.'/'.$customer->id); ?>" class="btn btn-secondary btn-round">Detail Akun</a>
                </center>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="tab-pane fade show" id="tab2" role="tabpanel" >
      <div class="card-body row">
        <?php foreach ($account as $merchant): if($merchant->role!='merchant'){continue;} ?>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="p-2">
                <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$merchant->display_picture);?>" alt="Product 1">
              </div>
              <div class="card-body pt-2">
                <h4 class="mb-1 fw-bold"><?php echo $merchant->fullname; ?></h4>
                <p class="text-muted small mb-2"><?php echo '@'.$merchant->username; ?></p>
                <br>
                <center>
                  <a href="<?php echo base_url('detailAccount/'.$merchant->role.'/'.$merchant->id); ?>" class="btn btn-secondary btn-round">Detail Akun</a>
                </center>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>
