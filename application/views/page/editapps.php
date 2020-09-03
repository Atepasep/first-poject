<div class='container' style="padding-top: 15px;">
	<form name="formmodul" action="<?= $formAction; ?>" method="post" >
	<input type="text" class="hidden" id="id" name="id" value="<?= $idForm ?>">
	<input type="text" class="hidden" id="id_dept" name="id_dept" value="<?= $idDept ?>">
	<div class="form-inline <?php if($idForm!=null){echo "hidden"; } ?>">
		<label class="justify-content-start" style="width: 200px !important;">Departemen</label>
		<input type="text" class="form-control form-control-sm tek-panjang ml-sm-2 flat" id="namadep" name="namadep" value="<?= $idDept ?>" autocomplete="off">
	</div>
	<div class="form-inline">
		<label class="justify-content-start" style="width: 200px !important;">Nama Modul / Aplikasi</label>
		<!--<input type="text" class="form-control form-control-sm tek-panjang ml-sm-2 flat" id="namamodul" name="namamodul" value="<?= $namamodul ?>" autocomplete="off">-->
		<select class=" form-control form-control-sm ml-sm-2 flat" id="namamodul" name="namamodul">
			<?php foreach($daftarapps as $apps){ ?>
				<option value="<?= $apps['id'] ?>"><?= $apps['nama_apps'] ?></option>
			<?php } ?>
		</select>
	</div>
	</form>
	<hr class="small">
	<div class="tombolmodal" style="padding: 20px; text-align: right;">
		<a href="#" class="btn btn-sm btn-success huruf-kecil flat" id="ubahdatamodul"><i class="fa fa-save"></i> <?= $isitombol ?></a>
		<a href="#" class="btn btn-sm btn-danger huruf-kecil flat" data-dismiss="modal" id="tutupmodul"><i class="fa fa-arrow-left"></i> Batal</a>
	</div>
</div>
<script type="text/javascript">
	$("#ubahdatamodul").click(function(){
		document.formmodul.submit();
	})
</script>