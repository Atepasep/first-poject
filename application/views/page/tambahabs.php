<div class="container huruf-kecil">
	<input type="hidden" name="urlubahgrup" id="urlubahgrup" value="<?= base_url().'absen/ubahgrup' ?>">
	<form method="post" action="<?= $formAction ?>" name="formtambahabs" id="formtambahabs" autocomplete="off">
		<div class="form-inline">
			<label class="justify-content-start">Tanggal</label>
			<input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm flat" value="<?= $tgl ?>" readonly autocomplete="off">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Departemen</label>
			<input type="text" name="dept" id="dept" class="form-control form-control-sm flat" value="<?= namadepartemen($dep); ?>" readonly>
			<input type="text" id="id_dept" name="id_dept" value="<?= $dep ?>" class="hidden">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Shift Kerja</label>
			<input type="text" name="shift" id="shift" class="form-control form-control-sm flat" value="<?= namashift($shi); ?>" readonly>
			<input type="text" id="shif" name="shif" value="<?= $shi ?>" class="hidden">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Group</label>
			<select class="form-control form-control-sm flat" id="grup" name="grup">
				<option>--Pilih Grup--</option>
				<?php foreach($listgrup->result_array() as $grup){ ?>
					<option value="<?= $grup['grup'] ?>" ><?= $grup['grup'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-inline">
			<div class="form-inline">
				<label class="justify-content-start">Jumlah Kry</label>
				<input type="text" name="jumlahkry" id="jumlahkry" class="form-control form-control-sm tek-pendek flat" value="0" autocomplete="off">
			</div>
		</div>
	</form>
	<hr class="small">
	<div class="tombol" style="text-align: right;">
		<a href="#" class="btn btn-sm btn-success huruf-kecil flat" id="simpanabs"><i class="fa fa-save"></i> Simpan</a>
		<a href="#" class="btn btn-sm btn-danger huruf-kecil flat" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</a>
	</div> 
</div>
<script type="text/javascript">
	$("#simpanabs").click(function(){
		document.formtambahabs.submit();
	})
</script>