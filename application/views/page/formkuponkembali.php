<div class="container huruf-kecil">
	<form method="post" action="<?= $formAction ?>" name="formkuponkembali" id="formkuponkembali" autocomplete="off">
		<input type="hidden" name="id" id="id" value="<?= $kupon->id ?>">
		<div class="form-inline">
			<label class="justify-content-start">Kembali</label>
			<input type="text" name="kmb" id="kmb" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($kupon->kmb) ?>" autocomplete="off">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Keterangan</label>
			<textarea class="form-control form-control-sm flat" id="ket" name="ket" autocomplete="off" ><?= $kupon->ket ?></textarea>
		</div>
	</form>
	<hr class="small">
	<div class="tombol" style="text-align: right;">
		<a href="#" class="btn btn-sm btn-success huruf-kecil flat" id="simpankuponkembali"><i class="fa fa-save"></i> Kembalikan Kupon</a>
		<a href="#" class="btn btn-sm btn-danger huruf-kecil flat" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</a>
	</div> 
</div>
<script type="text/javascript">
	$("#simpankuponkembali").click(function(){
		document.formkuponkembali.submit();
	})
</script>