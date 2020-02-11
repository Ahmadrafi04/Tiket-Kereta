<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tikret-Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets'); ?>/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/login/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/main.css">
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="<?php echo base_url('user/login'); ?>">
					<h2 align="center"><strong>Tik</strong><small style="font-size: 113%;">ret</small></h2>
					<span class="login100-form-title p-b-43" style="font-size: 100%;">
						Login untuk melanjutkan
					</span>
				<?= $this->session->flashdata('message'); ?>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Ingat saya
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Lupa password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<a href="<?php echo base_url('user/regist'); ?>" class="txt2">
							atau Daftar akun
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('<?php echo base_url('assets'); ?>/images/thmas.png');">
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets'); ?>/login/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/animsition/js/animsition.min.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/select2/select2.min.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url('assets'); ?>/login/countdowntime/countdowntime.js"></script>
	<script src="<?php echo base_url('assets'); ?>/js/main.js"></script>

</body>
</html>