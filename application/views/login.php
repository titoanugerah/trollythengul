<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $webconf->office_name.' | '.'Login'; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo base_url('./assets/template/login/'); ?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/template/login/'); ?>css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url('./assets/template/login/'); ?>images/bg-01.jpg');">
			<div class="wrap-login100 p-l-60 p-r-60 p-t-32 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-3">
						Masuk
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username harus diisi">
						<input class="input100" type="text" name="username" placeholder="masukan username">
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<a href="<?php echo base_url('forgotPassword'); ?>" class="txt2 bo1 m-l-5">
							Lupa?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password belum diisi">
						<input class="input100" type="password" name="password" placeholder="masukan password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn btn-success" type="submit" name="loginValidation" value="loginValidation">
							Masuk
						</button>
            &nbsp;&nbsp;&nbsp;
            <a class="login100-form-btn" href="<?php echo base_url(); ?>">
							Kembali
						</a>
					</div>
						<p style="text-align:center;" class="txt2"><?php echo $this->session->userdata['notify'] ?></p>
					<div class="w-full text-center p-t-35">
						<span class="txt2">
							Belum punya akun?
						</span>

						<a href="<?php echo base_url('register'); ?>" class="txt2 bo1">
							daftar disini
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('./assets/template/login/'); ?>js/main.js"></script>

</body>
</html>
