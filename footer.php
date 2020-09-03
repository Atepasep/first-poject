		<script src="<?= base_url().'assets/plugins/jquery/jquery-3.3.1.js' ?>"></script>
		<script src="<?= base_url().'assets/plugins/bootstrap/js/bootstrap.min.js' ?>"></script>			
		<script src="<?= base_url().'assets/js/easing.min.js' ?>"></script>			
		<script src="<?= base_url().'assets/js/hoverIntent.js' ?>"></script>
		<script src="<?= base_url().'assets/js/superfish.min.js' ?>"></script>	
		<script src="<?= base_url().'assets/js/jquery.ajaxchimp.min.js' ?>"></script>
		<script src="<?= base_url().'assets/js/jquery.magnific-popup.min.js' ?>"></script>	
		<script src="<?= base_url().'assets/js/jquery-ui.js' ?>"></script>			
		<script src="<?= base_url().'assets/js/owl.carousel.min.js' ?>"></script>						
		<script src="<?= base_url().'assets/js/jquery.nice-select.min.js' ?>"></script>		
		<script src="<?= base_url().'assets/plugins/toast/jquery.toast.min.js' ?>"></script>						
		<script src="<?= base_url().'assets/js/main.js' ?>"></script>	
		<script src="<?= base_url().'assets/js/myscript.js' ?>"></script>	
		<?php if($this->session->flashdata('msg')=='akseserror'){ ?>
			<script type="text/javascript">
				pesan('warning','Ada masalah akses program, hubungi administrator data');
			</script>
		<?php } ?>
		<?php if($this->session->flashdata('info')=="datasudahada"){ ?>
			<script type="text/javascript">
				pesan('Warning','Data yang anda masukan sudah ada, cek kembali data');
			</script>
		<?php } ?>
		<?php if(isset($foot) && $foot=='menuatas'){ ?>
			<script type="text/javascript">
				$('#header').addClass('header-scrolled');
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				//------- Header Scroll Class  js --------//  
			    $(window).scroll(function() {
			        if ($(this).scrollTop() > 100) {
			            $('#header').addClass('header-scrolled');
			        } else {
			            $('#header').removeClass('header-scrolled');
			        }
			    });
			</script>
		<?php } ?>
		<?php if(isset($foot2) && $foot2=='pengguna'){ ?>
			<script src="<?= base_url().'assets/js/pengguna.js' ?>"></script>	
		<?php } ?>
		<?php if(isset($foot2) && $foot2=='departemen'){ ?>
			<script src="<?= base_url().'assets/js/departemen.js' ?>"></script>	
		<?php } ?>
		<?php if(isset($foot2) && $foot2=='aplikasi'){ ?>
			<script src="<?= base_url().'assets/js/aplikasi.js' ?>"></script>	
		<?php } ?>
		<?php if(isset($foot2) && $foot2=='kuponmakan'){ ?>
			<script src="<?= base_url().'assets/js/kuponmakan.js' ?>"></script>	
		<?php } ?>
		<?php if(isset($foot2) && $foot2=='bis'){ ?>
			<script src="<?= base_url().'assets/js/bis.js' ?>"></script>	
		<?php } ?>
	</body>
</html>