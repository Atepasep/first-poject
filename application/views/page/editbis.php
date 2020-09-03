<div class="container">
	<input type="hidden" name="kode" id="kode" value="<?= $a.'-'.$b.'-'.$c ?> " >
	<?php 
		$kode = $a.'-'.$b.'-'.$c;
		$pecah = explode('-', $kode);
	?>
	<form method="POST" action="<?= $formAction; ?>" name="formabsenbis" id="formabsenbis">
		<input type="hidden" name="idjemputan" id="idjemputan" value="<?= $pecah[0] ?>">
		<input type="hidden" name="norekod" id="norekod" value="<?= $pecah[1] ?>">
		<div class="form-group huruf-kecil">
	      <div class="radio">
	        <label>
	          <input type="radio" name="optionabsen" id="1" value="1" <?php if($pecah[2]=='1'){echo "checked"; } ?>>
	          	<i class="fa fa-circle text-red"></i> Masuk
	        </label>
	      </div>
	      <div class="radio">
	        <label>
	          <input type="radio" name="optionabsen" id="2" value="2" <?php if($pecah[2]=='2'){echo "checked"; } ?>>
	          	<i class="fa fa-angle-double-left text-red"></i> Tidak Masuk (Datang) 
	        </label>
	      </div>
	      <div class="radio">
	        <label>
	          <input type="radio" name="optionabsen" id="3" value="3" <?php if($pecah[2]=='3'){echo "checked"; } ?>>
	          	<i class="fa fa-angle-double-right text-red"></i> Tidak Masuk (Pulang) 
	        </label>
	      </div>
	      <div class="radio">
	        <label>
	          <input type="radio" name="optionabsen" id="4" value="4" <?php if($pecah[2]=='4'){echo "checked"; } ?>>
	          	<i class="fa fa-times text-red"></i> Tidak Masuk 
	        </label>
	      </div>
	      <div class="radio">
	        <label>
	          <input type="radio" name="optionabsen" id="5" value="0" >
	          	Kosongkan
	        </label>
	      </div>
	    </div>
    </form>
    <hr class="pendek">
    <div class="tombol" style="text-align: right;">
    	<a href="#" class="btn btn-sm btn-info huruf-kecil flat" id="simpannabsenbis"><i class="fa fa-save"></i> Simpan</a>
    	<a href="#" class="btn btn-sm btn-danger huruf-kecil flat" id="batalabsen" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</a>
    </div>
</div>
<script type="text/javascript">
	$("#simpannabsenbis").click(function(){
		document.formabsenbis.submit();
	})
</script>