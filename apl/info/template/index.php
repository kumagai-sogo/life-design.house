<?php

if($data[0]){
	$mode = "renewcheck";
	for($i=0;$i<$upimage_setcnt;$i++) {
		if($data[$i+6]){$imagedelform[$i] = "<input type=\"checkbox\" name=\"imagedel".($i+1)."\" value=\"1\"> アップロード済みのファイルを削除<br><br>";}
	}
}else{
	$mode = "check";
}

for($i=0;$i<count($setextension);$i++){
	$setextensionhtml .= "$setextension[$i]　";
}

$index_html =<<<html
<div class="maintable">
各項目を入力の上、「入力確認」ボタンを押してください。<br>
　※使い方はこちらを参考にしてください<a href="https://www.youtube.com/watch?v=KGr6FpInUzU" target="_blank">CKeditorの基本的な使い方</a><br>
<hr size="1" style="color:#DDDDDD;">
<form name="form" action="$PHP_SELF" method="post" enctype="multipart/form-data" style="margin:0px;">
<table border="1" cellpadding="0" cellspacing="0">
<tr>
<td class="tabletitle">日時</td>
<td class="tableform">
<input type="text" name="datedata[]" size="4" maxlength="4" value="$datedata[year]">年
<input type="text" name="datedata[]" size="2" maxlength="2" value="$datedata[mon]">月
<input type="text" name="datedata[]" size="2" maxlength="2" value="$datedata[mday]">日
<input type="text" name="datedata[]" size="2" maxlength="2" value="$datedata[hours]">時
<input type="text" name="datedata[]" size="2" maxlength="2" value="$datedata[minutes]">分
</td>
</tr>

<tr>
<td class="tabletitle">カテゴリー</td>
<td class="tableform">
<input type="radio" name="dtype" value="新着情報" ${dtypechkeck1}>新着情報&nbsp;&nbsp;
<input type="radio" name="dtype" value="イベント" ${dtypechkeck2}>イベント&nbsp;&nbsp;
</td>
</tr>

<tr>
<td class="tabletitle">タイトル</td>
<td class="tableform">
<textarea name="title" class="ckeditor" cols="60" id="title" name="edited" rows="10">$data[4]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("title");
</script>
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<tr>
<td class="tabletitle">コメント</td>
<td class="tableform">
<textarea name="comment" class="ckeditor" cols="60" id="comment" name="edited" rows="20">$data[5]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("comment");
</script>
html;
if(COMMENTMAX > 0){
$index_html .=<<<html
<span class="formsubcomment">（全角${commentmax}文字まで）</span>
html;
}

$index_html .=<<<html
</td>
</tr>

<tr>
<td class="tabletitle">画像ファイル<br>サムネイル１：１</td>
<td class="tableform">${imagedelform[0]}$data[300]<br><input type="file" name="userfile1" size=40><br>
「参照」ボタンを押して、画像ファイルを指定ください。<br>アップロードができる画像サイズの最大は、縦${up_hlimit_upper}px、横${up_wlimit_upper}pxで、ファイルサイズは${up_filesizelimit_upper}KBです。<br><!--最小サイズは、縦${up_hlimit_lower}px、横${up_wlimit_lower}pxです。<br>-->また、アップロードできる画像の拡張子は『${setextensionhtml}』のみです。
</td>
</tr>
html;
for($i=1;$i<$upimage_setcnt;$i++) {
$index_html .=
"<tr><td class=\"tabletitle\">画像ファイル</td>".
"<td class=\"tableform\">".$imagedelform[$i].$data[$i+300]."<br><input type=\"file\" name=\"userfile" .($i+1) ."\" size=40><br></td></tr>";
}

$index_html .=<<<html
</table>
<input type="hidden" name="mode" value="$mode">
<input type="hidden" name="fname" value="$data[0]">

html;

for($i=1;$i<=$upimage_setcnt;$i++) {
$index_html .= "<input type=\"hidden\" name=\"savefile". $i ."\" value=\"". $data[$i+5] . "\">\n";
}

$index_html .=<<<html
<table border="0" cellspacing="0" cellpadding="0" style="width:100%;text-align:center;">
<tr>
<td>
&nbsp;
</td>
</tr>
<tr>
<td>
<input type="submit" value="入力確認" class="submit">
</td>
</tr>
</table>
</form>
</div>
html;


?>