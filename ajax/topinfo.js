//$(document).ready(function(){
	topinfo_list();
//})

function topinfo_list(){
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/topinfo.php",
		data:{
		},
		dataType:'json',
		success : function(data){
			if(!data['listdata']) {
				$('#topinfodata').html('');
			} else {
				$('#topinfodata').html(data['listdata']);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}
