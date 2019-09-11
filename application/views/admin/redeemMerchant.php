<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Pembayaran Ditangguhkan</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="bd-example">
      <div class="table-responsive">
        <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Merchant</th>
              <th>Transaksi</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Merchant</th>
              <th>Transaksi</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $i=1;foreach ($redeem as $item): ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item->name ?></td>
                <td><?php echo $item->transaction_count ?></td>
                <td><?php echo $item->transaction_amount ?></td>
                <td><?php if($item->status==5) {echo 'Belum Dibayar';} else {echo "Sudah Dibayar";} ?></td>
                <td> <a href="<?php echo base_url('redeem/'.$item->id_merchant); ?>" class="btn btn-success" <?php if($item->status==6){echo 'hidden';} ?>>Konfirmasi Bayar</a></td>
              </tr>
            <?php endforeach; $i++; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
