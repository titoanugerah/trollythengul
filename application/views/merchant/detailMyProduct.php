<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Detail Produk</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan produk</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('product'); ?>" class="btn btn-success btn-round">Kembali ke Produk</a>
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-round">Tambahkan Foto</button>
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Informasi Produk</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab2">Gambar</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="tab-content mt-2 mb-3" >
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
      <form  method="post">

        <div class="card-body">
          <div class="row">

            <div class="form-group col-md-12">
              <label>Nama Produk</label>
              <input type="text" class="form-control" placeholder="Masukan nama produk anda" name="name" value="<?php echo $product->product; ?>" required>
            </div>

            <div class="form-group col-md-12">
              <label>Keterangan Produk</label>
              <textarea type="text" class="form-control" placeholder="Masukan keterangan produk anda" name="description" value=""  cols="180" rows="5" required><?php echo $product->description; ?></textarea>
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
              <input type="number" class="form-control"  name="price" value="<?php echo $product->price; ?>" required>
            </div>

            <div class="form-group col-md-4">
              <label>Berat (Kilo)</label>
              <input type="number" class="form-control"  name="weight" value="<?php echo $product->weight; ?>" required>
            </div>

            <div class="form-group col-md-4">
              <label>Panjang (cm)</label>
              <input type="number" class="form-control"  name="size_length" value="<?php echo $product->size_length; ?>" required>
            </div>

            <div class="form-group col-md-4">
              <label>Lebar (cm)</label>
              <input type="number" class="form-control"  name="size_width" value="<?php echo $product->size_width; ?>" required>
            </div>

            <div class="form-group col-md-4">
              <label>Tinggi (cm)</label>
              <input type="number" class="form-control"  name="size_height" value="<?php echo $product->size_height; ?>" required>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-info"  name="addProduct" value="addProduct">Tambah Produk</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade show" id="tab2" role="tabpanel" >
      <div class="col-12">
        <div class="row">
          <?php foreach ($attachment as $item) : ?>
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="p-2">
                <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" >
              </div>
              <div class="card-body pt-2">
                <div class="row">
                <a href="<?php echo base_url('setDefaultImage/'.$product->id.'/'.$item->id); ?>" class="btn btn-success btn-round" <?php if($item->id == $product->id_attachment){echo 'hidden';} ?>>Jadikan Default</a> &nbsp;&nbsp;
                <button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#deleteAttachment<?php echo $item->id; ?>">Hapus</button>
              </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Foto</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <br>
          </center>
          <input type="file" name="fileUpload" class="btn btn-primary">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="addImage" value="addImage">Upload Foto</button>
        <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php foreach ($attachment as $item) : ?>
<div class="modal fade" id="deleteAttachment<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Hapus Gambar</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <p>Apakah anda yakin menghapus gambar ini? untuk melanjutkan silahkan masukan password anda pada kolom dibawah ini</p>
          <div class="form-group col-6 col-md-12">
            <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
            <input type="password" name="password" class="form-control" placeholder="masukan password anda">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="deleteAttachment" value="deleteAttachment">Hapus Kategori</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
