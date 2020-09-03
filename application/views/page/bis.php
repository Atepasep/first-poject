<div class="container-fluid">
	<div class="content">
		<div id="header-app">
			Absensi Bis<small> Jemputan Karyawan IFN</small>
		</div>
		<hr class="pendek">
		<div class="form-inline" style="margin-bottom: 5px;">
			Periode :
			<input type="text" name="tanggal" id="tanggal" class="form-control form-control huruf-kecil flat ml-sm-1 tek-pendek-xs" value="<?= $this->session->userdata('tgl') ?>" >
			<select id="bulan" name="bulan" class="form-control form-control-sm huruf-kecil flat ml-sm-1">
				<?php for($x=1;$x<=12;$x++){  ?>
					<option value="<?= $x ?>" <?php if($this->session->userdata('bln')==$x){echo "selected"; } ?>><?= namabulan($x) ?></option>
				<?php } ?>
			</select>
			<select id="tahun" name="tahun" class="form-control form-control-sm huruf-kecil flat ml-sm-1">
				<?php for($x=date('Y')-2;$x<=date('Y');$x++){  ?>
					<option value="<?= $x ?>" <?php if($this->session->userdata('thn')==$x){ echo "selected";} ?>><?= $x ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<a href="" data-toggle="modal" data-title="Edit Absen" data-remote="false" data-target="#modalBox" class="text-red hidden" id="cekabsen">XX</a>
				<div id="tabelkupon">
					<table class="table table-condensed table-bordered tabelku">
						<thead class="huruf-tengah">
							<th>No</th>
							<th>Nama Jemputan</th>
							<th>Trayek</th>
							<th>Non</th>
							<th>Pagi</th>
							<th>Siang</th>
							<th>Malam</th>
						</thead>
						<tbody id="data-tabelku">
							<?php $no=0; $tgl = $this->session->userdata('tgl'); foreach($data as $dete){ $no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $dete['nama'] ?></td>
									<td><?= $dete['trayek'] ?></td>
									<?php 
										$lambang = '';
										$kode = '0';
										for($i=($tgl*4)-4;$i<=(($tgl*4)-4)+3;$i++){
											switch (substr($dete['absen'],$i,1)) {
												case '2':
													$lambang = 'fa-angle-double-left';
													$kode = '2';
													break;
												case '3':
													$lambang = 'fa-angle-double-right';
													$kode = '3';
													break;
												case '1':
													$lambang = 'fa-circle';
													$kode = '1';
													break;
												case '4':
													$lambang = 'fa-times';
													$kode = '4';
													break;
												default:
													$lambang = '';
													$kode = '0';
													break;
											}
									?>
										<td style="text-align: center; width: 60px;" class="detabsen text-red" rel="<?= base_url().'bis/ubahjam/'.$dete['id'].'/'.$i.'/'.$kode ?>"><i class="fa <?= $lambang ?>"></i></td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>