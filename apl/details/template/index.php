<?php

if($data[0]){
	$mode = "renewcheck";
	for($i=1;$i<$upimage_setcnt;$i++) {
		if($data[$i+12]){$imagedelform[$i-1] = "<input type=\"checkbox\" name=\"imagedel".($i)."\" value=\"1\"> アップロード済みのファイルを削除<br><br>";}
	}
}else{
	$mode = "check";
}

$remode = $_POST['mode'];

for($i=0;$i<count($setextension);$i++){
	$setextensionhtml .= "$setextension[$i]";
}

// if ($remode == "renew") {
// 	$count = 1;
// } else {
// 	$count = 0;
// }


$index_html =<<<html
<div class="maintable">
各項目を入力の上、「入力確認」ボタンを押してください。<br>
<hr size="1" style="color:#DDDDDD;">
<form name="form" id="form1" action="$PHP_SELF" method="post" enctype="multipart/form-data">
<table border="1" cellpadding="0" cellspacing="0">

<tr>
<td class="tabletitle">名前(必須)</td>
<td class="tableform">
<input type="text" name="name" size="40" maxlength="$titlemax" value="$data[2]" >
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
<td class="tabletitle">延床面積</td>
<td class="tableform">
<input type="text" name="floor" size="40" maxlength="$titlemax" value="$data[3]" >
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
<td class="tabletitle">敷地面積</td>
<td class="tableform">
<input type="text" name="site" size="40" maxlength="$titlemax" value="$data[4]" >
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
<td class="tabletitle">工法・構造</td>
<td class="tableform">
<input type="text" name="method" size="40" maxlength="$titlemax" value="$data[5]" >
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
<td class="tabletitle">竣工年月</td>
<td class="tableform">
<input type="text" name="finish" id="finish" value="$data[6]"> 
</td>
</tr>

<tr>
<td class="tabletitle">施工場所</td>
<td class="tableform">
<input type="text" name="address" size="40" maxlength="$titlemax" value="$data[7]" >
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
<td class="tabletitle">ポイント1</td>
<td class="tableform">
<textarea name="point01" class="ckeditor" cols="60" id="point01" rows="20">$data[8]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("point01");
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
<td class="tabletitle">ポイント2</td>
<td class="tableform">
<textarea name="point02" class="ckeditor" cols="60" id="point02" rows="20">$data[9]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("point02");
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
<td class="tabletitle">ポイント3</td>
<td class="tableform">
<textarea name="point03" class="ckeditor" cols="60" id="point03" rows="20">$data[10]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("point03");
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
<td class="tabletitle">ポイント4</td>
<td class="tableform">
<textarea name="point04" class="ckeditor" cols="60" id="point04" rows="20">$data[11]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("point04");
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
<td class="tabletitle">ポイント5</td>
<td class="tableform">
<textarea name="point05" class="ckeditor" cols="60" id="point05" rows="20">$data[12]</textarea><br/>
<script type="text/javascript">
CKEDITOR.replace("point05");
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
<td class="tabletitle">画像ファイル</td>
<td class="tableform">${imagedelform[0]}$data[301]<br><input type="file" name="userfile1" size=40><br>
「参照」ボタンを押して、画像ファイルを指定ください。<br>アップロードができる画像サイズの最大は、縦${up_hlimit_upper}px、横${up_wlimit_upper}pxで、ファイルサイズは${up_filesizelimit_upper}KBです。<br>最小サイズは、縦${up_hlimit_lower}px、横${up_wlimit_lower}pxです。<br>また、アップロードできる画像の拡張子は『${setextensionhtml}』のみです。
</td>
</tr>
html;
for($i=1;$i<$upimage_setcnt;$i++) {
$index_html .=
"<tr><td class=\"tabletitle\">画像ファイル</td>".
"<td class=\"tableform\">".$imagedelform[$i].$data[$i+301]."<br><input type=\"file\" name=\"userfile" .($i+1) ."\" size=40><br>
「参照」ボタンを押して、画像ファイルを指定ください。<br>アップロードができる画像サイズの最大は、縦${up_hlimit_upper}px、横${up_wlimit_upper}pxで、ファイルサイズは${up_filesizelimit_upper}KBです。また、アップロードできる画像の拡張子は『${setextensionhtml}』のみです。</td></tr>";
}

$index_html .=<<<html
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