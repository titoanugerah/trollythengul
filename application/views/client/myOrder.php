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
</div>



<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Pembayaran</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          Silahkan lakukan transfer sebanyak <b><?php echo 'Rp.'.number_format($order->subtotal,2,',','.'); ?></b> ke
          <div class="row">

          <div class="form-group col-6 col-md-3">
            <label>Nama Bank</label>
            <input type="text" class="form-control" value="<?php echo $webconf->bank_name; ?>" required>
          </div>

          <div class="form-group col-6 col-md-4">
            <label>Nomor Rekening</label>
            <input type="text" class="form-control" value="<?php echo $webconf->bank_account; ?>" required>
          </div>
          <div class="form-group col-6 col-md-5">
            <label>Nama Penerima</label>
            <input type="text" class="form-control" value="<?php echo $webconf->bank_user; ?>" required>
          </div>
        </div>
        kemudian upload bukti pembayaran pada kolom dibawah ini
        <div class="form-group">
        </center>
        <input type="file" name="fileUpload" class="btn btn-primary" required>
      </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="uploadPayment" value="uploadPayment">Upload Bukti Pembayaran</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="//rajaongkir.com/script/widget.js"></script>
