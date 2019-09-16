<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Detail Akun <?php echo $detail->fullname; ?></h2>
        <h5 class="text-white op-7 mb-2"> @<?php echo $detail->username; ?></h5>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
      </div>
    </div>
  </div>
</div>
<div class="page-navs bg-white">
  <div class="nav-scroller">
    <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
      <a class="nav-link active show" data-toggle="tab" href="#tab1">Profil Akun</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab0">Profil Merchant</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab2">Riwayat Pembelian</a>
      <a class="nav-link mr-5" data-toggle="tab" href="#tab3">Riwayat Pengiriman</a>

    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="tab-content mt-2 mb-3" >
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" >
        <form  method="post">
          <div class="card-header">
            <h4>Profil Pengguna</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group">
                <label>Nama Pengguna Akun</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                  </div>
                  <input type="text" class="form-control" placeholder="Masukan username" aria-label="Username" aria-describedby="basic-addon1" name="username" value="<?php echo $detail->username; ?>">
                </div>
              </div>

              <div class="form-group col-6 col-md-5">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="fullname" value="<?php echo $detail->fullname; ?>">
              </div>

              <div class="form-group col-6 col-md-4">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Masukan email anda" name="email" value="<?php echo $detail->email; ?>">
              </div>
            </div>
          </div>
          <div class="card-action">
            <a class="btn btn-warning btn round" data-toggle="modal" data-target="#resetPassword">Reset Password</a>
            <a class="btn btn-danger btn round" data-toggle="modal" data-target="#deactivateAccount" style="color:white;" <?php if($detail->status==0){echo 'hidden';} ?>>Nonaktifkan</a>
            <a class="btn btn-info btn round" data-toggle="modal" data-target="#activateAccount" style="color:white;" <?php if($detail->status==1){echo 'hidden';} ?>>Aktifkan</a>
            <a href="<?php echo base_url('account/1'); ?>" class="btn btn-info">Kembali</a>
          </div>
        </form>
      </div>
      <div class="tab-pane fade show" id="tab0" role="tabpanel" >
        <form  method="post">
          <div class="card-header">
            <h4>Profil Merchant</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label>Nama Merchant</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Masukan nama merchant" aria-label="name" aria-describedby="basic-addon1" name="name" value="<?php echo $detail->merchant; ?>">
                </div>
              </div>

              <div class="form-group col-6 col-md-3">
                <label>Nomor Telepon</label>
                <input type="text" class="form-control" placeholder="Masukan nomor telepon" name="phone_number" value="<?php echo $detail->phone_number; ?>">
              </div>

              <div class="form-group col-6 col-md-3">
                <label>Tanggal Mendaftar</label>
                <input type="text" class="form-control" value="<?php echo $detail->join_date; ?>">
              </div>
              <div class="form-group col-6 col-md-3">
                <label>Nomor KTP</label>
                <input type="text" class="form-control" value="<?php echo $detail->idc_number; ?>">
              </div>


            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Alamat</label>
                <input type="text" class="form-control" placeholder="Masukan jalan toko anda" name="address_street" value="<?php echo $detail->address_street; ?>">
              </div>
              <div class="form-group col-md-2">
                <label>Kota</label>
                <input type="text" class="form-control" placeholder="Masukan kota toko anda" name="address_city" value="<?php echo $detail->address_city; ?>">
              </div>
              <div class="form-group col-md-2">
                <label>Provinsi</label>
                <input type="text" class="form-control" placeholder="Masukan provinsi toko anda" name="address_province" value="<?php echo $detail->address_city; ?>">
              </div>
              <div class="form-group col-md-2">
                <label>kode pos</label>
                <input type="text" class="form-control" placeholder="Masukan kode pos toko anda" name="address_postal_code" value="<?php echo $detail->address_postal; ?>">
              </div>

            </div>
          </div>
          <div class="card-action">
            <a class="btn btn-warning btn round" data-toggle="modal" data-target="#resetPassword">Reset Password</a>
            <a class="btn btn-danger btn round" data-toggle="modal" data-target="#deactivateAccount" style="color:white;" <?php if($detail->status==0){echo 'hidden';} ?>>Nonaktifkan</a>
            <a class="btn btn-info btn round" data-toggle="modal" data-target="#activateAccount" style="color:white;" <?php if($detail->status==1){echo 'hidden';} ?>>Aktifkan</a>
            <a href="<?php echo base_url('account/1'); ?>" class="btn btn-info">Kembali</a>
          </div>
        </form>
      </div>
      <div class="tab-pane fade show " id="tab2" role="tabpanel" >
        <div class="bd-example">
          <div class="table-responsive">
            <table id="multi-filter-select" class="display table table-striped table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Total</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Total</th>
                  <th>Opsi</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $i=1;foreach ($order as $item): ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $item->product ?></td>
                    <td><?php echo $item->sold ?></td>
                    <td> <a href="<?php echo base_url('detailProduct/'.$item->id_product); ?>" class="btn btn-info"> Detail </a> </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show " id="tab3" role="tabpanel" >
        <div class="bd-example">
          <div class="table-responsive">
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

    </div>
  </div>
</div>

<div class="modal fade" id="deactivateAccount" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Nonaktifkan Akun</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body row">
          <div class="form-group col-6 col-md-12">
            <p>Apabila anda setuju untuk menonaktifkan akun ini silahkan masukan password anda</p>
            <input type="password" class="form-control" placeholder="Masukan password anda" name="password" required>
          </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="deactivateAccount" value="deactivateAccount">Nonaktifkan Akun</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="activateAccount" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Aktifkan Akun</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body row">
          <div class="form-group col-6 col-md-12">
            <p>Apabila anda setuju untuk mengaktifkan akun ini silahkan masukan password anda</p>
            <input type="password" class="form-control" placeholder="Masukan password anda" name="password" required>
          </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" name="activateAccount" value="activateAccount">Aktifkan Akun</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="resetPassword" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Reset Password</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body row">
          <div class="form-group col-6 col-md-12">
            <p>Apabila anda setuju untuk mereset password akun ini silahkan masukan password anda</p>
            <input type="password" class="form-control" placeholder="Masukan password anda" name="password" required>
          </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" name="resetPassword" value="resetPassword">Reset Password</button>
          <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
