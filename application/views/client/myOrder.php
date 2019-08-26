<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Status Order</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="<?php echo base_url('myCart'); ?>" class="btn btn-success btn-round">Kembali Ke Keranjang</a>

      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Belum Diproses</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab2">Diproses Toko</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab3">Dikirim</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab4">Diterima</a>

    </div>
  </div>
</div>

<div class="tab-content mt-2 mb-3" >
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-12">
        <br>
        <?php foreach ($detailOrder as $item): if($item->status>=3){continue;} ?>
          <div class="card col-md-6">
            <div class="card-body">
              <div class="row">
                <div class="col-5 pl-2">
                  <a href="<?php echo base_url('detailProduct/'.$item->id_product); ?>">
                    <img src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="" style="max-width:180px;" class="rounded">
                  </a>
                </div>

                <div class="col-7 pl-1">
                  <strong><?php echo $item->product; ?></strong><br>
                  <strong>Pesanan Khusus &nbsp;&nbsp;&nbsp;: <?php echo $item->special_request; ?></strong><br>
                  <strong>Jumlah Pesanan &nbsp;&nbsp;&nbsp;: <?php echo $item->qty.' buah'; ?></strong><br>
                  <strong>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp.<?php echo number_format($item->price*$item->qty,'2',',','.'); ?></strong>
                </div>
              </div>
            </div>
            <div class="card-footer row">
              <div class="col-5">
                <?php echo $item->merchant; ?>

              </div>
              <div class="col-7">
                <?php
                if($item->status==1){$status = 'Menunggu verifikasi dari admin';} ?>
                <strong style="color:green;"><?php echo $status; ?></strong>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
  <div class="tab-pane fade show" id="tab2" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-12">
        <br>
        <?php foreach ($detailOrder as $item): if($item->status!=3){continue;} ?>
          <div class="card col-md-6">
            <div class="card-body">
              <div class="row">
                <div class="col-5 pl-2">
                  <a href="<?php echo base_url('detailProduct/'.$item->id_product); ?>">
                    <img src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="" style="max-width:180px;" class="rounded">
                  </a>
                </div>

                <div class="col-7 pl-1">
                  <strong><?php echo $item->product; ?></strong><br>
                  <strong>Pesanan Khusus &nbsp;&nbsp;&nbsp;: <?php echo $item->special_request; ?></strong><br>
                  <strong>Jumlah Pesanan &nbsp;&nbsp;&nbsp;: <?php echo $item->qty.' buah'; ?></strong><br>
                  <strong>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp.<?php echo number_format($item->price*$item->qty,'2',',','.'); ?></strong>
                </div>
              </div>
            </div>
            <div class="card-footer row">
              <div class="col-4">
                <?php echo $item->merchant; ?>

              </div>
              <div class="col-8">
                <?php
                if($item->status==3){$status = 'Sedang dalam proses pengemasan oleh Toko';} ?>
                <strong style="color:green;"><?php echo $status; ?></strong>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
  <div class="tab-pane fade show" id="tab3" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-12">
        <br>
        <?php foreach ($detailOrder as $item): if($item->status!=4){continue;} ?>
          <div class="card col-md-6">
            <div class="card-body">
              <div class="row">
                <div class="col-5 pl-2">
                  <a href="<?php echo base_url('detailProduct/'.$item->id_product); ?>">
                    <img src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="" style="max-width:180px;" class="rounded">
                  </a>
                </div>

                <div class="col-7 pl-1">
                  <strong><?php echo $item->product; ?></strong><br>
                  <strong>Pesanan Khusus &nbsp;&nbsp;&nbsp;: <?php echo $item->special_request; ?></strong><br>
                  <strong>Jumlah Pesanan &nbsp;&nbsp;&nbsp;: <?php echo $item->qty.' buah'; ?></strong><br>
                  <strong>Nomor Resi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $item->awb; ?></strong>
                </div>
              </div>
            </div>
            <div class="card-footer row">
              <div class="col-3">
                <button type="button" data-toggle="modal" data-target="#rating<?php echo $item->id ?>" name="confirmArrived" value="confirmArrived" class="btn btn-success">Barang Sudah Sampai</button>
              </div>
              <div class="col-9">
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
  <div class="tab-pane fade show" id="tab4" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-12">
        <br>
        <?php foreach ($detailOrder as $item): if($item->status!=5){continue;} ?>
          <div class="card col-md-6">
            <div class="card-body">
              <div class="row">
                <div class="col-5 pl-2">
                  <a href="<?php echo base_url('detailProduct/'.$item->id_product); ?>">
                    <img src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="" style="max-width:180px;" class="rounded">
                  </a>
                </div>

                <div class="col-7 pl-1">
                  <strong><?php echo $item->product; ?></strong><br>
                  <strong>Pesanan Khusus &nbsp;&nbsp;&nbsp;: <?php echo $item->special_request; ?></strong><br>
                  <strong>Jumlah Pesanan &nbsp;&nbsp;&nbsp;: <?php echo $item->qty.' buah'; ?></strong><br>
                  <strong>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp.<?php echo number_format($item->price*$item->qty,'2',',','.'); ?></strong>
                </div>
              </div>
            </div>
            <div class="card-footer row">
              <div class="col-5">
                <?php echo $item->merchant; ?>

              </div>
              <div class="col-7">
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</div>




<?php foreach ($detailOrder as $item): ?>

  <div class="modal fade" id="rating<?php echo $item->id; ?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h4>Komentar dan Rating</h4>
          </center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form role="form" method="post">
          <div class="modal-body">
            Mohon periksa kembali kondisi barang yang sudah sampai, kemudian tulis ulasan anda disini
            <textarea name="comment" rows="3" cols="80" class="form-control" placeholder="Tulis ulasan anda disini"></textarea>
            <input type="text" name="id" value="<?php echo $item->id ?>" hidden>
            <div class="form-group">
              <label class="form-label">Rating</label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="rating" value="1" class="selectgroup-input" checked="">
                  <span class="selectgroup-button">1</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="rating" value="2" class="selectgroup-input">
                  <span class="selectgroup-button">2</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="rating" value="3" class="selectgroup-input">
                  <span class="selectgroup-button">3</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="rating" value="4" class="selectgroup-input">
                  <span class="selectgroup-button">4</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="rating" value="5" class="selectgroup-input">
                  <span class="selectgroup-button">5</span>
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="confirmArrived" value="confirmArrived">Konfirmasi Barang</button>
            <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<script type="text/javascript" src="//rajaongkir.com/script/widget.js"></script>
