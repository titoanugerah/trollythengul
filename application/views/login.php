<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login | <?php echo $webconf->office_name; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
	WebFont.load({
		google: {"families":["Lato:300,400,700,900"]},
		custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url('./assets/template/AtlantisLite'); ?>/assets/css/fonts.min.css']},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url('./assets/template/newlogin'); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('./assets/template/newlogin'); ?>/assets/css/atlantis.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Masuk</h3>
			<form  method="post">

				<div class="login-form">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<a href="<?php echo base_url('forgotPassword'); ?>" class="link float-right">Lupa Password?</a>
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3">
						<button type="submit" name="loginValidation" value="loginValidation" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
					</div>
					<div class="login-account">
						<span class="msg">Belum punya akun?</span>
						<a href="#" id="show-signup" class="link">Daftar sekarang</a>
					</div>
				</div>
			</form>
		</div>

		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Daftar Pengguna Baru</h3>
			<form  method="post">
				<div class="login-form">
					<div class="form-group">
						<label for="fullname" class="placeholder"><b>Username</b></label>
						<input  id="fullname" name="username" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email" class="placeholder"><b>Email</b></label>
						<input  id="email" name="email" type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email" class="placeholder"><b>Jenis Akun</b></label>
						<select class="form-control" name="role">
							<option value="client">Pembeli</option>
							<option value="merchant">Penjual</option>
						</select>
					</div>

					<div class="row form-action">
						<div class="col-md-3">
							<a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Batal</a>
						</div>
						<div class="col-md-6">
							<button type="submit" name="register" value="register" class="btn btn-primary float-right  fw-bold">Daftar</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/core/popper.min.js"></script>
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/core/bootstrap.min.js"></script>
	<script src="<?php echo base_url('./assets/template/newlogin'); ?>/assets/js/atlantis.min.js"></script>
	<script src="<?php echo base_url('./assets/template/AtlantisLite/'); ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script type="text/javascript">
		//Notify
		<?php if($this->session->userdata['notify']){
			echo "$.notify({icon: '".$this->session->userdata['icon']."',
			title: '".$this->session->userdata['title']."',
			message: '".$this->session->userdata['message']."',},{
				type: '".$this->session->userdata['type']."',
				placement : { from: 'bottom', align: 'right'}, time: 1000 });";
			} ?>
		</script>
</body>

</html>
