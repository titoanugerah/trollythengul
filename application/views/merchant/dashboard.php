<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<div class="page-inner">
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-primary card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="flaticon-users"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Pembeli</p>
                <h4 class="card-title"><?php echo $sales->buyer ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-info card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="flaticon-interface-6"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Overal Rating</p>
                <h4 class="card-title"><?php echo number_format($sales->rating,2,',','.'); ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-success card-round">
        <div class="card-body ">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="flaticon-analytics"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Sales</p>
                <h4 class="card-title"><?php echo $sales->sales; ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-secondary card-round">
        <div class="card-body ">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="flaticon-success"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Keuntungan</p>
                <h4 class="card-title"><?php echo 'Rp.'.number_format($sales->profit,0,',','.') ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<script>
Highcharts.chart('container', {

    title: {
        text: 'Grafik Penjualan Per Bulan'
    },
    yAxis: {
        title: {
            text: 'Penjualan'
        }
    },
    xAxis: {
      categories: [<?php foreach($graph as $item){echo '"'.$item->date.'"'.',';} ?>]
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },


    series: [{
        name: 'Produk Terjual',
        data: [<?php foreach($graph as $item){echo $item->sold.',';} ?>]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
<div class="card">
   <div class="card-header">
                  <h4 class="card-title">Penjualan Sukses</h4>
                </div>
  <div class="card-body">
    <div class="bd-example">
      <div class="table-responsive">
         <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pesan</th>
              <th>Toko</th>
              <th>Pemesan</th>
              <th>Alamat Pengiriman</th>
              <th>Jasa Pengiriman</th>
              <th>Jumlah</th>
              <th>Produk</th>
              <th>Harga</th>
              <th>Ongkos Kirim</th>
              <th>Subtotal</th>
             <th>Status</th>
            </tr>
          </thead>
         
          <tbody>
            <?php $i=1;foreach ($order_merchant as $item): ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item->date_order ?></td>
                <td><?php echo $item->merchant ?></td>
                <td><?php echo $item->fullname ?></td>
                <td><?php echo $item->shipment_street.' '.$item->shipment_city.' '.$item->shipment_province.' '.$item->shipment_postal_code; ?></td>
                <td><?php echo explode( '/',$item->courier)[0].' '.$item->type; ?></td>
                 <td><?php echo $item->qty ?></td>
                  <td><?php echo $item->product ?></td>
                   <td><?php echo $item->price ?></td>
                    <td><?php echo $item->shipment_fee ?></td>
                     <td><?php echo $item->subtotal ?></td>
                <td><?php
                if($item->status==5){$status="Success";} ?>
                <strong style="color:green;"><?php echo $status; ?></strong></td>
              
               
              </tr>
            <?php $i++;endforeach;  ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>


              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Penjualan Dalam Proses</h4>
                </div>
  <div class="card-body">
    <div class="bd-example">
      <div class="table-responsive">
         <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pesan</th>
              <th>Toko</th>
              <th>Pemesan</th>
              <th>Alamat Pengiriman</th>
              <th>Jasa Pengiriman</th>
              <th>Jumlah</th>
              <th>Produk</th>
              <th>Harga</th>
              <th>Ongkos Kirim</th>
              <th>Subtotal</th>
              <th>Status</th>
            </tr>
          </thead>
         
          <tbody>
            <?php $i=1;foreach ($order_proses_merchant as $item): if($item->status>=5 || $item->status<0){continue;} ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item->date_order ?></td>
                <td><?php echo $item->merchant ?></td>
                <td><?php echo $item->fullname ?></td>
                <td><?php echo $item->shipment_street.' '.$item->shipment_city.' '.$item->shipment_province.' '.$item->shipment_postal_code; ?></td>
                <td><?php echo explode( '/',$item->courier)[0].' '.$item->type; ?></td>
                 <td><?php echo $item->qty ?></td>
                  <td><?php echo $item->product ?></td>
                   <td><?php echo $item->price ?></td>
                    <td><?php echo $item->shipment_fee ?></td>
                     <td><?php echo $item->subtotal ?></td>
                 <td><?php
                if($item->status==0){$status="Barang masuk keranjang";}elseif($item->status==1){$status = 'Menunggu verifikasi dari admin';}elseif($item->status==2){$status = 'Menunggu dikonfirmasi oleh toko';}elseif($item->status==3){$status = 'Sedang dalam proses pengemasan oleh Toko';}elseif($item->status==4){$status = 'Dikirim';} ?>
                <strong style="color:green;"><?php echo $status; ?></strong></td>
              
               
              </tr>
            <?php $i++;endforeach;  ?>
          </tbody>
        </table>
      </div>
   

  </div>
</div>
</div>