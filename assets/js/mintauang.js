$(document).ready(function(){
	$("#kembali").datepicker({
		dateFormat : "dd-mm-yy",
		autoClose : true
	});
	$("#data-tabelku tr.aktif").click();
	$("#jumlah_uang").keypress(validateNumber);
})
$("#data-tabelku tr").click(function(){
	var s = $(this).attr('rel');
	$("#hapusmintauang").attr('data-href','mintauang/hapus/'+s);
	$("#data-tabelku tr").removeClass('aktif');
	$(this).addClass('aktif');
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : "mintauang/getdetaildata",
		data : {id:s},
		success : function(data){
			$("#tgl").val(tglmysql(data[0].tgl));
			$("#pemohon").val(data[0].pemohon);
			$("#dinas_luar").val(data[0].dinas_luar);
			$("#belanja").val(data[0].belanja);
			$("#uang_saku").val(data[0].uang_saku);
			$("#donasi").val(data[0].donasi);
			$("#lain").val(data[0].lain);
			$("#jumlah_uang").val(rupiah(data[0].jumlah_uang,'.',',',0));
		}
	})
})
$("#addmintauang").click(function(){
	document.formmintauang.setAttribute('action',$("#simpanmu").val());
	$(this).addClass('hidden');
	$("#editmintauang").addClass('hidden');
	$("#hapusmintauang").addClass('hidden');
	$("#cetakmintauang").addClass('hidden');
	$("#simpanmintauang").removeClass('hidden');
	$("#batalmintauang").removeClass('hidden');
	kosongkan();
	$("#tgl").val($("#waktu").val());
})
$("#simpanmintauang").click(function(){
	if (validasi()) {
		document.formmintauang.submit();
	}else{
		alert('Data harus diisi lengkap');
	}
})
$("#editmintauang").click(function(){
	document.formmintauang.setAttribute('action',$("#ubahmu").val());
	$("#addmintauang").addClass('hidden');
	$("#editmintauang").addClass('hidden');
	$("#hapusmintauang").addClass('hidden');
	$("#cetakmintauang").addClass('hidden');
	$("#updatemintauang").removeClass('hidden');
	$("#batalmintauang").removeClass('hidden');
})
$("#batalmintauang").click(function(){
	$(this).addClass('hidden');
	$("#editmintauang").removeClass('hidden');
	$("#hapusmintauang").removeClass('hidden');
	$("#cetakmintauang").removeClass('hidden');
	$("#simpanmintauang").addClass('hidden');
	$("#addmintauang").removeClass('hidden');	
	$("#bagianpil").addClass('hidden');
	$("#updatemintauang").addClass('hidden');
	$("#bagian").removeClass('hidden');
	$("#data-tabelku tr.aktif").click();
})
$("#bulan").change(function(){
	ubahbulantahun($(this).val(),$("#tahun").val());
})
$("#tahun").change(function(){
	ubahbulantahun($("#bulan").val(),$(this).val());	
})
function kosongkan(){
	$("#pemohon").val('');
	$("#dinas_luar").val('');
	$("#belanja").val('');
	$("#uang_saku").val('');
	$("#donasi").val('');
	$("#lain").val('');
	$("#jumlah_uang").val('0');
	$("#kembali").val('');
}
function validasi(){
	var hasil = true;
	if($("#pemohon").val()==''){
		hasil = false;
	}
	if(($("#dinas_luar").val()=='') && ($("#belanja").val()=='') && $("#uang_saku").val()=='' && $("#donasi").val()=='' && $("#lain").val()==''){
		hasil = false;
	}
	if($("#jumlah_uang").val()=='' || $("#jumlah_uang").val()=='0'){
		hasil = false;
	}
	return hasil;
}
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
};
function ubahbulantahun(a,b){
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : "mintauang/ubahbulantahun",
		data :  {bl:a,th:b},
		success : function(data){
			location.reload();
		}
	})
}