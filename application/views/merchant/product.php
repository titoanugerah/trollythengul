<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Produk</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan produk</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('addProduct'); ?>" class="btn btn-success btn-round">Tambah Produk</a>
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#recoverProduct">Kembalikan Produk Terhapus</button>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row">
    <?php foreach ($product as $product): if($product->status==0){continue;} ?>
      <div class="col-lg-3">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$product->image); ?>" alt="Product 1" style="height: 140px;">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $product->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $product->category; ?></p>
            <p style="color:green;"><b>Rp. <?php echo number_format($product->price,2,',','.'); ?></b> </p>
            <center>
            <a href="<?php echo base_url('detailMyProduct/'.$product->id) ?>" class="btn btn-success" >Detail</a> &nbsp;&nbsp;&nbsp;
          </center>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<div class="modal fade" id="recoverProduct" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Kembalikan Produk Terhapus</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <?php //var_dump($product); ?>
          <div class="form-group col-12 col-md-12">
            <label>Produk</label> &nbsp;&nbsp;&nbsp;&nbsp;
            <select class="select2basic form-control" name="id" style="width:350px">
              <?php foreach ($deleted as $item): ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->product; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="recoverProduct" value="recoverProduct">Kembalikan Produk</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
