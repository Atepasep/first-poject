<!DOCTYPE html>
<html>
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url().'assets/images/favicon.png' ?>">
	<!-- Author Meta -->
	<meta name="author" content="IT-Indoneptune">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>PT.Indoneptune Net Manufacturing</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="<?= base_url().'assets/css/linearicons.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/plugins/font-awesome/css/font-awesome.min.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/plugins/bootstrap/css/bootstrap.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/plugins/bootstrap/css/bootstrap-datepicker.min.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/css/magnific-popup.css'?>">
		<link rel="stylesheet" href="<?= base_url().'assets/css/nice-select.css'?>">							
		<link rel="stylesheet" href="<?= base_url().'assets/css/animate.min.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/css/jquery-ui.css' ?>">			
		<link rel="stylesheet" href="<?= base_url().'assets/css/owl.carousel.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/plugins/toast/jquery.toast.min.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/css/main.css' ?>">
		<link rel="stylesheet" href="<?= base_url().'assets/css/mystyle.css' ?>">
	</head>
	<body>	
<div class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog modal-lg flat'>
	    <div class='modal-content'>
	      <div class='modal-header bg-grey'>
	        <!--<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>-->
	        <h4 class='modal-title' id='myModalLabel'> Pengaturan Pengguna</h4>
	      </div>
	      <div class="fetched-data"></div>
	  </div>
	</div>
</div>
<div class='modal fade btn-flat' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header btn-info'>
        <!-- <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button> -->
        <h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
        </div>
        <div class='modal-body'>
            Apakah Anda yakin ingin menghapus data ini?
        </div>
        <div class='modal-footer'>
          <a class='btn-ok'>
            <button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
          </a>
          <button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
        </div>
    </div>
  </div>
</div>
<div class='modal fade' id='confirm-task' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header btn-info'>
        <!-- <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button> -->
        <h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
        </div>
        <div class='modal-body'>
          <div id="test">
              Apakah Anda yakin ingin menghapus data ini?
            </div>
        </div>
        <div class='modal-footer'>
          <a class='btn-oke'>
            <button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-check'></i> Ya</button>
          </a>
        <button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-times'></i> Tidak</button>
        </div>
    </div>
  </div>
</div>
		  <header id="header" id="home">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row align-items-center">
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-left no-padding">
				      	<div class="menu-social-icons">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</div>	    				  					
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-right no-padding">
							<a class="btns" href="tel:+953 012 3654 896"></a>
			  				<a class="btns" href="mailto:support@colorlib.com"></a>		
			  				<a class="icons" href="tel:+953 012 3654 896">
			  					<span class="lnr lnr-phone-handset"></span>
			  				</a>
			  				<a class="icons" href="mailto:support@colorlib.com">
			  					<span class="lnr lnr-envelope"></span>
			  				</a>		
			  			</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
		    		<a href=""><img src="<?= base_url().'assets/images/logo.png' ?>" alt="" title="" /></a>		
					<nav id="nav-menu-container">
						<ul class="nav-menu">
						  <li class="menu-active"><a href="<?= base_url() ?>">Beranda</a></li>
						  <li><a href="about.html">Tentang</a></li>
						  <li class="menu-has-children"><a href="#">Menu</a>
						  	<ul>
						  		<li><a href="<?= base_url().'pengguna/penggunaclear' ?>">USER</a></li>
						  		<li><a href="<?= base_url().'departemen/departemenclear' ?>">DEPARTEMEN</a></li>
						  	</ul>
						  </li>
						  <li><a href="team.html">Tim IT</a></li>
						  <!-- <li class="menu-has-children"><a href="">Application</a>
						    <ul>
						      <li><a href="blog-home.html">Blog Home</a></li>
						      <li><a href="blog-single.html">Blog Single</a></li>
						      <li class="menu-has-children"><a href="">Level 2</a>
						        <ul>
						          <li><a href="#">Item One</a></li>
						          <li><a href="#">Item Two</a></li>
						        </ul>
						      </li>					              
						    </ul>
						  </li> -->
						  <li><a href="<?= base_url().'aplikasi' ?>">Aplikasi</a></li>					  			          	          
						  <li><a href="<?= base_url().'login/keluarprogram'; ?>">Logout</a></li>
						</ul>
					</nav><!-- #nav-menu-container -->		
		    	</div>
		    </div>
		  </header><!-- #header -->