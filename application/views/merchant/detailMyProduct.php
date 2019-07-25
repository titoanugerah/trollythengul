<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Detail Produk <?php echo $product->product ?></h2>
        <h5 class="text-white op-7 mb-2"> <?php echo $product->merchant; ?></h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Informasi Produk</a>
      <a class="nav-link" data-toggle="tab" href="#tab2">Informasi Penjual</a>
      <a class="nav-link" data-toggle="tab" href="#tab3">Rating & Komentar Pelanggan</a>
      <a class="nav-link" data-toggle="tab" href="#tab4">Statistik Pengiriman</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="tab-content mt-2 mb-3" >
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
        <div class="row">
          <div class="col-md-8">
            <div class="card-header">
              <h1><?php echo $product->product; ?></h1>
              <p><?php echo 'Kategori : '.$product->category; ?></p>
            </div>
            <div class="card-body">
              <p><?php echo $product->description; ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?php echo base_url('./assets/upload/no.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo base_url('./assets/upload/no.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo base_url('./assets/upload/no.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <br>
            <center>
            <b style="color:green;">Harga: Rp. <?php echo number_format($product->price, 2,',','.'); ?></b>
          </center>
          </div>
      </div>
    </div>
      <div class="tab-pane fade show" id="tab2" role="tabpanel" >
        <div class="row">
          <div class="form-group">
            <label>Nama Pengguna Akun</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
              </div>
              <input type="text" class="form-control" placeholder="Masukan username" aria-label="Username" aria-describedby="basic-addon1" name="username" value="<?php echo $detail->username; ?>">
            </div>
          </div>

          <div class="form-group col-6 col-md-5">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="fullname" value="<?php echo $detail->fullname; ?>">
          </div>

          <div class="form-group col-6 col-md-4">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Masukan email anda" name="email" value="<?php echo $detail->email; ?>">
          </div>
        </div>
      </div>

      <div class="tab-pane fade show" id="tab3" role="tabpanel" >
        fwfwzc
      </div>
    </div>
  </div>
</div>
