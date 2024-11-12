<?php
if($data[0]){
	$mode = "renewcheck";
	for($i=0;$i<$upimage_setcnt;$i++) {
		if($data[$i+11]){$imagedelform[$i] = "<input type=\"checkbox\" name=\"imagedel".($i+1)."\" value=\"1\"> アップロード済みのファイルを削除<br><br>";}
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
<hr size="1" style="color:#DDDDDD;">
<form name="form" action="$PHP_SELF" method="post" enctype="multipart/form-data">
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
<td class="tabletitle">犬種</td>
<td class="tableform">
<label><input type="radio" name="dtype" value="ワイマラナー" ${dtypechkeck2}>ワイマラナー&nbsp;&nbsp;</label>
<label><input type="radio" name="dtype" value="柴犬" ${dtypechkeck5}>柴犬&nbsp;&nbsp;</label>
<br>
</td>
</tr>
<tr>
<td class="tabletitle">生体価格</td>
<td class="tableform">
<input type="text" name="price" size="40" maxlength="$titlemax" value="$data[4]" >
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
<td class="tabletitle">生年月日</td>
<td class="tableform">
<input type="text" name="birthday" id="birthday" value="$data[5]"> 
</td>
</tr>

<td class="tabletitle">性別</td>
<td class="tableform">
<input type="text" name="sex" size="40" maxlength="$titlemax" value="$data[6]" >
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<td class="tabletitle">カラー</td>
<td class="tableform">
<input type="text" name="color" size="40" maxlength="$titlemax" value="$data[7]" >
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<td class="tabletitle">血統書</td>
<td class="tableform">
<input type="text" name="pedigree" size="40" maxlength="$titlemax" value="$data[8]" >
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<td class="tabletitle">出生地</td>
<td class="tableform">
<input type="text" name="birthplace" size="40" maxlength="$titlemax" value="$data[9]" >
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<td class="tabletitle">繁殖者</td>
<td class="tableform">
<input type="text" name="breeder" size="40" maxlength="$titlemax" value="$data[10]" >
html;
if(TYTLEMAX > 0) {
$index_html .=<<<html
<span class="formsubcomment">（全角${titlemax}文字まで）</span>
html;
}
$index_html .=<<<html
</td>
</tr>

<td class="tabletitle">仕入者</td>
<td class="tableform">
<input type="text" name="stocking" size="40" maxlength="$titlemax" value="$data[11]" >
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
<td class="tabletitle">動画URL</td>
<td class="tableform">
<textarea name="movie" class="movie" cols="60" id="movie" name="movie" rows="10">{$data[12]}</textarea><br/>
Youtube動画の埋め込みコードを入れてください。やり方は<a href="https://support.google.com/youtube/answer/171780?hl=ja" target="_blank" rel="nofollow">こちら</a><br>
</td>
</tr>

<tr>
<td class="tabletitle">画像ファイル</td>
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
<!--
<tr><td class="tabletitle">画像ファイル</td>
<td class="tableform">${imagedelform[1]}$data[31]<br><input type="file" name="userfile2" size=40><br>
</td></tr>
<tr>
<td class="tabletitle">画像ファイル</td>
<td class="tableform">${imagedelform[2]}$data[32]<br><input type="file" name="userfile3" size=40><br>
</td>
</tr>
<tr>
<td class="tabletitle">画像ファイル</td>
<td class="tableform">${imagedelform[3]}$data[33]<br><input type="file" name="userfile4" size=40><br>
</td>
</tr>
<tr>
<td class="tabletitle">画像ファイル</td>
<td class="tableform">${imagedelform[4]}$data[34]<br><input type="file" name="userfile5" size=40><br>
</td>
</tr>
-->
</table>
<input type="hidden" name="mode" value="$mode">
<input type="hidden" name="fname" value="$data[0]">

html;

for($i=1;$i<=$upimage_setcnt;$i++) {
$index_html .= "<input type=\"hidden\" name=\"savefile". $i ."\" value=\"". $data[$i+12] . "\">\n";
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