<?php

include("plugin/admin.php");
include("config/config.php");

$PHP_SELF = "admin.php";

logincheck();
$menu = menu();

switch($_POST['mode']){


case 'htmlrenew':

if(TOPHTML){
html(list_renew_bt("リストページのHTMLファイルを更新します。<br>並び順の変更後に使用ください。").detailed_renew_bt("各画像ページのHTMLファイルを更新します。<br>テンプレートファイルのデザイン変更後等、必要に応じ使用ください。").toplist_renew_bt("トップページ用リストページのHTMLファイルを更新します。<br>並び順の変更後に使用ください。"));
}else{
html(list_renew_bt("リストページのHTMLファイルを更新します。<br>並び順の変更後に使用ください。").detailed_renew_bt("各画像ページのHTMLファイルを更新します。<br>テンプレートファイルのデザイン変更後等、必要に応じ使用ください。"));
}
break;


case 'detailedhtmlrenew':

$template = file_get_contents(TEMPLATEDETAILED);

$lines = file($log_file);

for($i=0;$i<count($lines);$i++){

	$data = explode("<>",$lines[$i]);

	$_POST['fname'] = $data[0];
	$_POST['savefile'] = $data[1];
	$_POST['date'] = date_html($data[2]);
	$_POST['dtype'] = $data[3];
	$_POST['title'] = $data[4];
	$_POST['comment'] = $data[5];

	for($i=1;$i<=$upimage_setcnt;$i++) {
		$_POST['savefile'.$i] = $data[$i+5];
		if($_POST['savefile'.$i]){

			$imgsize = GetImageSize($images_dir.$_POST['savefile'.$i]);

			//☆画像サイズ縮小
			$reducesize = imagesizedivision($imgsize[0],$imgsize[1],$view_wsize,$view_hsize);

			//☆画像タグリンク
			$_POST['image'.$i] = imagelinktag($reducesize[4],$_POST['savefile'.$i],$_POST['title'],$reducesize[3]);
		}else{

			$_POST['image'.$i] = "";
		}
	}


	fsave_w(str_replace_template($_POST,$template),$_POST['fname'].".html");
}

html(ok("HTMLファイル更新完了").adminlist_bt());

break;


case 'listtoplisthtmlrenew':

$lines = file($log_file);

if(TOPHTML){
toplist_html(0,$lines);
}
list_html(0,$lines);

if(file_exists($htmlrenew_file)){
@unlink($htmlrenew_file);
}

html(ok("HTMLファイル更新完了").adminlist_bt());

break;


case 'toplisthtmlrenew':

$lines = file($log_file);

if(TOPHTML){
toplist_html(0,$lines);
}

html(ok("HTMLファイル更新完了").adminlist_bt());

break;


case 'listhtmlrenew':

$lines = file($log_file);

list_html(0,$lines);

html(ok("HTMLファイル更新完了").adminlist_bt());

break;


case 'logset':

$lines = file($log_file);

$lines = logsort($_POST['fname'],$lines);

fsave_array_w($lines,$log_file);

//fsave_w("1",$htmlrenew_file);

//$html_list_renew_bt = listtoplist_renew_bt("並び順の変更後、最後にリストページのHTMLファイルを更新ください。");

html($html_list_renew_bt.adminlist_html(0,$lines));

if(TOPHTML){
toplist_html(0,$lines);
}

break;


case 'check':

check();

/*
if($htmlinput){
$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);

$_POST['checktitle'] = nl2br($_POST['title']);
$_POST['checkcomment'] = nl2br($_POST['comment']);

}else{
$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);

$_POST['checktitle'] = str_replace("\n", "<br>", $_POST['title']);
$_POST['checkcomment'] = str_replace("\n", "<br>", $_POST['comment']);
}
*/

$_POST['title'] = stripslashes($_POST['title']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$_POST['comment'] = stripslashes($_POST['comment']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$edit_search = array('<', '>','"','\\"');
$edit_replace = array('&lt;', '&gt;','&quot;','&quot;');

$_POST['checktitle'] = str_replace($edit_search, $edit_replace, $_POST['title']);
$_POST['checktitle'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checktitle']);
$_POST['checkcomment'] = str_replace($edit_search, $edit_replace, $_POST['comment']);
$_POST['checkcomment'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkcomment']);

for($i=1;$i<=$upimage_setcnt;$i++) {
	if($_FILES['userfile'.$i]['name']){
		$imageurl[$i-1] = imageup($i);
	}else{
		noimageup($i);
		$imageurl[$i-1] = "--";
	}
}


include(CHECKPAGE);

html($check_html);

break;


case 'end':


check();

/*
$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);
$_POST['title2'] = strcode($_POST['title']);

if($htmlinput){

$_POST['title'] = str_replace("\r\n", "<br>", $_POST['title']);
$_POST['title'] = str_replace("\r", "<br>", $_POST['title']);
$_POST['title'] = str_replace("\n", "<br>", $_POST['title']);
$_POST['comment'] = str_replace("\r\n", "<br>", $_POST['comment']);
$_POST['comment'] = str_replace("\r", "<br>", $_POST['comment']);
$_POST['comment'] = str_replace("\n", "<br>", $_POST['comment']);

}else{
$_POST['title'] = str_replace("\r\n", "<!--br-->", $_POST['title']);
$_POST['title'] = str_replace("\r", "<!--br-->", $_POST['title']);
$_POST['title'] = str_replace("\n", "<!--br-->", $_POST['title']);
$_POST['comment'] = str_replace("\r\n", "<!--br-->", $_POST['comment']);
$_POST['comment'] = str_replace("\r", "<!--br-->", $_POST['comment']);
$_POST['comment'] = str_replace("\n", "<!--br-->", $_POST['comment']);
}
*/
$edit_search = array('&lt;', '&gt;', '&quot;');
$edit_replace = array('<', '>','"');

$_POST['title'] = str_replace($edit_search, $edit_replace, $_POST['checktitle']);
$_POST['title'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checktitle']);
$_POST['comment'] = str_replace($edit_search, $edit_replace, $_POST['checkcomment']);
$_POST['comment'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkcomment']);


for($i=1;$i<=$upimage_setcnt;$i++) {
	if($_POST['savefile'.$i]){

		filemove($imagestmp_dir.$_POST['savefile'.$i], $images_dir.$_POST['savefile'.$i]);
		filemove($imagestmp_dir."thumb".$_POST['savefile'.$i], $images_dir."thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."pc_thumb".$_POST['savefile'.$i], $images_dir."pc_thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."pct_thumb".$_POST['savefile'.$i], $images_dir."pct_thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."pcl_thumb".$_POST['savefile'.$i], $images_dir."pcl_thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."smt_thumb".$_POST['savefile'.$i], $images_dir."smt_thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."sml_thumb".$_POST['savefile'.$i], $images_dir."sml_thumb".$_POST['savefile'.$i]);
		filemove($imagestmp_dir."sm_thumb".$_POST['savefile'.$i], $images_dir."sm_thumb".$_POST['savefile'.$i]);

		$imgsize = GetImageSize($images_dir.$_POST['savefile'.$i]);
		$reducesize = imagesizedivision($imgsize[0],$imgsize[1],$view_wsize,$view_hsize);
		$_POST['image'.$i] = imagelinktag($reducesize[4],$_POST['savefile'.$i],$_POST['title'],$reducesize[3]);

	}else{

		$imageurl = "";
	}
}

$_POST['date'] = "[ ".$_POST['datedata'][0]."$dadedividing".$_POST['datedata'][1]."$dadedividing".$_POST['datedata'][2]." ]";

$_POST['listpagetitle'] = $listpagetitle;


$template = file_get_contents(TEMPLATEDETAILED);

fsave_w(str_replace_template($_POST,$template),$_POST['fname'].".html");

$lines = logregist();

fsave_array_w($lines,$log_file);

list_html(0,$lines);

if(TOPHTML){
toplist_html(0,$lines);
}


html(ok("情報登録完了").adminlist_bt());

break;


case 'renew':

$lines = file($log_file);
$data = dataget($_POST['fname'],$lines);

$dtypechkeck1 = "";
$dtypechkeck2 = "";
switch($data[3]) {
	case "新着情報":
		$dtypechkeck1 = "checked";
		break;
	case "イベント":
		$dtypechkeck2 = "checked";
		break;
	default:
		break;
}

$titlemax = TYTLEMAX / 2;
$commentmax = COMMENTMAX / 2;

$datedata = redate($data[2]);

include(INDEXPAGE);

html($index_html);
break;


case 'renewcheck':

check();

/*
if($htmlinput){

$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);

$_POST['checktitle'] = nl2br($_POST['title']);
$_POST['checkcomment'] = nl2br($_POST['comment']);

}else{

$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);

$_POST['checktitle'] = str_replace("\n", "<br>", $_POST['title']);
$_POST['checkcomment'] = str_replace("\n", "<br>", $_POST['comment']);

}
*/
$_POST['title'] = stripslashes($_POST['title']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$_POST['comment'] = stripslashes($_POST['comment']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$edit_search = array('<', '>','"');
$edit_replace = array('&lt;', '&gt;','&quot;');

$_POST['checktitle'] = str_replace($edit_search, $edit_replace, $_POST['title']);
$_POST['checktitle'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checktitle']);
$_POST['checkcomment'] = str_replace($edit_search, $edit_replace, $_POST['comment']);
$_POST['checkcomment'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkcomment']);

for($i=1;$i<=$upimage_setcnt;$i++) {
	if($_POST['imagedel'.$i] && !$_FILES['userfile'.$i]['name']){
		$imageurl[$i-1] = "";
	}elseif($_FILES['userfile'.$i]['name']){
		$imageurl[$i-1] = imageup($i);
	}else{
		if(trim($_POST['savefile'.$i])){
			$imagefile = $_POST['savefile'.$i];
			$imgsize = GetImageSize($images_dir.$imagefile);
			$viewsize = imagesizedivision($imgsize[0],$imgsize[1],$adminview_wsize,$adminview_hsize);
			$imageurl[$i-1] = imagelinktag($viewsize[4],$imagefile,"",$viewsize[3]);
		}else{
			$imageurl[$i-1] = "";
		}
	}
}


include(CHECKPAGE);

html($check_html);

break;


case 'renewend':

check();

/*
$_POST['title'] = strcode($_POST['title']);
$_POST['comment'] = strcode($_POST['comment']);
$_POST['title2'] = strcode($_POST['title']);

if($htmlinput){
	$_POST['title'] = str_replace("\r\n", "<br>", $_POST['title']);
	$_POST['title'] = str_replace("\r", "<br>", $_POST['title']);
	$_POST['title'] = str_replace("\n", "<br>", $_POST['title']);
	$_POST['comment'] = str_replace("\r\n", "<br>", $_POST['comment']);
	$_POST['comment'] = str_replace("\r", "<br>", $_POST['comment']);
	$_POST['comment'] = str_replace("\n", "<br>", $_POST['comment']);
}else{
	$_POST['title'] = str_replace("\r\n", "<!--br-->", $_POST['title']);
	$_POST['title'] = str_replace("\r", "<!--br-->", $_POST['title']);
	$_POST['title'] = str_replace("\n", "<!--br-->", $_POST['title']);
	$_POST['comment'] = str_replace("\r\n", "<!--br-->", $_POST['comment']);
	$_POST['comment'] = str_replace("\r", "<!--br-->", $_POST['comment']);
	$_POST['comment'] = str_replace("\n", "<!--br-->", $_POST['comment']);
}
*/

$edit_search = array('&lt;', '&gt;', '&quot;');
$edit_replace = array('<', '>','"');

$_POST['title'] = str_replace($edit_search, $edit_replace, $_POST['checktitle']);
$_POST['title'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checktitle']);
$_POST['comment'] = str_replace($edit_search, $edit_replace, $_POST['checkcomment']);
$_POST['comment'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkcomment']);


for($i=1;$i<=$upimage_setcnt;$i++) {
	if(trim($_POST['savefile'.$i])){
		if($_POST['imagedel'.$i]){
			@unlink($images_dir.$_POST['savefile'.$i]);
			@unlink($images_dir."thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."pc_thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."pct_thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."pcl_thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."smt_thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."sml_thumb".$_POST['savefile'.$i]);
			@unlink($images_dir."sm_thumb".$_POST['savefile'.$i]);
			$_POST['savefile'.$i] = "";
		}else{
			if(file_exists($imagestmp_dir.$_POST['savefile'.$i])){
				filemove($imagestmp_dir.$_POST['savefile'.$i], $images_dir.$_POST['savefile'.$i]);
				filemove($imagestmp_dir."thumb".$_POST['savefile'.$i], $images_dir."thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."pc_thumb".$_POST['savefile'.$i], $images_dir."pc_thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."pct_thumb".$_POST['savefile'.$i], $images_dir."pct_thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."pcl_thumb".$_POST['savefile'.$i], $images_dir."pcl_thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."smt_thumb".$_POST['savefile'.$i], $images_dir."smt_thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."sml_thumb".$_POST['savefile'.$i], $images_dir."sml_thumb".$_POST['savefile'.$i]);
				filemove($imagestmp_dir."sm_thumb".$_POST['savefile'.$i], $images_dir."sm_thumb".$_POST['savefile'.$i]);
			}
			$imgsize = GetImageSize($images_dir.$_POST['savefile'.$i]);
			$reducesize = imagesizedivision($imgsize[0],$imgsize[1],$view_wsize,$view_hsize);
			$_POST['image'.$i] = imagelinktag($reducesize[4],$_POST['savefile'.$i],$_POST['title'],$reducesize[3]);
		}
	}
}

$_POST['date'] = "[ ".$_POST['datedata'][0]."$dadedividing".$_POST['datedata'][1]."$dadedividing".$_POST['datedata'][2]." ]";

$_POST['listpagetitle'] = $listpagetitle;


$template = file_get_contents(TEMPLATEDETAILED);

fsave_w(str_replace_template($_POST,$template),$_POST['fname'].".html");

$lines = file($log_file);
$lines = list_html($_POST['fname'],$lines);


fsave_array_w($lines,$log_file);


if(TOPHTML){
	toplist_html(0,$lines);
}

html(ok("更新完了").adminlist_bt());

break;


case 'del':

$lines = file($log_file);

$data = dataget($_POST['fname'],$lines);

$_POST['title'] = $data[3];
//$imageurl[0] = $data[30];
//$imageurl[1] = $data[31];
//$imageurl[2] = $data[32];
//$imageurl[3] = $data[33];
//$imageurl[4] = $data[34];
for($i=0;$i<$upimage_setcnt;$i++) {
	$imageurl[$i] = $data[$i+300];
}
$_POST['checkcomment'] = $data[5];
$_POST['fname'] = $data[0];
//$_POST[savefile] = $data[1];
for($i=1;$i<=$upimage_setcnt;$i++) {
	$_POST['savefile'.$i] = $data[$i+5];
}


$titlemax = TYTLEMAX / 2;
$commentmax = COMMENTMAX / 2;

$_POST['datedata'] = redate($data[2]);

include(CHECKPAGE);

html($check_html);
break;


case 'delend':

@unlink($_POST['fname'].".html");

for($i=1;$i<=$upimage_setcnt;$i++) {
	if(trim($_POST['savefile'.$i])){
		@unlink($images_dir.$_POST['savefile'.$i]);
		@unlink($images_dir."thumb".$_POST['savefile'.$i]);
	}
}

$lines = log_del_save($_POST['fname'],$log_file);

list_html("",$lines);

if(TOPHTML){
toplist_html(0,$lines);
}

html(ok("削除完了").adminlist_bt());

break;


case 'regist':

$titlemax = TYTLEMAX / 2;
$commentmax = COMMENTMAX / 2;

$datedata = getdate();

$datedata['hours'] = str_pad($datedata['hours'], 2, '0', STR_PAD_LEFT);
$datedata['minutes'] = str_pad($datedata['minutes'], 2, '0', STR_PAD_LEFT);

include(INDEXPAGE);

html($index_html);
break;


case 'adminlist':

del_dir($imagestmp_dir);

//$lines = file($log_file);

/*
if(file_exists($htmlrenew_file)){
$html_list_renew_bt = listtoplist_renew_bt("並び順の変更後、最後にリストページのHTMLファイルを更新ください。");
}
*/

$linesall = file($log_file);

for($i=0,$j=0;$i<count($linesall);$i++){
	$data = explode("<>",$linesall[$i]);
	switch($_POST['dtype']){
		case "新着情報":
			if($data[3] == "1") {
				$lines[$j] = $linesall[$i];
				$j++;
			}
			break;
		case "イベント":
			if($data[3] == "2") {
				$lines[$j] = $linesall[$i];
				$j++;
			}
			break;
		default:
			$lines[$j] = $linesall[$i];
			$j++;
			break;
	}
}

html($html_list_renew_bt.adminlist_html(0,$lines));

if(TOPHTML){
toplist_html(0,$lines);
}
break;


default:
//$lines = file($log_file);
$linesall = file($log_file);

for($i=0,$j=0;$i<count($linesall);$i++){
	$data = explode("<>",$linesall[$i]);
	switch($_POST['dtype']){
		case "新着情報":
			if($data[3] == "1" || $data[3] == "共通") {
				$lines[$j] = $linesall[$i];
				$j++;
			}
			break;
		case "イベント":
			if($data[3] == "2" || $data[3] == "共通") {
				$lines[$j] = $linesall[$i];
				$j++;
			}
			break;
		default:
			$lines[$j] = $linesall[$i];
			$j++;
			break;
	}
}
html(adminlist_html(0,$lines));
break;
}


?>