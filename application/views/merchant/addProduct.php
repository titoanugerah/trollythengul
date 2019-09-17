<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Tambah Produk</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan produk</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('addProduct'); ?>" class="btn btn-success btn-round">Tambah Produk</a>
        <a href="<?php echo base_url('product'); ?>" class="btn btn-success btn-round">Kembali ke Produk</a>

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
              <input type="text" class="form-control" placeholder="Masukan nama produk anda" name="name" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label>Keterangan Produk</label>
              <textarea type="text" class="form-control" placeholder="Masukan keterangan produk anda" name="description" value=""  cols="180" rows="5" required></textarea>
            </div>

            <div class="form-group col-md-4">
              <label>Kategori</label>
              <br>
              <select class="select2basic form-control" name="id_category" style="width:300px">
                <?php foreach ($category as $item):if($item->status==0){continue;} ?>
                  <option value="<?php echo $item->id ?>"><?php echo $item->category; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label>Harga (IDR)</label>
              <input type="number" class="form-control"  name="price" value="" required>
            </div>

            <div class="form-group col-md-4">
              <label>Jumlah Stok Awal</label>
              <input type="number" class="form-control"  name="stock" value="" required>
            </div>


            <div class="form-group col-md-3">
              <label>Berat (Kilo)</label>
              <input type="number" class="form-control"  name="weight" value="" required>
            </div>

            <div class="form-group col-md-3">
              <label>Panjang (cm)</label>
              <input type="number" class="form-control"  name="size_length" value="" required>
            </div>

            <div class="form-group col-md-3">
              <label>Lebar (cm)</label>
              <input type="number" class="form-control"  name="size_width" value="" required>
            </div>

            <div class="form-group col-md-3">
              <label>Tinggi (cm)</label>
              <input type="number" class="form-control"  name="size_height" value="" required>
            </div>


          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-info"  name="addProduct" value="addProduct">Tambah Produk</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade show" id="tab2" role="tabpanel" >
      <div class="card card-secondary card-annoucement card-round col-12" >
        <div class="card-body text-center">
          <div class="card-opening">Belum Tersedia</div>
          <div class="card-desc">
            Silahkan lengkapi terlebih dahulu data pada tab informasi
          </div>
        </div>
      </div>
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="recoverProduct" value="recoverProduct">Kembalikan Produk</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
