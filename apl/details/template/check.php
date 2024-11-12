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
<td class="tabletitle">名前</td>
<td class="tableform">$_POST[name]<br>
</td>
</tr>

<tr>
<td class="tabletitle">延床面積</td>
<td class="tableform">$_POST[floor]</td>
</tr>

<tr>
<td class="tabletitle">敷地面積</td>
<td class="tableform">$_POST[site]<br>
</td>
</tr>

<tr>
<td class="tabletitle">工法・構造</td>
<td class="tableform">$_POST[method]<br>
</td>
</tr>

<tr>
<td class="tabletitle">竣工年月</td>
<td class="tableform">$_POST[finish]<br>
</td>
</tr>

<tr>
<td class="tabletitle">施工場所</td>
<td class="tableform">$_POST[address]<br>
</td>
</tr>

<tr>
<td class="tabletitle">ポイント1</td>
<td class="tableform">$_POST[point01]<br>
</td>
</tr>

<tr>
<td class="tabletitle">ポイント2</td>
<td class="tableform">$_POST[point02]<br>
</td>
</tr>

<tr>
<td class="tabletitle">ポイント3</td>
<td class="tableform">$_POST[point03]<br>
</td>
</tr>

<tr>
<td class="tabletitle">ポイント4</td>
<td class="tableform">$_POST[point04]<br>
</td>
</tr>

<tr>
<td class="tabletitle">ポイント5</td>
<td class="tableform">$_POST[point05]<br>
</td>
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
<input type="hidden" name="checkname" value="$_POST[checkname]">
<input type="hidden" name="finish" value="$_POST[finish]">
<input type="hidden" name="checkfloor" value="$_POST[checkfloor]">
<input type="hidden" name="checksite" value="$_POST[checksite]">
<input type="hidden" name="checkmethod" value="$_POST[checkmethod]">
<input type="hidden" name="checkaddress" value="$_POST[checkaddress]">
<input type="hidden" name="checkpoint01" value="$_POST[checkpoint01]">
<input type="hidden" name="checkpoint02" value="$_POST[checkpoint02]">
<input type="hidden" name="checkpoint03" value="$_POST[checkpoint03]">
<input type="hidden" name="checkpoint04" value="$_POST[checkpoint04]">
<input type="hidden" name="checkpoint05" value="$_POST[checkpoint05]">

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