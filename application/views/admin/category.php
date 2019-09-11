<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Kategori Produk</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan kategori</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#addCategory">Tambah Kategori</button> &nbsp;
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#recoverCategory">Kembalikan Kategori Terhapus</button>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row">
    <?php foreach ($category as $category): if($category->status==0){continue;} ?>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$category->image); ?>" alt="Product 1">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $category->category; ?></h4>
            <p class="text-muted small mb-2"><?php echo $category->description; ?></p>
            <p style="color:green;"><b>Jumlah Produk <?php echo $category->product_count; ?></b> </p>
            <div class="row">
            <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#detailCategory<?php echo $category->id; ?>">Detail</button> &nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#deleteCategory<?php echo $category->id; ?>">Hapus</button>
          </div>
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

<div class="modal fade" id="recoverCategory" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Kembalikan Kategori Terhapus</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="form-group col-12 col-md-12">
            <label>Kategori</label> &nbsp;&nbsp;&nbsp;&nbsp;
            <select class="select2basic form-control" name="id" style="width:350px">
              <?php foreach ($detailCategory as $item):if($item->status==1){continue;} ?>
                <option value="<?php echo $item->id ?>"><?php echo $item->category; ?></option>
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

<?php foreach ($detailCategory as $item): if($item->status==0){continue;} ?>
<div class="modal fade" id="detailCategory<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Kategori</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="form-group col-6 col-md-12">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" placeholder="Masukan nama kategori" name="name" value="<?php echo $item->category; ?>" required>
            <input type="text" class="form-control" name="id" value="<?php echo $item->id; ?>" hidden>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" cols="80" placeholder="Masukan keterangan kategori" class="form-control" required><?php echo $item->description; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="updateCategory" value="updateCategory">Update Kategori</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCategory<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Hapus Kategori</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <p>Apakah anda yakin menghapus kategori <?php echo $item->category; ?>? untuk melanjutkan silahkan masukan password anda pada kolom dibawah ini</p>
          <div class="form-group col-6 col-md-12">
            <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
            <input type="password" name="password" class="form-control" placeholder="masukan password anda">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="deleteCategory" value="deleteCategory">Hapus Kategori</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; ?>
