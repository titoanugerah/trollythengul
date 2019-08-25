<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Keranjang Belanja</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <form  method="post">
          <a href="<?php echo base_url('StatusOrder/'.$order->id); ?>" class="btn btn-success btn-round">Lanjutkan Ke Pembayaran</a>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row">
    <?php if($statusDetailOrder==1){ foreach ($detailOrder as $product):  ?>
      <div class="col-lg-3">
        <div class="card">
          <div class="p-2">
            <a href="<?php echo base_url('detailProduct/'.$product->id); ?>">
              <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$product->image); ?>" alt="Product 1" style="height: 140px;">
            </a>
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $product->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $product->category; ?></p>
            <p style="color:green;"><b>Rp. <?php echo number_format($product->price,2,',','.'); ?></b> </p>
            <center>
              <button type="button" data-toggle="modal" data-target="#optionOrder<?php echo $product->id; ?>" class="btn btn-info">Opsi</button>
            </center>
          </div>
        </div>
      </div>
    <?php endforeach;} else {$this->load->view('client/noOrder');} ?>
  </div>
</div>


<?php foreach ($detailOrder as $product): ?>
  <div class="modal fade" id="optionOrder<?php echo $product->id;?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h4><?php echo $product->product; ?></h4>
          </center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form role="form" method="post">
          <div class="modal-body row">
            <div class="form-group col-6 col-md-3">
              <label>Banyak Barang</label>
              <input type="text" name="id" value="<?php echo $product->id; ?>" hidden>
              <input type="text" class="form-control" name="qty" value="<?php echo $product->qty; ?>" required>
            </div>

            <div class="form-group col-6 col-md-9">
              <label>Permintaan Khusus</label>
              <textarea name="special_request" rows="3" cols="100" placeholder="Tambahkan permintaan anda, misal warma, motif dan lain lain " class="form-control"><?php echo $product->special_request; ?></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="updateDetailOrder" value="updateDetailOrder">Update Data</button>
            <button type="submit" class="btn btn-danger" name="deleteFromCart" value="deleteFromCart">Hapus</button>
            <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
