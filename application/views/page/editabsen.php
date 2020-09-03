<div class="container">
	<form method="POST" action="<?= $formAction; ?>" name="formabsenbis" id="formabsenbis">
		<input type="hidden" name="id" id="id" value="<?= $id ?>">
		<div class="form-group huruf-kecil">
		<div class="row">
				<div class="col-sm-6">
		      <div class="radio">
		        <label> 
		          <input type="radio" name="optionabsen" id="1" value="A" <?php if($isi=='A'){ echo 'checked'; }?> >
		          	<span class="text-red">A</span> Alpa
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="2" value="I" <?php if($isi=='I'){ echo 'checked'; }?> >
		          	<span class="text-red">I</span> Izin
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="3" value="S" <?php if($isi=='S'){ echo 'checked'; }?> >
		          	<span class="text-red">S</span> Sakit
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="4" value="SD" <?php if($isi=='SD'){ echo 'checked'; }?> >
		          	<span class="text-red">SD</span> Surat Dokter
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="5" value="OP" <?php if($isi=='OP'){ echo 'checked'; }?> >
		          	<span class="text-red">OP</span> Opname
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="6" value="IK" <?php if($isi=='IK'){ echo 'checked'; }?> >
		          	<span class="text-red">IK</span> Izin Khusus
		        </label>
		      </div>
		      </div>
		      <div class="col-sm-6">
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="7" value="C" <?php if($isi=='C'){ echo 'checked'; }?> >
		          	<span class="text-red">C</span> Cuti Tahunan
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="8" value="CM" <?php if($isi=='CM'){ echo 'checked'; }?> >
		          	<span class="text-red">CM</span> Cuti Melahirkan
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="9" value="CH" <?php if($isi=='CH'){ echo 'checked'; }?> >
		          	<span class="text-red">CH</span> Cuti Haid
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="10" value="DS" <?php if($isi=='DS'){ echo 'checked'; }?> >
		          	<span class="text-red">DS</span> Dispensasi
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="11" value="SK" <?php if($isi=='SK'){ echo 'checked'; }?> >
		          	<span class="text-red">SK</span> Skorsing
		        </label>
		      </div>
		      <div class="radio">
		        <label>
		          <input type="radio" name="optionabsen" id="12" value="CP" <?php if($isi=='CP'){ echo 'checked'; }?> >
		          	<span class="text-red">CP</span> Cuti Panjang
		        </label>
		      </div>
		  </div>
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