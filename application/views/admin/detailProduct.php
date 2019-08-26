<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Detail Produk</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan produk</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <button type="button" class="btn btn-success btn-round"  data-toggle="modal" data-target="myModal" <?php if($this->session->userdata['role']!='client'){echo 'hidden';} ?>>Beli Produk</button>

      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Produk</a>
      <a class="nav-link" data-toggle="tab" href="#tab2">Toko</a>
      <a class="nav-link" data-toggle="tab" href="#tab3">Rating & Komentar Pelanggan</a>
      <a class="nav-link" data-toggle="tab" href="#tab4">Statistik Pengiriman</a>

    </div>
  </div>
</div>
<div class="card">
  <div class="tab-content mt-2 mb-3" >
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
      <form  method="post">

        <div class="card-body">

          <!--Carousel Wrapper-->
          <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">
              <?php $i=0;foreach ($attachment as $item): ?>
                <li data-target="#carousel-example-1z" data-slide-to="<?php echo $i; ?>" class="<?php if ($i==0){echo 'active';} ?>"></li>
              <?php endforeach; $i++;?>
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
              <?php $i=0;foreach ($attachment1 as $item): ?>
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?php echo base_url('./assets/upload/'.$item->image); ?>"
                  alt="First slide">
                </div>
              <?php endforeach; $i++;?>

            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
          </div>
          <!--/.Carousel Wrapper-->

          <div class="row">

            <div class="form-group col-md-12">
              <label>Nama Produk</label>
              <input type="text" class="form-control" placeholder="Masukan nama produk anda" name="name" value="<?php echo $product->product; ?>" readonly>
            </div>

            <div class="form-group col-md-12">
              <label>Keterangan Produk</label>
              <textarea type="text" class="form-control" placeholder="Masukan keterangan produk anda" name="description" value=""  cols="180" rows="5" readonly><?php echo $product->description; ?></textarea>
            </div>

            <div class="form-group col-md-4">
              <label>Kategori</label>
              <br>
              <select class="select2basic form-control" name="id_category" style="width:300px">
                <?php foreach ($category as $item):if($item->status==0){continue;} ?>
                  <option value="<?php echo $item->id ?>" <?php if($item->id==$product->id_category){echo 'selected';} ?>><?php echo $item->category; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label>Harga (IDR)</label>
              <input type="number" class="form-control"  name="price" value="<?php echo $product->price; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
              <label>Berat (Kilo)</label>
              <input type="number" class="form-control"  name="weight" value="<?php echo $product->weight; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
              <label>Panjang (cm)</label>
              <input type="number" class="form-control"  name="size_length" value="<?php echo $product->size_length; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
              <label>Lebar (cm)</label>
              <input type="number" class="form-control"  name="size_width" value="<?php echo $product->size_width; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
              <label>Tinggi (cm)</label>
              <input type="number" class="form-control"  name="size_height" value="<?php echo $product->size_height; ?>" readonly>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-info"  data-toggle="modal" data-target="myModal" <?php if($this->session->userdata['role']!='client'){echo 'hidden';} ?>>Beli Produk</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade show" id="tab2" role="tabpanel" >
      <div class="card-body">
        <div class="row">

          <div class="col-9">
            <div class="row">

              <div class="form-group col-md-8">
                <label>Nama Toko</label>
                <input type="text" class="form-control"  value="<?php if($merchant->merchant==''){echo 'Belum dilengkapi';}else{echo $merchant->merchant;} ?>" readonly>
              </div>


              <div class="form-group col-md-4">
                <label>Domisili</label>
                <input type="text" class="form-control"   value="<?php if($merchant->address_city==''){echo 'Belum dilengkapi';}else{echo $merchant->address_city;} ?>" readonly>
              </div>

              <div class="form-group col-md-4">
                <label>Nama Pemilik</label>
                <input type="text" class="form-control"   value="<?php if($merchant->fullname==''){echo 'Belum dilengkapi';}else{echo $merchant->fullname;} ?>" readonly>
              </div>

              <div class="form-group col-md-4">
                <label>Nomor HP</label>
                <input type="text" class="form-control"   value="<?php if($merchant->phone_number==''){echo 'Belum dilengkapi';}else{echo $merchant->phone_number;} ?>" readonly>
              </div>

              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" class="form-control"   value="<?php if($merchant->email==''){echo 'Belum dilengkapi';}else{echo $merchant->email;} ?>" readonly>
              </div>

              <div class="form-group">
                <textarea rows="3" class="form-control" cols="110"><?php echo $merchant->address_street.', '.$merchant->city.', '.$merchant->address_province.' '.$merchant->address_postal; ?></textarea>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <br>
              <img src="<?php echo base_url('./assets/upload/'.$merchant->display_picture); ?>" style="max-width:230px" >
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="tab-pane fade show" id="tab3" role="tabpanel">
      <br>
      <center>
        <h3>Overal Rating : <?php echo $product->rating; ?></h3>
        <div class="col-md-12">
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="progress progress">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $product->rating ?>" aria-valuemin="0" aria-valuemax="5"></div>
              </div>

            </div>
          </div>
        </div>
      </center>
    </div>
    <div class="tab-pane fade show" id="tab4" role="tabpanel">
      <div class="table-responsive">
        <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Provinsi</th>
              <th>Order</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Provinsi</th>
              <th>Order</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $i=1;foreach ($shipment as $item): ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item->shipment_province; ?></td>
                <td><?php echo $item->shipment_count.' kali order'; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
