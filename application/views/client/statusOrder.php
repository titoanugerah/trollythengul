<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Status Order</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Produk</a>
      <a class="nav-link" data-toggle="tab" href="#tab2">Toko</a>
      <a class="nav-link" data-toggle="tab" href="#tab3">Rating & Komentar Pelanggan</a>
      <a class="nav-link" data-toggle="tab" href="#tab4">Statistik Pengiriman</a>

    </div>
  </div>
</div>
<div class="tab-content mt-2 mb-3" >
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-8">
        <br>
        <?php foreach ($detailOrder as $item): ?>
          <div class="card">

            <div class="card-body">
              <div class="row">

                <div class="col-4 pl-2">
                  <img src="<?php echo base_url('./assets/upload/'.$item->image); ?>" alt="" style="max-width:180px;" class="rounded">
                </div>
                <div class="col-8 pl-1">
                  <strong><?php echo $item->product; ?></strong><br>
                  <strong>Pesanan Khusus &nbsp;&nbsp;&nbsp;: <?php echo $item->special_request; ?></strong><br>
                  <strong>Jumlah Pesanan &nbsp;&nbsp;&nbsp;: <?php echo $item->qty.' buah'; ?></strong><br>
                  <strong>Harga Satuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp.<?php echo number_format($item->price,'2',',','.'); ?></strong><br>

                </div>
              </div>

            </div>
            <div class="card-footer row">
              <div class="col-8">
                <?php echo $item->merchant; ?>

              </div>
              <div class="col-4">
                <strong>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp; Rp.<?php echo number_format($item->price*$item->qty,'2',',','.'); ?></strong>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-md-4">
        <br>
        <div class="card">
          <div class="card-header">
            Subtotal
          </div>
          <div class="card-body row">
            <div class="col-md-6">
              Produk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            </div>
            <div class="col-md-6">
              <b>Rp. <?php  echo number_format($order->total,'2',',','.'); ?></b>
            </div>
            <div class="col-md-6">
              Ongkos Kirim&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
            </div>
            <div class="col-md-6">
              <b>Rp. <?php  echo number_format($order->shipment_fee_total,'2',',','.'); ?></b>
            </div>
            <div class="col-md-6">
              Biaya Admin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
            </div>
            <div class="col-md-6">
              <b>Rp. <?php  echo number_format(7500,'2',',','.'); ?></b>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            lalala
          </div>
          <div class="card-body">

          <div data-theme="light" id="rajaongkir-widget"></div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade show" id="tab2" role="tabpanel" >
    <div class="card-body">

    </div>

  </div>
  <div class="tab-pane fade show" id="tab3" role="tabpanel">
    <br>

  </div>
  <div class="tab-pane fade show" id="tab4" role="tabpanel">
    <div class="table-responsive" hidden>
      <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Provinsi</th>
            <th>Order</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Provinsi</th>
            <th>Order</th>
          </tr>
        </tfoot>
        <tbody>
          <?php $i=1;foreach ($shipment as $item): ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $item->shipment_province; ?></td>
              <td><?php echo $item->shipment_count.' kali order'; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Ke Keranjang : <?php $product->product; ?></h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body row">
          <div class="form-group col-6 col-md-3">
            <label>Banyak Barang</label>
            <input type="text" class="form-control" name="qty" value="1" required>
          </div>

          <div class="form-group col-6 col-md-9">
            <label>Permintaan Khusus</label>
            <textarea name="special_request" rows="3" cols="100" placeholder="Tambahkan permintaan anda, misal warma, motif dan lain lain " class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="addToCart" value="addToCart">Tambahkan Ke Keranjang</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="//rajaongkir.com/script/widget.js"></script>
