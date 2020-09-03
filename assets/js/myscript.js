$(document).ready(function(){
	modalBox();

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var string = document.getElementById("confirm-delete").innerHTML;
		var hasil = string.replace("fa fa-text-width text-yellow","fa fa-exclamation-triangle text-red");
		document.getElementById("confirm-delete").innerHTML = hasil;

		var string2 = document.getElementById("confirm-delete").innerHTML;
		var hasil2 = string2.replace("Konfirmasi", "&nbspKonfirmasi");
		document.getElementById("confirm-delete").innerHTML = hasil2;
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$('#confirm-task').on('show.bs.modal', function(e) {
		var string2 = document.getElementById("confirm-delete").innerHTML;
		var hasil2 = string2.replace("Konfirmasi", "&nbspKonfirmasi");
		document.getElementById("confirm-delete").innerHTML = hasil2;
		document.getElementById("test").innerHTML = $(e.relatedTarget).data('news');
		$(this).find('.btn-oke').attr('href', $(e.relatedTarget).data('href'));
	});
})
function modalBox(){
	$('#modalBox').on('show.bs.modal', function(e){
		var link = $(e.relatedTarget);
		var title = link.data('title');
		var modal = $(this)
		modal.find('.modal-title').text(title)
		$(this).find('.fetched-data').load(link.attr('href'));
	});
	return false;
}
function pesan(jenis,pesan){
	if(jenis = 'info'){
		var head = 'Information';
	}
	$.toast({
			heading: head,
			text: pesan,
			showHideTransition: 'slide',
			icon: jenis,
			hideAfter: 5000,
			position: 'bottom-right',
			bgColor: ' 	#17A2B8'
	});
}
function rupiah(amount, decimalSeparator, thousandsSeparator, nDecimalDigits){  
      var num = parseFloat( amount ); //convert to float  
      //default values  
      decimalSeparator = decimalSeparator || '.';  
      thousandsSeparator = thousandsSeparator || ',';  
      nDecimalDigits = nDecimalDigits == null? 2 : nDecimalDigits;  
      
      var fixed = num.toFixed(nDecimalDigits); //limit or add decimal digits  
      //separate begin [$1], middle [$2] and decimal digits [$4]  
      var parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed);   
      
      if(parts){ //num >= 1000 || num < = -1000  
        return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');  
      }else{  
        return fixed.replace('.', decimalSeparator);  
      }        
}
function toAngka(rp){
	return rp.replace(/,*|\D/g,'');
}
function isiangka(e,decimal){
	var key;
	var keychar;
	if(window.event){
		key = window.event.keycode;
	}else if(e){
		key = e.which;
	}else return true;

	keychar = String.fromCharCode(key);
	if((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)){
		return true;
	}else if(("0123456789"),indexOf(keychar) > -1){
		return true;
	}else if(decimal && (keychar==".")){
		return true;
	}else if(keychar=="-"){
		return true;
	}else return false;
}
function tglmysql(os){
	var tahun = os.split("-")[0];
	var bulan = os.split("-")[1];
	var tgl = os.split("-")[2];
	return tgl+"-"+bulan+"-"+tahun;
}