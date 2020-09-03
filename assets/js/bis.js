$("#data-tabelku tr td.detabsen").on('click',function(){
	var rel = $(this).attr('rel');
	$("#cekabsen").attr('href',rel);
	$("#cekabsen").click();
})

$("#tanggal").on('change',function(){
	ubahperiode();
})
$("#bulan").change(function(){
	ubahperiode();
})
$("#tahun").change(function(){
	ubahperiode();
})

function ubahperiode(){
	var tg = $("#tanggal").val();
	var bl = $("#bulan").val();
	var th = $("#tahun").val();
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : "Bis/ubahperiode",
		data : {tgl:tg, bln:bl, thn:th},
		success : function(data){
			location.reload();
		}
	})
}