$(document).ready(function(){
	//isitgl();
	//$("#grup").change();
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
$("#cetakabsen").on('click',function(){
	pesan('danger','Under construction, please Call website administrator');
})
$("#hadir").change(function(){
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
	}else{
		isikupon();
	}
})
$("#hadirar").change(function(){
	$("#hadir").change();
})
$("#hadirnu").change(function(){
	$("#hadir").change();
})
$("#lembur").change(function(){
	isikupon();
})
$("#lemburar").change(function(){
	isikupon();
})
$("#lemburnu").change(function(){
	isikupon();
})
$("#kmb").change(function(){
	isikupon();
})
$("#ket").change(function(){
	isikupon();
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
		url : "Absen/ubahshi",
		data : {ede:des, day:dy, bln:bl, thn:th, edi:dep},
		success : function(data){
			location.reload();
		}
	})
}
$(document).on('keyup','#carinama',function(){
	var len = $("#carinama").val();
	var urlx= $("#urle").val();
	var dep = $("#depe").val();
	var mode= $("#modecari").val();
	var n = len.length;
	if(n > 2){
		$.ajax({
			dataType : 'json',
			type : "POST",
			url : urlx,
			data : {kci:len,depe:dep,mod:mode},
			success : function(data){
				document.getElementById("data-tabelku").innerHTML = "";
				var html = '';
				var x;
				for(x=0;x<data.length;x++){
					html += "<tr>"+
					"<td>"+data[x].noinduk+"</td>"+
					"<td>"+data[x].nama+"</td>"+
					"<td>"+data[x].bagian+"</td>"+
					"<td>"+data[x].grup+"</td>"+
					"<td class='huruf-tengah'><a href='#' class='btn btn-sm btn-warning flat huruf-kecil' rel='"+data[x].id+"' id='pilihkry'>Pilih</a></td>"+
					"</tr>";
				}
				document.getElementById("data-tabelku").innerHTML = html;
			}
		})
	}else{
		$.ajax({
			dataType : 'json',
			type : "POST",
			url : urlx,
			data : {kci:'@#@#',depe:dep,mod:mode},
			success : function(data){
				document.getElementById("data-tabelku").innerHTML = "";
				var html = '';
				var x;
				for(x=0;x<data.length;x++){
					html += "<tr>"+
					"<td>"+data[x].noinduk+"</td>"+
					"<td>"+data[x].nama+"</td>"+
					"<td>"+data[x].bagian+"</td>"+
					"<td>"+data[x].grup+"</td>"+
					"<td class='huruf-tengah'><a href='#' class='btn btn-sm btn-warning flat huruf-kecil' rel='"+data[x].id+"' id='pilihkry'>Pilih</a></td>"+
					"</tr>";
				}
				document.getElementById("data-tabelku").innerHTML = html;
			}
		})
	}
})
$(document).on('click','.dataabsen',function(){
	var rel = $(this).attr('rel');
	$("#dataabsenx").attr('href',rel);
	$("#dataabsenx").click();
})
$(document).on('click','#pilihkry',function(){
	var id = $(this).attr('rel');
	var tgl = $("#tanggal").val();
	var dept = $("#dept").val();
	var shi = $("#shif").val();
	var urla = $("#urla").val();
	var jmk = $("#jmkry").val();
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : urla,
		data : {tg:tgl,dp:dept,sh:shi,idx:id,jmka:jmk},
		success : function(data){
			$("#keluartambahkry").click();
			location.reload();
		}
	})
})
$(document).on('change','#grup',function(){
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : $("#urlubahgrup").val(),
		data : {gru:$(this).val()},
		success : function(data){
			$("#jumlahkry").val(data[0].jumlah);
		}
	})
})
$("#cekkupon").click(function(){
	var tg = $("#tanggal").val();
	var de = $("#dept").val();
	var sh = $("#shif").val();
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : $("#urlhitungkupon").val(),
		data : {tgl:tg,dep:de,shi:sh},
		success : function(data){
			//alert('OK');
		}
	})
})
function isikupon(){
	var xhadir = $("#hadir").val()=='' ? 0 : $("#hadir").val();
	var xhadirar = $("#hadirar").val()=='' ? 0 : $("#hadirar").val();
	var xhadirnu = $("#hadirnu").val()=='' ? 0 : $("#hadirnu").val();
	var xlembur = $("#lembur").val()=='' ? 0 : $("#lembur").val();
	var xlemburar = $("#lemburar").val()=='' ? 0 : $("#lemburar").val();
	var xlemburnu = $("#lemburnu").val()=='' ? 0 : $("#lemburnu").val();
	var xkmb = $("#kmb").val()=='' ? 0 : $("#kmb").val();
	var xket = $("#ket").val()=='' ? '' : $("#ket").val();
	var tg = $("#tanggal").val();
	var de = $("#dept").val();
	var sh = $("#shif").val();
	if(document.getElementById("cekkupon").checked==true){
		$("#loading").removeClass("hidden");
		$.ajax({
			dataType : 'json',
			type : "POST",
			url : $("#urlsimpankupon").val(), //,kmb:xkmb,ket:xket
			data : {tgl:tg,dep:de,shi:sh,hadir:xhadir,hadirar:xhadirar,hadirnu:xhadirnu,lembur:xlembur,lemburar:xlemburar,lemburnu:xlemburnu,kmb:xkmb,ket:xket},
			success : function(data){
				//alert('Mantap');
				$("#loading").addClass("hidden");
			}
		})
	}else{
		alert('Untuk Edit Kupon, Centang dahulu "Tambah Kupon Makan" ');
		location.reload();
	}
}