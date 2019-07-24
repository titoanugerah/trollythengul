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
    <?php foreach ($product as $product):  ?>
      <div class="col-lg-3">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$product->image); ?>" alt="Product 1" style="width:200px">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $product->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $product->category; ?></p>
            <p style="color:green;"><b>Rp. <?php echo $product->price; ?></b> </p>
            <center>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailCategory<?php echo $product->id; ?>">Detail</button> &nbsp;&nbsp;&nbsp;
          </center>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>
<div class="modal fade" id="addCategory" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Kategori</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="form-group col-6 col-md-12">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" placeholder="Masukan nama kategori" name="name" required>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" cols="80" placeholder="Masukan keterangan kategori" class="form-control" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="createCategory" value="createCategory">Tambah Kategori</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
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
          <div class="form-group col-12 col-md-12"hidden>
            <label>Produk</label> &nbsp;&nbsp;&nbsp;&nbsp;
            <select class="select2basic form-control" name="id" style="width:350px">
              <?php foreach ($product as $item):if($item->status==1){continue;} ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->product; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="recoverCategory" value="recoverCategory">Kembalikan Kategori</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
