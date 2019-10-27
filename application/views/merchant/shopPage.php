<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white  fw-bold">Selamat Datang di Portal Belanja UMKM Kecamatan Kapas</h2>
      </div>
    </div>
  </div>
</div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
   <center>
<div class="col-md-10">
  <div class="p-2">
  <ol class="carousel-indicators">
    <?php $i=0;foreach ($promote as $item): ?>

    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if ($i==0){echo 'active';} ?>"></li>
  <?php $i++;endforeach; ?>

  </ol>
  <div class="carousel-inner">
    <?php $j=0;foreach ($promote as $item): ?>
      <div class="carousel-item <?php if($j==0){echo 'active';} ?>">
        <a data-toggle="modal" data-target="#detailPromote<?php echo $item->id;?>">
        <img class="d-block w-100" src="<?php echo base_url('./assets/upload/'.$item->image); ?>"  alt="slide<?php echo $j;  ?>" style="max-height:450px">
      </a>
      </div>
    <?php $j++;endforeach; ?>

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
</div>
</center>
</div><br>
<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Produk</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <form  method="post">
          <button type="submit" name="prevPage" value="prevPage" class="btn btn-success btn-round">Sebelumnya</button>
          <button type="submit" name="nextPage" value="nextPage" class="btn btn-success btn-round">Selanjutnya</button>
        </form>
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
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$product->image); ?>" alt="Product 1" style="height: 200px;">
         </div>
          <div class="card-body pt-2">
            <h4 class="mb-1 fw-bold"><?php echo $product->product; ?></h4>
            <p class="text-muted small mb-2"><?php echo $product->category; ?></p>
            <p style="color:green;"><b>Rp. <?php echo number_format($product->price,2,',','.'); ?></b> </p>
            <center>
            <a href="<?php echo base_url('detailProduct/'.$product->id) ?>" class="btn btn-success" >Detail</a> &nbsp;&nbsp;&nbsp;
          </center>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

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
            <input type="text" class="form-control" placeholder="Masukan judul" name="title" value="<?php echo $item->title ?>" disabled>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" cols="80" placeholder="Masukan keterangan" class="form-control" disabled><?php echo $item->description ?></textarea>
          </div>
          <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; ?>