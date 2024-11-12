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
<td class="tabletitle">お客様の名前</td>
<td class="tableform">$_POST[title]<br>
</td>
</tr>
<tr>
<td class="tabletitle">コメント</td>
<td class="tableform">$_POST[comment]</td>
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
<input type="hidden" name="checktitle" value="$_POST[checktitle]">
<input type="hidden" name="checkcomment" value="$_POST[checkcomment]">
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
<input type="submit" value="実行" class="submit">
</td></form>
<form><td style="text-align:left;"><input type=button value="戻る" onClick="history.back()" class="submit"></td></form>
</tr>
</table>
</div>
html;

?>