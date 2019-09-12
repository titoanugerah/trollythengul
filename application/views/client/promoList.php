<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Promo</h2>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <?php $style = array(0 => 'skew-shadow', 1 => 'bubble-shadow', 2=> 'curves-shadow'); foreach ($promo as $item): //if($item->status==0){continue;} ?>
        <div class="col-md-4">
          <?php if($item->used==0 && $item->status==1){$color =  'success';}elseif($item->available==0 or $item->deadline<=0 or $item->status==0 ){$color =  'danger';}elseif($item->available<=(($item->qty)/4)){$color =  'warning';}else{$color =  'secondary';}  ?>
          <a data-toggle="modal" data-target="#detailPromo<?php echo $item->id;?>">
          <div class="card card-dark bg-success-gradient">
            <div class="card-body <?php echo $style[rand(0,2)] ?>">
              <img src="<?php echo base_url('./assets/template/AtlantisLite/'); ?>/assets/img/promo.png" height="39" alt="Visa Logo">
              <h2 class="py-4 mb-0"><?php echo '*'.$item->promo_code.'*'; ?></h2>
              <div class="row">
                <div class="col-8 pr-0">
                  <h3 class="fw-bold mb-1"><?php echo $item->promo; ?></h3>
                  <div class="text-small text-uppercase fw-bold op-8"><?php echo 'used : '.$item->used.' of '.$item->qty; ?></div>
                </div>
                <div class="col-4 pl-0 text-right">
                  <h3 class="fw-bold mb-1"><?php echo $item->due_date; ?></h3>
                  <div class="text-small text-uppercase fw-bold op-8"><?php if($item->status==0){echo 'Nonaktif';} elseif($item->available==0){echo 'Penuh';}elseif($item->status==1){echo 'Aktif';} ?></div>
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



<?php foreach ($promo as $item): ?>
<div class="modal fade" id="detailPromo<?php echo $item->id;?>" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Promo</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body row">
          <div class="form-group col-6 col-md-6">
            <label>Nama Promo</label>
            <input type="text" class="form-control" name="id" value="<?php echo $item->id; ?>" hidden>
            <input type="text" class="form-control" placeholder="Masukan nama promo" name="name" value="<?php echo $item->promo; ?>" required>
          </div>
          <div class="form-group col-6 col-md-6">
            <label>Kode Promo</label>
            <input type="text" class="form-control" placeholder="Masukan kode promo" name="promo_code"  value="<?php echo $item->promo_code; ?>" required>
          </div>
          <div class="form-group col-6 col-md-12">
            <label>Deskripsi</label>
            <textarea name="description" rows="2" cols="80" placeholder="Masukan keterangan promo" class="form-control" required><?php echo $item->description; ?></textarea>
          </div>
          <div class="form-group col-6 col-md-6">
            <label>Diskon</label>
            <input type="text" class="form-control" placeholder="Potongan harga" name="discount" value="<?php echo $item->discount; ?>" required>
          </div>
          <div class="form-group col-6 col-md-6">
            <label>Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" placeholder="DD/MM/YYYY" name="date_expired" value="<?php echo date('Y-m-d',strtotime($item->date_expired)); ?>" required>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
