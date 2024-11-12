//$(document).ready(function(){
//})
detailsimg_data();
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

function detailsimg_data(){
	var pcpretag = '<a href="works_details.html?no=<!--no-->">◀︎PREV</a>';
	var pcnexttag = '<a href="works_details.html?no=<!--no-->">NEXT▶︎</a>';
	var sppretag = '<a href="works_details.html?no=<!--no-->">◀︎</a>';
	var spnexttag = '<a href="works_details.html?no=<!--no-->">▶︎</a>';

	param = GetQueryString();
	if(param) {
		no = param["no"];
	} else {
		no = "";
	}
	$.ajax({
		type: 'POST',
		async: false,							//同期
		url:"ajax/works_details.php",
		data:{
			'no' : no,
		},
		dataType:'json',
		success : function(data){
			if(!data['detailsimgdata']) {
				$('#points').html('');
			} else {
				$('#points').html(data['detailsimgdata']);
			}
			if(!data['listdata']) {
				$('#property').html('');
			} else {
				$('#property').html(data['listdata']);
			}
			if(!data['metadata']) {
				$('head').prepend('');
			} else {
				$('head').prepend(data['metadata']);
			}
			if(!data['breaddata']) {
				$('#breadcrumb').html('');
			} else {
				$('#breadcrumb').html(data['breaddata']);
			}
			if(data['preno']) {
				tags = pcpretag.replaceAll('<!--no-->',data['preno']);
				$('#prepage').html(tags);
				tags = sppretag.replaceAll('<!--no-->',data['preno']);
				$('#spprepage').html(tags);
			}
			if(data['nextno']) {
				tags = pcnexttag.replaceAll('<!--no-->',data['nextno']);
				$('#nextpage').html(tags);
				tags = spnexttag.replaceAll('<!--no-->',data['nextno']);
				$('#spnextpage').html(tags);
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
			alert('Error! ' + textStatus + ' ' + errorThrown);
			return false;
		}
	});
}
