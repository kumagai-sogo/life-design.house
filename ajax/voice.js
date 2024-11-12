//$(document).ready(function(){
	voice_list();
//})

function voice_list(){
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/voice.php",
		data:{
		},
		dataType:'json',
		success : function(data){
			if(!data['listdata']) {
				$('#voicedata').html('');
			} else {
				$('#voicedata').html(data['listdata']);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}
