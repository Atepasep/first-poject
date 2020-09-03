$(document).ready(function(){
	//isitgl();
})
$("#shiperi").change(function(){
	rubahperiod();
})
$("#tglperiod").change(function(){
	rubahperiod();
})
$("#bulperiod").change(function(){
	rubahperiod();
})
$("#thperiod").change(function(){
	rubahperiod();
})
$("#updateperiod").click(function(){
	rubahperiod();
})
$("#dept").change(function(){
	rubahperiod();
})
$("#cetakkupon").on('click',function(){
	pesan('info','Under construction, please Call website administrator');
})
$("#tambahkupon").click(function(){
	var a = $("#dept").val();
	var b = $("#shiperi").val();
	if (a=='' || b==''){
		alert('Pilih departemen dan Shift Kerja');
	}else{
		$("#tambahkuponmakan").click();
	}
})
function rubahperiod(){
	var des = $("#shiperi").val();
	var dy = $("#tglperiod").val();
	var bl = $("#bulperiod").val();
	var th = $("#thperiod").val();
	var dep = $("#dept").val();
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : "Kuponmakan/ubahshi",
		data : {ede:des, day:dy, bln:bl, thn:th, edi:dep},
		success : function(data){
			location.reload();
		}
	})
}