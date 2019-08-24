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
            <img class="card-img-top rounded" src="<?php echo base_url('./assets/upload/'.$product->image); ?>" alt="Product 1" style="height: 140px;">
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
