<div class="container-fluid">
	<div class="content">
		<div class="header-aplikasi">
			<div class="gambar-header-aplikasi">
				<img src="<?= base_url().'assets/images/reception.png' ?>">
			</div>
			<div>
				<h4 class="mb-sm-3">Selamat Datang</h4>
				<p>Anda masuk ke dalam menu daftar aplikasi yang dapat diakses <?= namadepartemen($this->session->userdata('bagian')) ?></p>
				<p>Selamat bekerja</p>
			</div>
		</div>
		<div class="row mt-sm-2">
			<?php foreach ($apli as $dataapli) { ?>
				<div class="col-sm-1">
					<div class="detailapps">
						<a href="<?= base_url().$dataapli['url'] ?>" rel="<?= $dataapli['nama_apps'] ?>" id="namaapps">
							<img src="<?= base_url().'assets/images/'.$dataapli['img'] ?>">
							<p><?= $dataapli['nama_apps'] ?></p>
						</a>
					</div>
				</div>	
			<?php } ?>
		</div>
	</div>
</div>