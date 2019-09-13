<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Pesanan Datang</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan pesanan</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('downloadRecap'); ?>" class="btn btn-success btn-round">Unduh Rekap Penjualan</a>
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Belum Diproses</a>
      <a class="nav-link" data-toggle="tab" href="#tab2">Diproses Toko</a>
      <a class="nav-link" data-toggle="tab" href="#tab3">Dikirim</a>
      <a class="nav-link" data-toggle="tab" href="#tab4">Diterima</a>

    </div>
  </div>
</div>
<div class="tab-content mt-2 mb-3 row">
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" >

  <div class="col-12">
    <?php foreach ($order as $item): if($item->status!=2){continue;}  ?>
      <div class="col-lg-3">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="Product 1" style="height: 140px;">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $item->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $item->fullname; ?></p>
            <p style="color:green;"><?php echo $item->qty.' buah'; ?> </p>
            <a data-toggle="modal" style="color:white;" data-target="#order<?php echo $item->id; ?>" class="btn btn-info">Konfirmasi</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>


  <div class="tab-pane fade show" id="tab2" role="tabpanel" >

  <div class="col-12">
    <?php foreach ($order as $item): if($item->status!=3){continue;}  ?>
      <div class="col-lg-3">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="Product 1" style="height: 140px;">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $item->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $item->fullname; ?></p>
            <p style="color:green;"><?php echo $item->qty.' buah'; ?> </p>
            <a data-toggle="modal" style="color:white;" data-target="#packing<?php echo $item->id; ?>" class="btn btn-info">Konfirmasi Pengiriman</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<div class="tab-pane fade show" id="tab3" role="tabpanel" >

<div class="col-12">
  <?php foreach ($order as $item): if($item->status!=4){continue;}  ?>
    <div class="col-lg-3">
      <div class="card">
        <div class="p-2">
          <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="Product 1" style="height: 140px;">
        </div>
        <div class="card-body pt-2">
          <h4 class="mb-1 fw-bold"><?php echo $item->product; ?></h4>
          <p class="text-muted small mb-2"><?php echo $item->fullname; ?></p>
          <p style="color:green;"><?php echo $item->qty.' buah'; ?> </p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</div>
</div>

<div class="tab-pane fade show" id="tab4" role="tabpanel" >

<div class="col-12">
  <?php foreach ($order as $item): if($item->status!=5){continue;}  ?>
    <div class="col-lg-3">
      <div class="card">
        <div class="p-2">
          <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="Product 1" style="height: 140px;">
        </div>
        <div class="card-body pt-2">
          <h4 class="mb-1 fw-bold"><?php echo $item->product; ?></h4>
          <p class="text-muted small mb-2"><?php echo $item->fullname; ?></p>
          <p style="color:green;"><?php echo $item->qty.' buah'; ?> </p>
          <a data-toggle="modal" style="color:white;" data-target="#arrived<?php echo $item->id; ?>" class="btn btn-info">Konfirmasi</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</div>
</div>

</div>




<?php foreach ($order as $item): if($item->status>=3){continue;}  ?>
<div class="modal fade" id="order<?php echo  $item->id; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Order # <?php echo $item->id; ?></h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <?php //var_dump($item); ?>
          <div class="form-group col-12 col-md-12">
            <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
            <input type="text" name="product" value="<?php echo $item->product ?>" hidden>
            <label>Pesananan Tambahan</label><br>
            <input type="text" value="<?php echo $item->special_request; ?>" class="form-control">
            <p>Apakah anda akan menerima pesanan ini?</p>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="acceptOrder" value="acceptOrder">Setujui Pesanan</button>
          <button type="submit" class="btn btn-danger" name="declineOrder" value="declineOrder">Tolak Pesanan</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php foreach ($order as $item): if($item->status!=3){continue;}  ?>
<div class="modal fade" id="packing<?php echo  $item->id; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Order # <?php echo $item->id; ?></h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <?php //var_dump($item); ?>
          <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
          <input type="text" name="product" value="<?php echo $item->product ?>" hidden>
          <div class="form-group col-12 col-md-12">
            <p>Mohon pesanan dikirimkan ke : </p>
            <textarea rows="2" cols="60" class="form-control"><?php echo $item->shipment_street; ?></textarea>
          </div>
          <div class="row">

          <div class="form-group col-md-6">
            <label>Kurir</label>
            <input class="form-control" value="<?php echo explode( '/',$item->courier)[0]; ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Jenis</label>
            <input class="form-control" value="<?php echo $item->type; ?>">
          </div>
        </div>
        <div class="form-group col-md-12">
          <label>Nomor Resi / AWB </label>
          <input class="form-control"  name="awb" value="<?php echo $item->awb; ?>" required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="confirmSent" value="confirmSent">Konfirmasi Pengiriman Barang</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php foreach ($order as $item): if($item->status!=4){continue;}  ?>
<div class="modal fade" id="delivery<?php echo  $item->id; ?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Order # <?php echo $item->id; ?></h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <?php //var_dump($item); ?>
          <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
          <input type="text" name="product" value="<?php echo $item->product ?>" hidden>
          Nomor resi Pesanan ini adalah <?php echo $item->awb; ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
