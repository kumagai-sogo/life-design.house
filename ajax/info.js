//$(document).ready(function(){
	info_data('');
//})
function GetQueryString() {
	if (1 < document.location.search.length) {
		// 最初の1文字 (?記号) を除いた文字列を取得する
		 var query = document.location.search.substring(1);

		// クエリの区切り記号 (&) で文字列を配列に分割する
		 var parameters = query.split('&');

		var result = new Object();
		for (var i = 0; i < parameters.length; i++) {
			// パラメータ名とパラメータ値に分割する
			 var element = parameters[i].split('=');

			var paramName = decodeURIComponent(element[0]);
			var paramValue = decodeURIComponent(element[1]);

			// パラメータ名をキーとして連想配列に追加する
			 result[paramName] = decodeURIComponent(paramValue);
		}
		return result;
	}
	return null;
}

function info_data(ym){
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/info.php",
		data:{
			//'id' : id,
			'ym' : ym,
		},
		dataType:'json',
		success : function(data){
			if(!data['listdata']) {
				$('#infodetails').html('');
			} else {
				$('#infodetails').html(data['listdata']);
			}
			if(!data['ymdata']) {
				$('#ymdata').html('');
				$('#ymdatasm').html('');
			} else {
				$('#ymdata').html(data['ymdata']);
				$('#ymdatasm').html(data['ymdata']);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}

function info_month(ym){
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/info.php",
		data:{
			//'id' : id,
			'ym' : ym,
		},
		dataType:'json',
		success : function(data){
			if(!data['listdata']) {
				$('#infodetails').html('');
			} else {
				$('#infodetails').html(data['listdata']);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}
