<div class="container huruf-kecil">
	<form method="post" action="<?= $formAction ?>" name="formkupon" id="formkupon" autocomplete="off">
		<div class="form-inline">
			<label class="justify-content-start">Tanggal</label>
			<input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm flat" value="<?= $tgl ?>" readonly autocomplete="off">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Shift Kerja</label>
			<input type="text" name="shift" id="shift" class="form-control form-control-sm flat" value="<?= namashift($shi); ?>" readonly>
			<input type="text" id="shift2" name="shift2" value="<?= $shi ?>" class="hidden">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Departemen</label>
			<select name="departemen" id="departemen" class="form-control form-control-sm flat" readonly>
				<option value="">-- Pilih departemen --</option>
				<?php foreach ($dep as $datadep) { ?>
					<option value="<?= $datadep['dept_id'] ?>" <?php if($datadep['dept_id']==$xdep){echo "selected";} ?>><?= $datadep['departemen'] ?></option>
				<?php } ?>
				<option value="OT">Lain - Lain</option>
			</select>
		</div>
		<div class="form-inline">
			<div class="form-inline">
				<label class="justify-content-start">Jumlah Kry</label>
				<input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm tek-pendek flat" value="<?= $jumlah ?>" autocomplete="off">
			</div>
			<div class="form-inline ml-sm-4">
				<label class="justify-content-start">Jumlah Abs</label>
				<input type="text" name="absen" id="absen" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($absen) ?>" autocomplete="off">
			</div>
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Hadir</label>
			<div id="cont-modul">
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Indoneptune</label>
					<input type="text" name="hadir" id="hadir" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($hadir) ?>" autocomplete="off">
				</div>
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Arroza</label>
					<input type="text" name="hadirar" id="hadirar" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($hadirar) ?>" autocomplete="off">
				</div>
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Nurinda</label>
					<input type="text" name="hadirnu" id="hadirnu" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($hadirnu) ?>" autocomplete="off">
				</div>
			</div>
			<label class="justify-content-start ml-sm-4">Lembur</label>
			<div id="cont-modul">
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Indoneptune</label>
					<input type="text" name="lembur" id="lembur" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($lembur) ?>" autocomplete="off">
				</div>
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Arroza</label>
					<input type="text" name="lemburar" id="lemburar" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($lemburar) ?>"autocomplete="off">
				</div>
				<div class="form-inline ml-sm-1">
					<label class="justify-content-start">Nurinda</label>
					<input type="text" name="lemburnu" id="lemburnu" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($lemburnu) ?>" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Kembali</label>
			<input type="text" name="kmb" id="kmb" class="form-control form-control-sm tek-pendek flat" value="<?= isnol($kmb) ?>" autocomplete="off">
		</div>
		<div class="form-inline">
			<label class="justify-content-start">Keterangan</label>
			<textarea class="form-control form-control-sm flat" id="ket" name="ket" autocomplete="off" ><?= $ket ?></textarea>
		</div>
	</form>
	<hr class="small">
	<div class="tombol" style="text-align: right;">
		<a href="#" class="btn btn-sm btn-success huruf-kecil flat" id="simpankupon"><i class="fa fa-save"></i> <?php if($kmb==null){ echo "Simpan";}else{echo "Update";} ?></a>
		<a href="#" class="btn btn-sm btn-danger huruf-kecil flat" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</a>
	</div> 
</div>
<script type="text/javascript">
	$("#departemen").change(function(){
		$("#jumlah").focus();
	})
	$("#simpankupon").click(function(){
		if($("#departemen").val()=='OT' && $("#ket").val()==''){
			pesan('info','isi keterangan dahulu, karena departemen lain - lain');
		}else{
			if($("#shift").val()=='ERROR'){
				pesan('danger','Shift Kerja tidak diperbolehkan, pilih dahulu shift');
			}else{
				if(validasi()){
					document.formkupon.submit();
				}else{
					pesan('info','isi data dengan lengkap');
				}
			}
		}
	})
	$("#hadir").change(function(){
		hitkup();
	})
	$("#hadirar").change(function(){
		hitkup();
	})
	$("#hadirnu").change(function(){
		hitkup();
	})
	function validasi(){
		var ok = true;
		if($("#shift2").val()==''){
			ok = false;
		}
		if($("#departemen").val()==''){
			ok = false;
		}
		if($("#jumlah").val()=='' || $("#jumlah").val()==0){
			ok = false;
		}
		if($("#hadir").val()=='' && $("#hadirar").val()=='' && $("#hadirnu").val()==''){
			ok = false;
		}
		if($("#hadir").val()==0 && $("#hadirar").val()==0 && $("#hadirnu").val()==0){
			ok = false;
		}
		// if($("#hadirar").val()==''){
		// 	ok = false;
		// }
		// if($("#hadirnu").val()==''){
		// 	ok = false;
		// }
		return ok;
	}
	function hitkup(){
		if($("#jumlah").val()==''){
			var x = 0;
		}else{
			var x = $("#jumlah").val();
		}
		if($("#absen").val()==''){
			var y = 0;
		}else{
			var y = $("#absen").val();
		}
		if($("#hadir").val()==''){
			var z = 0;
		}else{
			var z = $("#hadir").val();
		}
		if($("#hadirar").val()==''){
			var a = 0;
		}else{
			var a = $("#hadirar").val();
		}
		if($("#hadirnu").val()==''){
			var b = 0;
		}else{
			var b = $("#hadirnu").val();
		}
		var jum = parseFloat(x)-parseFloat(y);
		var xjum= parseFloat(z)+parseFloat(a)+parseFloat(b);
		if(jum < xjum){
			pesan('info','Kupon harus sama dengan jumlah karyawan dikurangi absen');
			$("#hadir").val('');
			$("#hadirar").val('');
			$("#hadirnu").val('');
		}
	}
</script>