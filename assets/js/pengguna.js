$(document).ready(function(){
	$("#data-tabelku tr.aktif").click();
})
$("#addpengguna").click(function(){
	document.formpengguna.setAttribute('action',$("#simpanpg").val());
	$(this).addClass('hidden');
	$("#bagianpil").val('');
	$("#editpengguna").addClass('hidden');
	$("#hapuspengguna").addClass('hidden');
	$("#cetakpengguna").addClass('hidden');
	$("#simpanpengguna").removeClass('hidden');
	$("#batalpengguna").removeClass('hidden');
	$("#bagian").addClass('hidden');
	$("#bagianpil").removeClass('hidden');
	$("#bagianpil").change();
	kosongkan();
})
$("#editpengguna").click(function(){
	document.formpengguna.setAttribute('action',$("#ubahpg").val());
	$("#addpengguna").addClass('hidden');
	$("#editpengguna").addClass('hidden');
	$("#hapuspengguna").addClass('hidden');
	$("#cetakpengguna").addClass('hidden');
	$("#updatepengguna").removeClass('hidden');
	$("#batalpengguna").removeClass('hidden');
	$("#bagian").addClass('hidden');
	$("#bagianpil").removeClass('hidden');
})
$("#batalpengguna").click(function(){
	$(this).addClass('hidden');
	$("#editpengguna").removeClass('hidden');
	$("#hapuspengguna").removeClass('hidden');
	$("#cetakpengguna").removeClass('hidden');
	$("#simpanpengguna").addClass('hidden');
	$("#addpengguna").removeClass('hidden');	
	$("#bagianpil").addClass('hidden');
	$("#updatepengguna").addClass('hidden');
	$("#bagian").removeClass('hidden');
	$("#data-tabelku tr.aktif").click();
})
$("#simpanpengguna").click(function(){
	if(validasi()){
		document.formpengguna.submit();
	}else{
		alert('Isi data dengan lengkap');
	}
})
$("#updatepengguna").click(function(){
	if(validasi()){
		document.formpengguna.submit();
	}else{
		alert('Isi data dengan lengkap');
	}
})
$("#bagianpil").change(function(){
	var kode = $(this).val();
	isimodul(kode);
})
$("#cetakpengguna").click(function(){
	pesan('info','Under construction, please call database administrator');
})
$("#data-tabelku tr").click(function(){
	var aidi = $(this).attr('rel');
	$("#data-tabelku tr").removeClass('aktif');
	$("#hapuspengguna").attr('data-href','Pengguna/hapuspengguna/'+aidi);
	$(this).addClass('aktif');
	$.ajax({
		dataType : "json",
		type : "POST",
		url : "Pengguna/getdetail",
		data : {id:aidi},
		success : function(data){
			if(data.length > 0){
				$("#id").val(data[0].id);
				$("#nama").val(data[0].nama);
				$("#bagian").val(data[0].departemen);
				$("#jabatan").val(data[0].jabatan);
				$("#username").val(data[0].username);
				$("#bagianpil").val(data[0].bagian);
				if(data[0].aktif==1){
					$("#aktif").attr('checked',true);
				}else{
					$("#aktif").attr('checked',false);
				}
				var bag = data[0].bagian;
				var idx = data[0].modul1;
				isimodul(bag,data[0].modul2);
				cekpass(aidi);
				for(ex=1;ex<=30;ex++){
					var kos_ = idx.substr(ex-1,1);
					if(kos_=='1'){
						$("#menu"+ex).attr('checked',true);
					}else{
						$("#menu"+ex).attr('checked',false);
					}
				}
			}else{
				alert('Error, periksa data');
			}
		}
	})
})
function kosongkan(){
	$("#nama").val('');
	$("#bagian").val('');
	$("#jabatan").val('');
	$("#aktif").removeAttr('checked');
	$("#username").val('');
	$("#password").val('');
}
function cekpass(i){
	var aidi = i;
	$.ajax({
		dataType:"json",
		type : "POST",
		url : "Pengguna/getpass",
		data:{id:aidi},
		success : function(data){
			$("#password").val(data);
		}
	})
}
function isimodul(xe,xd){
	var html = '';
	var idi = xe;
	var idd = xd;
	$.ajax({
		dataType : "json",
		type : "POST",
		url : "Pengguna/getmodul",
		data : {id:idi},
		success : function(data){
			if(data.length > 0){
				for(x=1;x<=data.length;x++){
					html += "<div class='form-inline'>"+
							"<input type='checkbox' class='form-control form-control-sm tek-panjang mr-sm-1 ml-sm-3 flat' id='modul"+data[x-1].namamodul+"' name='modul"+data[x-1].namamodul+"' autocomplete='off' value='1'>"+
							"<label class='justify-content-start' style='width:150px !important'>"+data[x-1].nama_apps+"</label>"+
							"</div>";
				}
				$("#cont-modul").html(html);
				for(ek=1;ek<=30;ek++){
					var kos_ = idd.substr(ek-1,1);
					if(kos_=='1'){
						$("#modul"+ek).attr('checked',true);
					}else{
						$("#modul"+ek).attr('checked',false);
					}
				}
			}else{
				html += "Modul belum di Set";
				$("#cont-modul").html(html);
			}
		}
	})
}
function validasi(){
	var ok = true;
	if($("#nama").val()==''){
		ok = false;
	}
	if($("#bagianpil").val()==''){
		ok = false;
	}
	if($("#jabatan").val()==''){
		ok = false;
	}
	return ok;
}