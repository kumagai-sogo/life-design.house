<?php

if($_POST['mode'] == "renewcheck"){
$mode = "renewend";
}elseif($_POST['mode'] == "del"){
$mode = "delend";
}else{
$mode = "end";
}

$check_html =<<<html
<div class="maintable">
内容をご確認のうえ、「送信」ボタンを押してください。
<hr size="1" style="color:#DDDDDD;">

<table border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;">
<tr>
<td class="tabletitle">日付</td>
<td class="tableform">
{$_POST['datedata'][0]}年
{$_POST['datedata'][1]}月
{$_POST['datedata'][2]}日
{$_POST['datedata'][3]}時
{$_POST['datedata'][4]}分
</td>
</tr>
<tr>
<td class="tabletitle">犬種</td>
<td class="tableform">$_POST[dtype]</td>
</tr>
<tr>
<td class="tabletitle">生体価格</td>
<td class="tableform">$_POST[price]<br>
</td>
</tr>
<tr>
<td class="tabletitle">生年月日</td>
<td class="tableform">$_POST[birthday]</td>
</tr>
<tr>
<td class="tabletitle">性別</td>
<td class="tableform">$_POST[sex]<br>
</td>
</tr>
<tr>
<td class="tabletitle">カラー</td>
<td class="tableform">$_POST[color]<br>
</td>
</tr>
<tr>
<td class="tabletitle">血統書</td>
<td class="tableform">$_POST[pedigree]<br>
</td>
</tr>
<tr>
<td class="tabletitle">出生地</td>
<td class="tableform">$_POST[birthplace]<br>
</td>
</tr>
<tr>
<td class="tabletitle">繁殖者</td>
<td class="tableform">$_POST[breeder]<br>
</td>
</tr>
<tr>
<td class="tabletitle">仕入者</td>
<td class="tableform">$_POST[stocking]<br>
</td>
</tr>
<tr>
<td class="tabletitle">動画URL</td>
<td class="tableform">$_POST[movie]</td>
</tr>
<tr>
<td class="tabletitle">画像ファイル</td>
<td class="tableform">
html;
for($h=1;$h<=$upimage_setcnt;$h++) {
	if("" != $imageurl[$h-1] && "--" != $imageurl[$h-1]) {
		$check_html .= $imageurl[$h-1]."<br><br>";
	}
}
$check_html .=<<<html
</td>
</tr>
</table>
<table border="0" cellspacing="10" cellpadding="0" style="width:100%;">
<tr>
<form action="$PHP_SELF" method="post"><td style="text-align:right;">
<input type="hidden" name="dtype" value="$_POST[dtype]">
<input type="hidden" name="checkprice" value="$_POST[checkprice]">
<input type="hidden" name="birthday" value="$_POST[birthday]">
<input type="hidden" name="checksex" value="$_POST[checksex]">
<input type="hidden" name="checkcolor" value="$_POST[checkcolor]">
<input type="hidden" name="checkpedigree" value="$_POST[checkpedigree]">
<input type="hidden" name="checkbirthplace" value="$_POST[checkbirthplace]">
<input type="hidden" name="checkbreeder" value="$_POST[checkbreeder]">
<input type="hidden" name="checkstocking" value="$_POST[checkstocking]">
<input type="hidden" name="checkmovie" value="$_POST[checkmovie]">

<input type="hidden" name="datedata[]" value="{$_POST['datedata'][0]}">
<input type="hidden" name="datedata[]" value="{$_POST['datedata'][1]}">
<input type="hidden" name="datedata[]" value="{$_POST['datedata'][2]}">
<input type="hidden" name="datedata[]" value="{$_POST['datedata'][3]}">
<input type="hidden" name="datedata[]" value="{$_POST['datedata'][4]}">
<input type="hidden" name="fname" value="$_POST[fname]">
<input type="hidden" name="imagedel" value="$_POST[imagedel]">
html;

for($h=1;$h<=$upimage_setcnt;$h++) {

$check_html .=
"<input type=\"hidden\" name=\"imagedel".$h."\" value=\"".$_POST['imagedel'.$h]."\">".
"<input type=\"hidden\" name=\"savefile".$h."\" value=\"".$_POST['savefile'.$h]."\">";
}

$check_html .=<<<html
<input type="hidden" name="mode" value="$mode">
<input type="submit" value="送信" class="submit">
</td></form>
<form><td style="text-align:left;"><input type=button value="戻る" onClick="history.back()" class="submit"></td></form>
</tr>
</table>
</div>
html;

?>