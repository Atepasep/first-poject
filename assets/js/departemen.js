$(document).ready(function(){
	$("#data-tabelku tr.aktif").click();
})
$("#cetakdepartemen").click(function(){
	pesan('info','Under construction, please call database administrator');
})
$("#data-tabelku tr").click(function(){
	var aidi = $(this).attr('rel');
	$("#data-tabelku tr").removeClass('aktif');
	$("#adddepartemen").attr('href','departemen/tambahdepartemen/'+aidi);
	$(this).addClass('aktif');
	$.ajax({
		dataType : "json",
		type : "POST",
		url : "departemen/getapps",
		data : {id:aidi},
		success : function(data){
			var html = '';
			if(data.length > 0){
				for(x=1;x<=data.length;x++){
					html += "<tr rel='"+data[x-1].id+"'>"+
							"<td>"+data[x-1].id+"</td>"+
							"<td>"+data[x-1].id_dept+"</td>"+
							"<td>"+data[x-1].nama_apps+"</td>"+
							"<td>"+
							"<a href='#' data-href='departemen/hapusapps/"+data[x-1].id+"' data-target='#confirm-delete' data-toggle='modal' data-remote='false' data-title='Hapus data'>Hapus</a> | "+
							"<a href='departemen/editapps/"+data[x-1].id+"' data-target='#modalBox' data-toggle='modal' data-remote='false' data-title='Ubah Data Modul' >Edit</a>"+
							"</td>"+
							"</tr>";
				}
				$("#data-tabelku2").html(html);
			}else{
				html += "<tr>"+
						"<td colspan='4' style='text-align:center;'>Belum ada Aplikasi</td>"+
						"</tr>"; 
				$("#data-tabelku2").html(html);
				// pesan('error','Error, periksa data');
			}
		}
	})
})
$("#data-tabelku2 tr").click(function(){
	var iid = $(this).attr('rel');
	alert(iid);
	$("#data-tabelku2 tr").removeClass('aktif');
	$("#hapusdepartemen").attr('data-href','Departemen/hapusdepartemen/'+iid);
	$(this).addClass('aktif');
})