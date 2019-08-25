<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Verifikasi Pembayaran</h2>
        <h5 class="text-white op-7 mb-2"> Halaman panel pengelolaan verifikasi pembayaran</h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#addPromo">Tambah Promo</button> &nbsp;
        <button type="button" class="btn btn-success btn-round" data-toggle="modal" data-target="#recoverPromo" hidden>Kembalikan Promo Terhapus</button>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <?php $style = array(0 => 'skew-shadow', 1 => 'bubble-shadow', 2=> 'curves-shadow'); foreach ($order as $item): //if($item->status==0){continue;} ?>
        <div class="col-md-4">
          <a data-toggle="modal" data-target="#$detailOrder<?php echo $item->id;?>">
          <div class="card card-dark bg-secondary-gradient">
            <div class="card-body <?php echo $style[rand(0,2)] ?>">
              <img src="<?php echo base_url('./assets/template/AtlantisLite/'); ?>/assets/img/visa.svg" height="20" alt="Visa Logo">
              <h2 class="py-4 mb-0"><?php echo 'Order #'.$item->id; ?></h2>
              <div class="row">
                <div class="col-6 pr-0">
                  <h3 class="fw-bold mb-1"><?php echo $item->fullname; ?></h3>
                  <div class="text-small text-uppercase fw-bold op-8"><?php echo $item->date_order; ?></div>
                </div>
                <div class="col-6 pl-0 text-right">
                  <h3 class="fw-bold mb-1"><?php echo 'Rp. '.number_format($item->subtotal, 2,',','.'); ?></h3>
                </div>
              </div>
            </div>
          </div>
        </a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</div>

<?php foreach ($order as $item): ?>
<div class="modal fade" id="$detailOrder<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Pembayaran</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="form-group">
            <img src="<?php echo base_url('./assets/upload/'.$item->payment_image) ?>" style="max-width:450px">
          </div>
          <div class="form-group">
            <label>Nominal yang harus dibayarkan </label>
            <input type="text" class="form-control" name="id" value="<?php echo $item->id; ?>" hidden>
            <input type="text" class="form-control" value="<?php echo 'Rp. '.number_format($item->subtotal,2,',','.'); ?>" disabled>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="approvePayment" value="approvePayment">Verifikasi Pembayaran</button>
          <button type="submit" class="btn btn-danger" name="declinePayment" value="declinePayment">Tolak Pembayaran</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
