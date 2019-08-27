
<div class="panel-header bg-<?php echo $webconf->theme_color ?>-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Profil</h2>
        <h5 class="text-white op-7 mb-2"> <?php echo $this->session->userdata['fullname']; ?></h5>
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
<form  method="post">
<div class="card">
  <div class="tab-content mt-2 mb-3" >
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" >

        <div class="card-body">
          <div class="row">
            <div class="form-group">
              <label>Nama Pengguna Akun</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Masukan username" aria-label="Username" aria-describedby="basic-addon1" name="username" value="<?php echo $this->session->userdata['username']; ?>">
              </div>
            </div>

            <div class="form-group col-6 col-md-5">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Masukan nama lengkap" name="fullname" value="<?php echo $this->session->userdata['fullname']; ?>">
            </div>

            <div class="form-group col-6 col-md-4">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Masukan email anda" name="email" value="<?php echo $this->session->userdata['email']; ?>">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" name="updateAccount" value="updateAccount" class="btn btn-info">Simpan Data</button>
        </div>
      </div>
      <div class="tab-pane fade show" id="tab0" role="tabpanel" >

        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Nama Merchant</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Masukan nama merchant" aria-label="name" aria-describedby="basic-addon1" name="name" value="<?php echo $this->session->userdata['merchant']; ?>">
              </div>
            </div>

            <div class="form-group col-6 col-md-3">
              <label>Nomor Telepon</label>
              <input type="text" class="form-control" placeholder="Masukan nomor telepon" name="phone_number" value="<?php echo $this->session->userdata['phone_number']; ?>">
            </div>

            <div class="form-group col-6 col-md-3">
              <label>Tanggal Mendaftar</label>
              <input type="text" class="form-control" value="<?php echo $this->session->userdata['join_date']; ?>">
            </div>
            <div class="form-group col-6 col-md-3">
              <label>Nomor KTP</label>
              <input type="text" name="idc_number" class="form-control" value="<?php echo $this->session->userdata['idc_number']; ?>">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Alamat</label>
              <input type="text" class="form-control" placeholder="Masukan jalan toko anda" name="address_street" value="<?php echo $this->session->userdata['address_street']; ?>">
            </div>
            <div class="form-group col-4 col-md-4">
              <label>Domisili</label> &nbsp;&nbsp;&nbsp;&nbsp;<br>
              <select class="select2basic form-control" name="city_id" style="width:500px">
                <?php foreach ($origin as $item):?>
                  <option value="<?php echo $item->city_id ?>" <?php if($item->city_id==$this->session->userdata['city_id']){echo 'selected';} ?>><?php echo $item->type.'  '.$item->city_name.', '.$item->province; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" name="updateAccount" value="updateAccount" class="btn btn-info">Simpan Data</button>
          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info">Upload Foto Profil</button>
        </div>
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
                    <td><?php echo (($item->price*$item->qty)+$item->shipment_fee) ?></td>
                    <td> <a href="<?php echo base_url('detailAccount/'.$item->id); ?>" class="btn btn-info"> Detail </a> </td>
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
</form>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4> Ganti Foto</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <br>
          </center>
          <input type="file" name="fileUpload" class="btn btn-primary">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="uploadDP" value="uploadDP">Upload Foto</button>
        <button type="button" class="btn btn-grey" data-dismiss="modal">Kembali</button>
      </div>
    </form>
  </div>
</div>
</div>
