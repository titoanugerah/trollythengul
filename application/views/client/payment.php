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
<div class="tab-content mt-2 mb-3" >
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
    <div class="col-md-12 row">
      <div class="col-md-7">
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
      <div class="col-md-5">
        <br>
        <div class="card">
          <div class="card-header">
            Promo
          </div>
          <div class="card-body">
            <form  method="post">
              <div class="form-group">
                <div class="row">
                  <input class="form-control col-7" type="text" name="promo_code" value="<?php echo $order->promo_code; ?>" placeholder="Masukan Kode Promo">
                  <button type="submit" name="addPromo" value="addPromo" class="btn btn-info" <?php if($order->promo_code!='' || $order->promo_code!=null){echo 'hidden';} ?>>Tambah Promo</button>
                  <button type="submit" name="deletePromo" value="deletePromo" class="btn btn-danger" <?php if($order->promo_code=='' || $order->promo_code==null){echo 'hidden';} ?>>Hapus Promo</button>
                </div>
              </div>

              <div class="card card-dark bg-success-gradient" <?php if($order->promo_code==''||$order->promo_code==null){echo 'hidden';} ?>>
                <div class="card-body bubble-shadow">
                  <img src="<?php echo base_url('./assets/template/AtlantisLite/'); ?>/assets/img/promo.png" height="39" alt="Visa Logo">
                  <h2 class="py-4 mb-0"><?php echo '*'.$order->promo_code.'*'; ?></h2>
                  <div class="row">
                    <div class="col-8 pr-0">
                      <h3 class="fw-bold mb-1"><?php echo $promo->promo; ?></h3>
                    </div>
                    <div class="col-4 pl-0 text-right">
                      <h3 class="fw-bold mb-1"><?php echo $promo->due_date; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            Tujuan Pengiriman
          </div>
          <form method="post">
            <div class="card-body">
              <div class="form-group">
                <select class="select2basic form-control" name="city_id" style="width:360px">
                  <?php foreach ($destination as $item):?>
                    <option value="<?php echo $item->city_id ?>" <?php if($item->city_id==$order->city_id){echo 'selected';} ?>><?php echo $item->type.'  '.$item->city_name.', '.$item->province; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Alamat Spesifik Pengiriman</label>
                <textarea name="shipment_street" rows="2" cols="80" placeholder="Tuliskan alamat lengkap pada kolom ini" class="form-control"><?php echo $order->shipment_street; ?></textarea>
              </div>
              <div class="form-group col-4 col-md-4">
                <label>Kurir Pengiriman</label> &nbsp;&nbsp;&nbsp;&nbsp;<br>
                <select class="select2basic form-control" name="courier" style="width:360px">
                  <option value="jne/0" <?php if($order->courier=="jne/0"){echo 'selected';} ?>>JNE - OKE</option>
                  <option value="jne/1" <?php if($order->courier=="jne/1"){echo 'selected';} ?>>JNE - Reguler</option>
                  

                  <option value="pos/1" <?php if($order->courier=="pos/1"){echo 'selected';} ?>>POS Indonesia - Express Next Day(1 Hari)</option>
                  <option value="pos/0" <?php if($order->courier=="pos/0"){echo 'selected';} ?>>POS Indonesia - Kilat Khusus (1-2 Hari)</option>
                  <option value="tiki/0" <?php if($order->courier=="tiki/0"){echo 'selected';} ?>>TIKI - Economy</option>
                  <option value="tiki/1" <?php if($order->courier=="tiki/1"){echo 'selected';} ?>>TIKI - Reguler</option>
                  
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="setDestination" value="setDestination" class="btn btn-success">Set Lokasi</button>
            </div>
          </form>
        </div>
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
            <div class="col-md-6">
              Diskon Promosi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
            </div>
            <div class="col-md-6">
              <b>Rp.<?php echo number_format($order->discount,'2',',','.'); ?></b>
            </div>
            <div class="col-md-6">
              Kode Unik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
            </div>
            <div class="col-md-6">
              <b>Rp.<?php echo number_format($order->unique,'2',',','.'); ?></b>
            </div>
            <br><br>
            <div class="col-md-6">
              Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
            </div>
            <div class="col-md-6">
              <b>Rp.<?php echo number_format($order->subtotal,'2',',','.'); ?></b>
            </div>
          </div>
          <div class="card-footer">
            <button type="button" id="pay-button" class="btn btn-success">Lanjutkan Ke Pembayaran</button>
          </div>
           <div class="card-header">
            <b>PERHATIAN !!</b>
          </div>
          <div class="col-md-10">
            Screenshot bukti pembayaran 'berhasil' beserta id order dan nominal pembayaran agar proses pemesanan dapat berjalan
          </div>
         <div class="card-footer">
            Upload bukti pembayaran <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Disini</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <!-- <center>
          <h4>Pembayaran</h4>
        </center>-->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
         <div class="modal-body">
          <!--Silahkan lakukan transfer sebanyak <b><?php echo 'Rp.'.number_format($order->subtotal,2,',','.'); ?></b> ke
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
            <input type="text" class="form-control" name="amount" value="<?php echo $order->subtotal; ?>" hidden>

          </div>
        </div>-->
        Upload Bukti Pembayaran
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

<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-OB0r30WpR8NYSehn"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function(){
    // This is minimal request body as example.
    // Please refer to docs for all available options: https://snap-docs.midtrans.com/#json-parameter-request-body
    // TODO: you should change this gross_amount and order_id to your desire.
    var requestBody =
    {
      transaction_details: {
        gross_amount: <?php echo $order->subtotal; ?>,
        // as example we use timestamp as order ID
        order_id: <?php echo $order->id; ?>
      }
    }

    getSnapToken(requestBody, function(response){
      var response = JSON.parse(response);
      console.log("new token response", response);
      // Open SNAP payment popup, please refer to docs for all available options: https://snap-docs.midtrans.com/#snap-js
      snap.pay(response.token);
    })
  };
  /**
  * Send AJAX POST request to checkout.php, then call callback with the API response
  * @param {object} requestBody: request body to be sent to SNAP API
  * @param {function} callback: callback function to pass the response
  */
  function getSnapToken(requestBody, callback) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        callback(xmlHttp.responseText);
      }
    }
    xmlHttp.open("post", "http://trollythengul.imatft.online/checkout");
    xmlHttp.send(JSON.stringify(requestBody));
  }
</script>

