<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Promosi</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan Promosi</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#addPromote">Tambah Promosi</button> &nbsp;
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row">
    <?php foreach ($promote as $item): ?>
      <div class="col-sm-6 col-lg-6">
        <div class="card">
          <div class="p-2">
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="Product 1" style="max-height:200px">
          </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $item->title; ?></h4>
            <div class="row">
            <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#detailPromote<?php echo $item->id; ?>">Detail</button> &nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#deletePromote<?php echo $item->id; ?>">Hapus</button>
          </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>
<div class="modal fade" id="addPromote" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Posting Promosi</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group col-6 col-md-12">
            <label>Judul</label>
            <input type="text" class="form-control" placeholder="Masukan judul" name="title" required>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" cols="80" placeholder="Masukan keterangan" class="form-control" required></textarea>
          </div>
          <input type="file" name="fileUpload" class="btn btn-primary form-control">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="addPromote" value="addPromote">Tambahkan</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($promote as $item): ?>
<div class="modal fade" id="detailPromote<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Posting Promosi</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group col-6 col-md-12">
            <label>Judul</label>
            <input type="text" class="form-control" placeholder="Masukan judul" name="title" value="<?php echo $item->title ?>" required>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" cols="80" placeholder="Masukan keterangan" class="form-control" required><?php echo $item->description ?></textarea>
          </div>
          <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="updatePromote" value="updatePromote">Update</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deletePromote<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Hapus</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <p>Apakah anda yakin menghapus promosi ini? untuk melanjutkan silahkan masukan password anda pada kolom dibawah ini</p>
          <div class="form-group col-6 col-md-12">
            <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
            <input type="password" name="password" class="form-control" placeholder="masukan password anda">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="deletePromote" value="deletePromote">Hapus Promosi</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; ?>
