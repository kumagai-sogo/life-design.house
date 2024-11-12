<?php
session_start();
header("Content-Type: text/html;charset=UTF-8");
header("Expires: Thu, 01 Dec 1994 16:00:00 GMT");
header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once("config.php");
if($_SESSION['loginJoutai'] == $passWord){
	//ライフ
	$apls .= '<tr>';
	$apls .= '<td align="left" style="font-size: 24px;font-weight: bold;">ライフ</td>';
	$apls .= '</tr>';
	$apls .= '<tr>';
	for($i=0;$i<count($aplname);$i++) {
		$apls .= '<td align="center">';
		$apls .= '<form action="'.$aplname[$i]['action'].'" method="post" name="menuform$i" target="_blank" style="margin:0">';
		$apls .= '<input type="submit" value="'.$aplname[$i]['name'].'" class="bt_menu">';
		$apls .= '<input type="hidden" name="'.$aplname[$i]['id'].'" value="'.$aplname[$i]['lid'].'">';
		$apls .= '<input type="hidden" name="'.$aplname[$i]['pass'].'" value="'.$aplname[$i]['lpass'].'">';
		$apls .= '</form>';
		$apls .= '</td>';
	}
	$apls .= '</tr>';

	//不動産
	$apls .= '<tr>';
	$apls .= '<td align="left" style="font-size: 24px;font-weight: bold;">不動産</td>';
	$apls .= '</tr>';
	$apls .= '<tr>';
	for($i=0;$i<count($aplname2);$i++) {
		$apls .= '<td align="center">';
		$apls .= '<form action="'.$aplname2[$i]['action'].'" method="post" name="menuform$i" target="_blank" style="margin:0">';
		$apls .= '<input type="submit" value="'.$aplname2[$i]['name'].'" class="bt_menu">';
		$apls .= '<input type="hidden" name="'.$aplname2[$i]['id'].'" value="'.$aplname2[$i]['lid'].'">';
		$apls .= '<input type="hidden" name="'.$aplname2[$i]['pass'].'" value="'.$aplname2[$i]['lpass'].'">';
		$apls .= '</form>';
		$apls .= '</td>';
	}
	$apls .= '</tr>';

	//建築
	$apls .= '<tr>';
	$apls .= '<td align="left" style="font-size: 24px;font-weight: bold;">建築</td>';
	$apls .= '</tr>';
	$apls .= '<tr>';
	for($i=0;$i<count($aplname3);$i++) {
		$apls .= '<td align="center">';
		$apls .= '<form action="'.$aplname3[$i]['action'].'" method="post" name="menuform$i" target="_blank" style="margin:0">';
		$apls .= '<input type="submit" value="'.$aplname3[$i]['name'].'" class="bt_menu">';
		$apls .= '<input type="hidden" name="'.$aplname3[$i]['id'].'" value="'.$aplname3[$i]['lid'].'">';
		$apls .= '<input type="hidden" name="'.$aplname3[$i]['pass'].'" value="'.$aplname3[$i]['lpass'].'">';
		$apls .= '</form>';
		$apls .= '</td>';
	}
	$apls .= '</tr>';


/*
	$apls .= '<tr>';
	$apls .= '<td colspan="3" align="center">';
	$apls .= '<form action="'.$aplname5[0]['action'].'" method="post" name="menuformres" target="_blank" style="margin:0">';
	$apls .= '<input type="submit" value="'.$aplname5[0]['name'].'" class="bt_menu_big">';
	$apls .= '<input type="hidden" name="'.$aplname5[0]['id'].'" value="'.$aplname5[0]['lid'].'">';
	$apls .= '<input type="hidden" name="'.$aplname5[0]['pass'].'" value="'.$aplname5[0]['lpass'].'">';
	$apls .= '</form>';
	$apls .= '</td>';
	$apls .= '</tr>';

	for($i=0;$i<count($aplname6);$i++) {
		if(0 == $i || 0 == ($i % 3)) {
			$apls .= '<tr>';
		}
		$apls .= '<td align="center">';
		$apls .= '<form action="'.$aplname6[$i]['action'].'" method="post" name="menuform$i" target="_blank" style="margin:0">';
		$apls .= '<input type="submit" value="'.$aplname6[$i]['name'].'" class="bt_menu">';
		$apls .= '<input type="hidden" name="'.$aplname6[$i]['id'].'" value="'.$aplname6[$i]['lid'].'">';
		$apls .= '<input type="hidden" name="'.$aplname6[$i]['pass'].'" value="'.$aplname6[$i]['lpass'].'">';
		$apls .= '</form>';
		$apls .= '</td>';
		if(2 == ($i % 3)) {
			$apls .= '</tr>';
		}
	}
*/

$viewHtml .= <<<EOM
<div class="header_line"><div class="header_line_bg"></div></div>

<table cellpadding="0" cellspacing="0" class="tb_main">
<tr>
<td>
<table class="tb_content">
<!-- ここから //-->
{$apls}
<form action="logout.php" method="post" name="passform">
<tr><td align="center" colspan="3"><input type="submit" value="ログアウト" class="submit" style=""></td></tr>
</form><!-- ここまでが管理画面の内容 //-->
</table>

</td>
</tr>
</table>
EOM;

}else{

	$messe = 'パスワードを入力ください。<br />';
	if(isset($_SESSION['loginJoutai'])){
		$messe = '<span style="color:red;">パスワードが違います。</span><br />';
	}

$scriptset = <<<EOM
window.onload = function(){
	document.passform.password.focus();
}

EOM;

$viewHtml .= <<<EOM
<div class="header_line"><div class="header_line_bg"></div></div>

<table cellpadding="0" cellspacing="0" class="tb_main">
<tr>
<td class="tb_content">

<!-- ここから //-->
<h2 class="bg-grad">ログイン</h2><br/>
<div class="msgtitle">
{$messe}
</div>
<form action="login.php" method="post" name="passform">
<table border="0" cellpadding="0" cellspacing="0" style="width:650px;margin-top:20px;font-size:13px;color:#555555;">
<tr><td class="tabletitle">パスワード</td><td class="tableform"><input type="password" name="password" size="10" style="width:100px;"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="ログイン" class="submit" style="margin:50px 10px;"></td></tr>
</table>
</form><!-- ここまでが管理画面の内容 //-->

</td>
</tr>
</table>

EOM;

}

print <<<EOM
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="ja" />
<title>{$title}</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header_top"></div>
<div class="main">
<div class="margin_main">
<h1>{$title}</h1>
{$viewHtml}
</body>
</html>
</div>
</div>
<div class="footer_bottom"></div>
EOM;

?>
