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
	$_POST['name'] = $data[2];
	$_POST['floor'] = $data[3];
	$_POST['site'] = $data[4];
	$_POST['method'] = $data[5];
	$_POST['finish'] = $data[6];
	$_POST['address'] = $data[7];
	$_POST['point01'] = $data[8];
	$_POST['point02'] = $data[9];
	$_POST['point03'] = $data[10];
	$_POST['point04'] = $data[11];
	$_POST['point05'] = $data[12];


	for($i=1;$i<=$upimage_setcnt;$i++) {
		$_POST['savefile'.$i] = $data[$i+12];
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

fsave_w("1",$htmlrenew_file);

//$html_list_renew_bt = listtoplist_renew_bt("並び順の変更後、最後にリストページのHTMLファイルを更新ください。");

html($html_list_renew_bt.adminlist_html(0,$lines));

if(TOPHTML){
toplist_html(0,$lines);
}

break;


case 'check':

check();


$_POST['name'] = stripslashes($_POST['name']);
$_POST['floor'] = stripslashes($_POST['floor']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$_POST['site'] = stripslashes($_POST['site']);
$_POST['method'] = stripslashes($_POST['method']);
$_POST['address'] = stripslashes($_POST['address']);
$_POST['point01'] = stripslashes($_POST['point01']);
$_POST['point02'] = stripslashes($_POST['point02']);
$_POST['point03'] = stripslashes($_POST['point03']);
$_POST['point04'] = stripslashes($_POST['point04']);
$_POST['point05'] = stripslashes($_POST['point05']);

$edit_search = array('<', '>','"','\\"');
$edit_replace = array('&lt;', '&gt;','&quot;','&quot;');

$_POST['checkname'] = str_replace($edit_search, $edit_replace, $_POST['name']);
$_POST['checkname'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkname']);
$_POST['checkfloor'] = str_replace($edit_search, $edit_replace, $_POST['floor']);
$_POST['checkfloor'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkfloor']);
$_POST['checksite'] = str_replace($edit_search, $edit_replace, $_POST['site']);
$_POST['checksite'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checksite']);
$_POST['checkmethod'] = str_replace($edit_search, $edit_replace, $_POST['method']);
$_POST['checkmethod'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkmethod']);
$_POST['checkaddress'] = str_replace($edit_search, $edit_replace, $_POST['address']);
$_POST['checkaddress'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkaddress']);
$_POST['checkpoint01'] = str_replace($edit_search, $edit_replace, $_POST['point01']);
$_POST['checkpoint01'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint01']);
$_POST['checkpoint02'] = str_replace($edit_search, $edit_replace, $_POST['point02']);
$_POST['checkpoint02'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint02']);
$_POST['checkpoint03'] = str_replace($edit_search, $edit_replace, $_POST['point03']);
$_POST['checkpoint03'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint03']);
$_POST['checkpoint04'] = str_replace($edit_search, $edit_replace, $_POST['point04']);
$_POST['checkpoint04'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint04']);
$_POST['checkpoint05'] = str_replace($edit_search, $edit_replace, $_POST['point05']);
$_POST['checkpoint05'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint05']);

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


// check();


$edit_search = array('&lt;', '&gt;', '&quot;');
$edit_replace = array('<', '>','"');

$_POST['name'] = str_replace($edit_search, $edit_replace, $_POST['checkname']);
$_POST['name'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkname']);
$_POST['floor'] = str_replace($edit_search, $edit_replace, $_POST['checkfloor']);
$_POST['floor'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkfloor']);
$_POST['site'] = str_replace($edit_search, $edit_replace, $_POST['checksite']);
$_POST['site'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checksite']);
$_POST['method'] = str_replace($edit_search, $edit_replace, $_POST['checkmethod']);
$_POST['method'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkmethod']);
$_POST['address'] = str_replace($edit_search, $edit_replace, $_POST['checkaddress']);
$_POST['address'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkaddress']);
$_POST['point01'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint01']);
$_POST['point01'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint01']);
$_POST['point02'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint02']);
$_POST['point02'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint02']);
$_POST['point03'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint03']);
$_POST['point03'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint03']);
$_POST['point04'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint04']);
$_POST['point04'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint04']);
$_POST['point05'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint05']);
$_POST['point05'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint05']);

for($i=1;$i<=$upimage_setcnt;$i++) {
	if($_POST['savefile'.$i]){

		filemove($imagestmp_dir.$_POST['savefile'.$i], $images_dir.$_POST['savefile'.$i]);
		filemove($imagestmp_dir."thumb".$_POST['savefile'.$i], $images_dir."thumb".$_POST['savefile'.$i]);
		// filemove($imagestmp_dir."pct_thumb".$_POST['savefile'.$i], $images_dir."pct_thumb".$_POST['savefile'.$i]);
		// filemove($imagestmp_dir."pcl_thumb".$_POST['savefile'.$i], $images_dir."pcl_thumb".$_POST['savefile'.$i]);
		// filemove($imagestmp_dir."sml_thumb".$_POST['savefile'.$i], $images_dir."sml_thumb".$_POST['savefile'.$i]);
		// filemove($imagestmp_dir."sm_thumb".$_POST['savefile'.$i], $images_dir."sm_thumb".$_POST['savefile'.$i]);

		$imgsize = GetImageSize($images_dir.$_POST['savefile'.$i]);
		$reducesize = imagesizedivision($imgsize[0],$imgsize[1],$view_wsize,$view_hsize);
		$_POST['image'.$i] = imagelinktag($reducesize[4],$_POST['savefile'.$i],$_POST['title'],$reducesize[3]);

	}else{

		$imageurl = "";
	}
}


//$_POST['birthday'] = "[ ".$_POST['birthday']." ]";

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

$titlemax = TYTLEMAX / 2;
$commentmax = COMMENTMAX / 2;


include(INDEXPAGE);

html($index_html);
break;


case 'renewcheck':

check();

$_POST['name'] = stripslashes($_POST['name']);
$_POST['floor'] = stripslashes($_POST['floor']);	//PHPでクォーテーションが勝手にエスケープされてしまう 原因は magic_quotes_gpc = On
$_POST['site'] = stripslashes($_POST['site']);
$_POST['method'] = stripslashes($_POST['method']);
$_POST['address'] = stripslashes($_POST['address']);
$_POST['point01'] = stripslashes($_POST['point01']);
$_POST['point02'] = stripslashes($_POST['point02']);
$_POST['point03'] = stripslashes($_POST['point03']);
$_POST['point04'] = stripslashes($_POST['point04']);
$_POST['point05'] = stripslashes($_POST['point05']);

$edit_search = array('<', '>','"','\\"');
$edit_replace = array('&lt;', '&gt;','&quot;','&quot;');

$_POST['checkname'] = str_replace($edit_search, $edit_replace, $_POST['name']);
$_POST['checkname'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkname']);
$_POST['checkfloor'] = str_replace($edit_search, $edit_replace, $_POST['floor']);
$_POST['checkfloor'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkfloor']);
$_POST['checksite'] = str_replace($edit_search, $edit_replace, $_POST['site']);
$_POST['checksite'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checksite']);
$_POST['checkmethod'] = str_replace($edit_search, $edit_replace, $_POST['method']);
$_POST['checkmethod'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkmethod']);
$_POST['checkaddress'] = str_replace($edit_search, $edit_replace, $_POST['address']);
$_POST['checkaddress'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkaddress']);
$_POST['checkpoint01'] = str_replace($edit_search, $edit_replace, $_POST['point01']);
$_POST['checkpoint01'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint01']);
$_POST['checkpoint02'] = str_replace($edit_search, $edit_replace, $_POST['point02']);
$_POST['checkpoint02'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint02']);
$_POST['checkpoint03'] = str_replace($edit_search, $edit_replace, $_POST['point03']);
$_POST['checkpoint03'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint03']);
$_POST['checkpoint04'] = str_replace($edit_search, $edit_replace, $_POST['point04']);
$_POST['checkpoint04'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint04']);
$_POST['checkpoint05'] = str_replace($edit_search, $edit_replace, $_POST['point05']);
$_POST['checkpoint05'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint05']);


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

// check();



$edit_search = array('&lt;', '&gt;', '&quot;');
$edit_replace = array('<', '>','"');

$_POST['name'] = str_replace($edit_search, $edit_replace, $_POST['checkname']);
$_POST['name'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkname']);
$_POST['floor'] = str_replace($edit_search, $edit_replace, $_POST['checkfloor']);
$_POST['floor'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkfloor']);
$_POST['site'] = str_replace($edit_search, $edit_replace, $_POST['checksite']);
$_POST['site'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checksite']);
$_POST['method'] = str_replace($edit_search, $edit_replace, $_POST['checkmethod']);
$_POST['method'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkmethod']);
$_POST['address'] = str_replace($edit_search, $edit_replace, $_POST['checkaddress']);
$_POST['address'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkaddress']);
$_POST['point01'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint01']);
$_POST['point01'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint01']);
$_POST['point02'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint02']);
$_POST['point02'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint02']);
$_POST['point03'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint03']);
$_POST['point03'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint03']);
$_POST['point04'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint04']);
$_POST['point04'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint04']);
$_POST['point05'] = str_replace($edit_search, $edit_replace, $_POST['checkpoint05']);
$_POST['point05'] = str_replace(array("\r\n","\r","\n"), "", $_POST['checkpoint05']);


for($i=1;$i<=$upimage_setcnt;$i++) {
	if(trim($_POST['savefile'.$i])){
		if($_POST['imagedel'.$i]){
			@unlink($images_dir.$_POST['savefile'.$i]);
			@unlink($images_dir."thumb".$_POST['savefile'.$i]);
			// @unlink($images_dir."pct_thumb".$_POST['savefile'.$i]);
			// @unlink($images_dir."pcl_thumb".$_POST['savefile'.$i]);
			// @unlink($images_dir."sml_thumb".$_POST['savefile'.$i]);
			// @unlink($images_dir."sm_thumb".$_POST['savefile'.$i]);
			$_POST['savefile'.$i] = "";
		}else{
			if(file_exists($imagestmp_dir.$_POST['savefile'.$i])){
				filemove($imagestmp_dir.$_POST['savefile'.$i], $images_dir.$_POST['savefile'.$i]);
				filemove($imagestmp_dir."thumb".$_POST['savefile'.$i], $images_dir."thumb".$_POST['savefile'.$i]);
				// filemove($imagestmp_dir."pct_thumb".$_POST['savefile'.$i], $images_dir."pct_thumb".$_POST['savefile'.$i]);
				// filemove($imagestmp_dir."pcl_thumb".$_POST['savefile'.$i], $images_dir."pcl_thumb".$_POST['savefile'.$i]);
				// filemove($imagestmp_dir."sml_thumb".$_POST['savefile'.$i], $images_dir."sml_thumb".$_POST['savefile'.$i]);
				// filemove($imagestmp_dir."sm_thumb".$_POST['savefile'.$i], $images_dir."sm_thumb".$_POST['savefile'.$i]);
			}
			$imgsize = GetImageSize($images_dir.$_POST['savefile'.$i]);
			$reducesize = imagesizedivision($imgsize[0],$imgsize[1],$view_wsize,$view_hsize);
			$_POST['image'.$i] = imagelinktag($reducesize[4],$_POST['savefile'.$i],$_POST['title'],$reducesize[3]);
		}
	}
}

//$_POST['birthday'] = "[ ".$_POST['birthday']." ]";
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

$_POST['name'] = $data[2];
$_POST['floor'] = $data[3];
$_POST['site'] = $data[4];
$_POST['method'] = $data[5];
$_POST['address'] = $data[7];
$_POST['point01'] = $data[8];
$_POST['point02'] = $data[9];
$_POST['point03'] = $data[10];
$_POST['point04'] = $data[11];
$_POST['point05'] = $data[12];

for($i=0;$i<$upimage_setcnt;$i++) {
	$imageurl[$i] = $data[$i+300];
}
$_POST['fname'] = $data[0];
//$_POST[savefile] = $data[1];
for($i=1;$i<=$upimage_setcnt;$i++) {
	$_POST['savefile'.$i] = $data[$i+12];
}


$titlemax = TYTLEMAX / 2;
$commentmax = COMMENTMAX / 2;

$_POST['finish'] = $data[6];
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

$linesall = file($log_file);

$lines = array();
if($_POST['dog_breed']) {
	for($i=0;$i<count($linesall);$i++){
		$data = explode("<>",$linesall[$i]);
    	$catename= explode("<>",$_POST['dog_breed']);
		if($data[3] == $catename[0]) {
			$lines[] = $linesall[$i];
		}
	}
} else {
	$lines = file($log_file);
}


// for($i=0,$j=0;$i<count($linesall);$i++){
// 	$data = explode("<>",$linesall[$i]);
// 	$lines[$j] = $linesall[$i];
// 	switch($_POST['dtype']){
// 		case "ワイマラナー":
// 			if($data[3] == "ワイマラナー") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		case "柴犬":
// 			if($data[3] == "柴犬") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		default:
// 			$lines[$j] = $linesall[$i];
// 			$j++;
// 			break;
// 	}
// }

// for($i=0,$j=0;$i<count($linesall);$i++){
// 	$data = explode("<>",$linesall[$i]);
// 	$lines[$j] = $linesall[$i];
// 	switch($_POST['soldout']){
// 		case "新しい家族ができました":
// 			if($data[10] == "新しい家族ができました") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		default:
// 			$lines[$j] = $linesall[$i];
// 			$j++;
// 			break;
// 	}
// }

// var_dump($lines);
html($html_list_renew_bt.adminlist_html(0,$lines));

if(TOPHTML){
toplist_html(0,$lines);
}
break;


default:
//$lines = file($log_file);
$linesall = file($log_file);

$lines = array();
if($_POST['dog_breed']) {
	for($i=0;$i<count($linesall);$i++){
		$data = explode("<>",$linesall[$i]);
    	$catename= explode("<>",$_POST['dog_breed']);
		if($data[3] == $catename[0]) {
			$lines[] = $linesall[$i];
		}
	}
} else {
	$lines = file($log_file);
}

// for($i=0,$j=0;$i<count($linesall);$i++){
// 	$data = explode("<>",$linesall[$i]);
// 	switch($_POST['dtype']){
// 		case "ワイマラナー":
// 			if($data[3] == "ワイマラナー") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		case "柴犬":
// 			if($data[3] == "柴犬") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		default:
// 			$lines[$j] = $linesall[$i];
// 			$j++;
// 			break;
// 	}
// }


// for($i=0,$j=0;$i<count($linesall);$i++){
// 	$data = explode("<>",$linesall[$i]);
// 	$lines[$j] = $linesall[$i];
// 	switch($_POST['soldout']){
// 		case "新しい家族ができました":
// 			if($data[10] == "新しい家族ができました") {
// 				$lines[$j] = $linesall[$i];
// 				$j++;
// 			}
// 			break;
// 		default:
// 			$lines[$j] = $linesall[$i];
// 			$j++;
// 			break;
// 	}
// }

html(adminlist_html(0,$lines));
break;
}


?>