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
</div>
