//$(document).ready(function(){
	details_list();
//})

function details_list(){
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/topworks.php",
		data:{		},
		dataType:'json',
		success : function(data){
			$('#topworkslist').html(data['listdata']);
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}
