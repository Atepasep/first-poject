<!DOCTYPE html>
<html lang="en">
<head>
	<title>Selamat datang IFN-SYSTEM V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/plugins/bootstrap/css/bootstrap.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/plugins/font-awesome/css/font-awesome.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/animate.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/util.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/login.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/myStyle.css' ?>">
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more"></div>
			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<div class="huruf-kecil">
   					<p><?php echo $this->session->flashdata('msg');?></p>
  				</div>
				<form class="login100-form validate-form" autocomplete="off" action="<?= $formAction; ?>" method="post">
					<span class="login100-form-title p-b-59">
						Login Here
					</span>

					<div class="wrap-input100 validate-input" data-validate="Name is required" required>
						<span class="label-input100">Username</span>
						<input class="form-control flat" type="text" name="name" placeholder="Nama User">
						<!-- <span class="focus-input100"></span> -->
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
						<span class="label-input100">Password</span>
						<input class="form-control flat" type="Password" name="pass" placeholder="*************">
						<!-- <span class="focus-input100"></span> -->
					</div>
					<div class="btn-wrapinput-100">
						<button class="btn btn-sm btn-danger flat">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url().'assets/plugins/jquery/jquery-3.3.1.js' ?>"></script>
	<script src="<?= base_url().'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>	
</body>
</html>