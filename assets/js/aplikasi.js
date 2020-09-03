$(document).on('click','#namaapps',function(){
	var c = $(this).attr('rel');
	$.ajax({
		dataType : 'json',
		type : "POST",
		url : "bis/log",
		data : {apps:c},
		success : function(data){

		}
	})
})