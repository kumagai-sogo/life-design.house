<?php
//曜日取得
function get_wday($day) {

	$day = str_replace(array("-","/"),"",$day);
	$date = getdate(mktime(0, 0, 0, substr($day,4,2), substr($day,6,2), substr($day,0,4)));
	return $date['wday'];
}

//時間計算 hh:MM⇒hh:MM
function computeTime($time, $addmin) {
		$baseSec = mktime(substr($time,0,2), substr($time,3,2), 0, date('m'), date('d'), date('Y'));//基準日を秒で取得
		$addSec = $addmin * 60;//日数×１日の秒数
		$targetSec = $baseSec + $addSec;
		$ret = date("H:i", $targetSec);
		if($time >= "24:00" || ($addmin >= 0 && $time > $ret)) {
			$ret = substr($ret,0,2)+24 . substr($ret,2,3);
		}
		return $ret;
}
//日付計算 yyyymmdd⇒yyyymmdd
function computeDate($day, $addDays) {
		$baseSec = mktime(0, 0, 0, substr($day,4,2), substr($day,6,2), substr($day,0,4));//基準日を秒で取得
		$addSec = $addDays * 86400;//日数×１日の秒数
		$targetSec = $baseSec + $addSec;
		return date("Ymd", $targetSec);
}
//日付計算１ yyyy,mm,dd⇒yyyymmdd
function computeDate1($year, $month, $day, $addDays) {
		$baseSec = mktime(0, 0, 0, $month, $day, $year);//基準日を秒で取得
		$addSec = $addDays * 86400;//日数×１日の秒数
		$targetSec = $baseSec + $addSec;
		return date("Ymd", $targetSec);
}

//日付計算２ yyyy,mm,dd⇒yyyy/mm/dd hh:mm:ss
function computeDate2($year, $month, $day, $addDays, $delimiter="") {
		$baseSec = mktime(0, 0, 0, $month, $day, $year);//基準日を秒で取得
		$addSec = $addDays * 86400;//日数×１日の秒数
		$targetSec = $baseSec + $addSec;
		$ret = date("Y-m-d H:i:s", $targetSec);
		if("" != $delimiter) {
			$ret = str_replace("-",$delimiter,$ret);
		}
		return $ret;
}

//日付計算３ yyyy,mm,dd⇒yyyy/mm/dd
function computeDate3($year, $month, $day, $addDays, $delimiter="") {
		$baseSec = mktime(0, 0, 0, $month, $day, $year);//基準日を秒で取得
		$addSec = $addDays * 86400;//日数×１日の秒数
		$targetSec = $baseSec + $addSec;
		$ret = date("Y-m-d", $targetSec);
		if("" != $delimiter) {
			$ret = str_replace("-",$delimiter,$ret);
		}
		return $ret;
}

//日付計算４
/**
 * 2つの日付の差を求める関数
 * $year1 1つのめ日付の年
 * $month1 1つめの日付の月
 * $day1 1つめの日付の日
 * $year2 2つのめ日付の年
 * $month2 2つめの日付の月
 * $day2 2つめの日付の日
 */
function compareDateDiff($year1, $month1, $day1, $year2, $month2, $day2) {
		$dt1 = mktime(0, 0, 0, $month1, $day1, $year1);
		$dt2 = mktime(0, 0, 0, $month2, $day2, $year2);
		$diff = $dt1 - $dt2;
		$diffDay = $diff / 86400;//1日は86400秒
		return $diffDay;
}

/**
 * 年月を指定して月末日を求める関数
 * $year 年
 * $month 月
 */
function getMonthEndDay($year, $month) {
		//mktime関数で日付を0にすると前月の末日を指定したことになります
		//$month + 1 をしていますが、結果13月のような値になっても自動で補正されます
		$dt = mktime(0, 0, 0, $month + 1, 0, $year);
		return date("d", $dt);
}
//日付データ変換 yyyy/mm/dd⇒dt
function chageDateDt($date) {
		$date = str_replace("-","/",$date);
		list($year,$month,$day) = explode("/",$date);
		$dt = mktime(0, 0, 0, $month, $day, $year);
		return $dt;
}

/////////////////////////////////////////////////////////////
//テンプレート読込
function load_template ($file){
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$i = 0;
	while(! feof($fp)) {
		$temp = fgets($fp);
		$temp_array[$i] .= $temp;
		if(strpos($temp, "<!--repeat-->") !== false) {
			$i++;
		}
	}
	fclose($fp);

	return $temp_array;
}

//テンプレート読込
function load_template2($file){
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$template = "";
	while(! feof($fp)) {
		$template .= fgets($fp);
	}
	fclose($fp);

	return $template;
}

//テンプレート読込
function load_template3 ($file){
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$i = 0;
	while(! feof($fp)) {
		$temp = fgets($fp);
		$temp_array[$i] .= $temp;
		if(strpos($temp, "<!--repeat-->") !== false) {
			$i++;
		}
		if(strpos($temp, "<!--repeat2-->") !== false) {
			$i++;
		}
	}
	fclose($fp);

	return $temp_array;
}

//テンプレート読込TOP
function load_template_top ($file){
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$i = 0;
	while(! feof($fp)) {
		$temp = fgets($fp);
		$temp_array[$i] .= $temp;
		if(strpos($temp, "<!--repeat_pickup-->") !== false) {
			$i++;
		}
		if(strpos($temp, "<!--repeat_gal-->") !== false) {
			$i++;
		}
	}
	fclose($fp);

	return $temp_array;
}

function echotimes($chard){
	$mil = (float)microtime();
	$mil = $mil * 100;
	$mil = sprintf('%3d', $mil);
	echo $chard . date('H:i:s.').$mil . "<br>";
}

function fhotochg($width, $height, $images, $savename, $type){
// 出力する画像サイズの指定
 //$width = 142;
 //$height = 200;

// サイズを指定して、背景用画像を生成
 $canvas = imagecreatetruecolor($width, $height);

// コピー元画像の指定
 $targetImage = $images;
 // ファイル名から、画像インスタンスを生成
$file_name = explode(".",substr($targetImage,-15));

//print_r($file_name);
if($file_name[1] == "jpg" || $file_name[1] == "JPG" || $file_name[1] == "jpeg" || $file_name[1] == "JPEG") {
 $image = imagecreatefromjpeg($targetImage);
}
else if($file_name[1] == "png" || $file_name[1] == "JPG") {
 $image = imagecreatefrompng($targetImage);
}
else {
 $image = imagecreatefromgif($targetImage);
}
 //$image = imagecreatefromjpeg($targetImage);
 // コピー元画像のファイルサイズを取得
 list($image_w, $image_h) = getimagesize($targetImage);

// 背景画像に、画像をコピーする
 imagecopyresampled($canvas,	// 背景画像
										$image, 	// コピー元画像
										0,				// 背景画像の x 座標
										0,				// 背景画像の y 座標
										0,				// コピー元の x 座標
										0,				// コピー元の y 座標
										$width, 	// 背景画像の幅
										$height,	// 背景画像の高さ
										$image_w, // コピー元画像ファイルの幅
										$image_h	// コピー元画像ファイルの高さ
									 );

// 画像を出力する
if($file_name[1] == "jpg" || $file_name[1] == "JPG" || $file_name[1] == "jpeg" || $file_name[1] == "JPEG") {
		imagejpeg($canvas, 					// 背景画像
							 $savename, 	 // 出力するファイル名（省略すると画面に表示する）
							 100								// 画像精度（この例だと100%で作成）
							);
}
else if($file_name[1] == "png" || $file_name[1] == "JPG") {
		imagepng($canvas,					 // 背景画像
							 $savename, 	 // 出力するファイル名（省略すると画面に表示する）
							 100								// 画像精度（この例だと100%で作成）
							);
}
else {
		imagegif($canvas,					 // 背景画像
							 $savename, 	 // 出力するファイル名（省略すると画面に表示する）
							 100								// 画像精度（この例だと100%で作成）
							);
}

// メモリを開放する
 imagedestroy($canvas);
}

function timeptnms($rtime) {
	require('common.php');

	$chktime = substr($rtime,0,2);
	if(intval($chktime) >= 24) {
		$chktime = intval($chktime - 24);
	}
	$chktime .= substr($rtime,3,2);
	$chktime = intval($chktime);

	for($i=0;$i<@count($timeptnms);$i++) {
		if($timeptnms[$i][0] <= $chktime && $timeptnms[$i][1] >= $chktime) {
			$ptn = $timeptnms[$i][2];
			break;
		}
	}
	return $ptn;
}


/////////////////////////////////
//NEWS（トピックス）
function news_get($file,$newsday = "") {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$dttm = explode(" ",$fdata[2]);
		$idNo = $dttm[0];
		if($newsday && $newsday != $idNo) continue;
		$dd = explode("/",$dttm[0]);
		$tt = explode(":",$dttm[1]);
		$newslist[$tcnt] = array(	"dname" => $fdata[0],
									"year" =>	$dd[0],
									"month" =>	$dd[1],
									"day" =>	$dd[2],
									"hour" =>	$tt[0],
									"min" =>	$tt[1],
									"dtype" =>	$fdata[3],
									"title" =>	$fdata[4],
									"content" =>	$fdata[5],
									"simg" =>	$fdata[6],);
		$tcnt++;
		//
		if($newsday) break;
	}
	fclose($fp);

	return $newslist;
}

//NEWS（トピックス）
function news_get2($newsday = "") {
	require('common.php');

	//全ファイル
	$lines = file($news_log_file);
	$cnt = 0;
	$setcnt = 0;
	for($i=0;$i<@count($lines);$i++){

		$data = explode("<>",$lines[$i]);
		$dname = $data[0];
		$date = $data[2];
		$daytime = explode(" ",$date);
		$days = explode("/",$daytime[0]);
		$times = explode(":",$daytime[1]);
		$dtype = $data[3];
		$title = $data[4];
		$content = $data[5];
		$savefile = $data[6];
		if($newsday && $newsday != $dname) continue;
		//
		$newslist[$cnt] = array("dname" => $dname,
								"title" =>	$title,
								"year" =>	$days[0],
								"month" =>	$days[1],
								"day" =>	$days[2],
								"hour" =>	$times[0],
								"min" =>	$times[1],
								"simg" =>	$savefile,
								"dtype" =>	$dtype,
								"content" =>	$content);
		$cnt++;
		//
		if($newsday) break;
	}

	return $newslist;
}
/////////////////////////////////
//NEWS

function news_edit_no($logdir, $tempbody, $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$news = news_get($logdir);

	$template = "";
	for($i=0;$i<@count($news);$i++) {
		if((empty($no)) || $news[$i]['dname'] == $no) {
			$template .= $tempbody;
			if($news[$i]['simg']) {
				$template = str_replace("<!--images-->", $news_image_dir.$news[$i]['simg'], $template);
			} else {
				$template = str_replace("<!--images-->", "", $template);
			}

			if($news[$i]['dtype'] === "新着情報") {
				$template = str_replace("<!--dtype-->", "新着情報", $template);
			} else {
				$template = str_replace("<!--dtype-->", "イベント", $template);
			}

			$date = sprintf("%04d/%02d/%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
			$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
			$template = str_replace("<!--links-->", $news_html."?no=".$news[$i]['dname'], $template);
			// $template = str_replace("<!--links-->", $news[$i]['dname'], $template);
			$template = str_replace("<!--year-->", $news[$i]['year'], $template);
			$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
			$template = str_replace("<!--days-->", $news[$i]['day'], $template);
			$template = str_replace("<!--date-->",$date, $template);
			$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
			$template = str_replace("<!--title-->", $news[$i]['title'], $template);
			$template = str_replace("<!--content-->", $news[$i]['content'], $template);

			$setcnt++;
			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}

	return $template;
}


function news_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$news = news_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($news);$i++) {
		$template .= $tempbody;
		if($news[$i]['simg']) {
			$template = str_replace("<!--images-->", $news_image_dir.$headtag.$news[$i]['simg'], $template);
		}
		else {
			$template = str_replace("<!--images-->", "", $template);
		}
		$date = sprintf("%04d/%02d/%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
		$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
		$template = str_replace("<!--links-->", $news_html."?no=".$news[$i]['dname'], $template);
		// $template = str_replace("<!--links-->", $news[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $news[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
		$template = str_replace("<!--days-->", $news[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
		$template = str_replace("<!--title-->", $news[$i]['title'], $template);
		$template = str_replace("<!--content-->", $news[$i]['content'], $template);

		$setcnt++;
		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}

/////////////////////////////////
//NEWS
function news_editdatailes($logdir, $tempbody, $no) {
	require('common.php');

	$news = news_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($news);$i++) {
		if($news[$i]['dname'] == $no) {
			$template .= $tempbody;
			if($news[$i]['simg']) {
				$template = str_replace("<!--images-->", $news_image_dir."pc_thumb".$news[$i]['simg'], $template);
			}  else {
				$template = str_replace("<!--images-->", "", $template);
			}

	if($news['dtype'] === "新着情報") {
		$template = str_replace("<!--dtype-->", "新着情報", $template);
	} else {
		$template = str_replace("<!--dtype-->", "イベント", $template);
	}

			$date = sprintf("%04d-%02d-%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
			$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
			$template = str_replace("<!--links-->", $news[$i]['dname'], $template);
			$template = str_replace("<!--year-->", $news[$i]['year'], $template);
			$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
			$template = str_replace("<!--days-->", $news[$i]['day'], $template);
			$template = str_replace("<!--date-->",$date, $template);
			$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
			$template = str_replace("<!--title-->", $news[$i]['title'], $template);
			$template = str_replace("<!--content-->", $news[$i]['content'], $template);
			break;
		}
	}

	return $template;
}

/////////////////////////////////
//NEWSPAGE
function news_pageedit($logdir, $tempbody, $tempspace, $page=1) {
	require('common.php');

	$news = news_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=($page-1) * NEWS_PAGEMAXCNT;$i<@count($news);$i++) {
		if(0 != $setcnt && $setcnt % NEWS_MAXLINECNT== 0) {
			$template .= $tempspace;
		}
		$template .= $tempbody;
		if($news[$i]['simg']) {
			$template = str_replace("<!--images-->", $news_image_dir."pcl_thumb".$news[$i]['simg'], $template);
		}
		else {
			$template = str_replace("<!--images-->", "", $template);
		}
		$date = sprintf("%04d-%02d-%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
		$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
		$template = str_replace("<!--links-->", $news[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $news[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
		$template = str_replace("<!--days-->", $news[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
		$template = str_replace("<!--title-->", $news[$i]['title'], $template);
		$template = str_replace("<!--content-->", $news[$i]['content'], $template);

		$setcnt++;
		if($setcnt >= NEWS_PAGEMAXCNT) break;
	}

	return $template;
}

/////////////////////////////////
//NEWS（トピックス）
function news_edit_date($logdir, $tempbody, $newsday = "", $ym="") {
	require('common.php');

	$newslist = news_get($logdir,$newsday);

	if("" == $newsday && "" != $ym) {
		for($i=0;$i<@count($newslist);$i++) {
			if($ym == sprintf("%04d%02d",$newslist[$i]['year'],$newslist[$i]['month'])) {
				$news = $newslist[$i];
				break;
			}
		}
	} else {
		$news = $newslist[0];
	}

	$template = $tempbody;
	if($news['simg']) {
		$template = str_replace("<!--images-->", $news_images, $template);
		$template = str_replace("<!--images-->", $logdir.$news['simg'], $template);
	}
	else {
		$template = str_replace("<!--images-->", "", $template);
	}
	$date = sprintf("%04d/%02d/%02d",$news['year'],$news['month'],$news['day']);
	$ym = sprintf("%04d%02d",$news['year'],$news['month']);
	$template = str_replace("<!--links-->", $news['dname'], $template);
	$template = str_replace("<!--ym-->", $ym, $template);
	$template = str_replace("<!--title-->", $news['title'], $template);
	$template = str_replace("<!--year-->", $news['year'], $template);
	$template = str_replace("<!--month-->", sprintf("%d",$news['month']), $template);
	$template = str_replace("<!--days-->", $news['day'], $template);
	$template = str_replace("<!--date-->",$date, $template);
	$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
	$template = str_replace("<!--content-->", $news['content'], $template);

	return $template;
}
/////////////////////////////////
//NEWS（トピックス）
function news_edit_date2($tempbody, $newsday = "", $ym="") {
	require('common.php');

	$newslist = news_get2($newsday);
	if("" == $newsday && "" != $ym) {
		for($i=0;$i<@count($newslist);$i++) {
			if($ym == sprintf("%04d%02d",$newslist[$i]['year'],$newslist[$i]['month'])) {
				$news = $newslist[$i];
				break;
			}
		}
	} else {
		$news = $newslist[0];
	}

	$template = $tempbody;
	if($news['simg']) {
		$template = str_replace("<!--images-->", $news_images, $template);
		$template = str_replace("<!--images-->", $news_image_dir."pct_thumb".$news['simg'], $template);
		//$template = str_replace("<!--images-->", $news_image_dir."pc_thumb".$news['simg'], $template);
		$template = str_replace("<!--smimages-->", $news_images, $template);
		$template = str_replace("<!--images-->", $news_image_dir."sm_thumb".$news['simg'], $template);
	}  else {
		$template = str_replace("<!--images-->", "", $template);
	}

	if($news['dtype'] === "新着情報") {
		$template = str_replace("<!--dtype-->", "新着情報", $template);
	} else {
		$template = str_replace("<!--dtype-->", "イベント", $template);
	}

	$date = sprintf("%04d/%02d/%02d",$news['year'],$news['month'],$news['day']);
	$ym = sprintf("%04d%02d",$news['year'],$news['month']);
	// $template = str_replace("<!--links-->", $news['dname'], $template);
	$news_html = "info_detail.html";
	$template = str_replace("<!--links-->", $news_html."?no=".$news['dname'], $template);
	$template = str_replace("<!--ym-->", $ym, $template);
	$template = str_replace("<!--title-->", $news['title'], $template);
	$template = str_replace("<!--year-->", $news['year'], $template);
	$template = str_replace("<!--month-->", sprintf("%d",$news['month']), $template);
	$template = str_replace("<!--days-->", $news['day'], $template);
	$template = str_replace("<!--date-->",$date, $template);
	$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
	$template = str_replace("<!--content-->", $news['content'], $template);

	return $template;
}


/////////////////////////////////
//NEWS月
function news_monthedit($logdir, $tempbody, $ym="") {
	require('common.php');

	$newslist = news_get($logdir);

	//if("" == $ym) $ym = date('Ym');

	$setcnt = 0;
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);
		if("" == $ym) {
			$ym = $workyymm;
		}

		//if("" != $ym && $ym != $workyymm) {
		if($ym != $workyymm) {
			continue;
		}

		$template .= news_edit_date2($tempbody, $newslist[$i]['dname']);

		$setcnt++;
	}

	return $template;
}

/////////////////////////////////
//NEWS月
function news_ymlist($logdir, $temphead, $tempbody, $tempfoot, $ym, $type="") {
	require('common.php');

	$newslist = news_get($logdir);

	if("" == $ym) {
		$thisyear = date('Y');
	} else {
		$thisyear = substr($ym,0,4);
	}

	$template = "";
	$workmm = "";
	$monthset = false;
	$setyaer = "";
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);
		if($thisyear == $newslist[$i]['year']) {
			if(!$monthset) {
				$tmp = $temphead;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$template .= $tmp;
			}
			if($workmm != $newslist[$i]['month']) {
				$workmm = $newslist[$i]['month'];
				$tmp = $tempbody;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$tmp = str_replace("<!--yymm-->", sprintf("%d年%d月",$newslist[$i]['year'],$newslist[$i]['month']), $tmp);
					$tmp = str_replace("<!--links-->", " onclick=news_month(".$workyymm.")", $tmp);
				$template .= $tmp;
				$monthset = true;
			}
		} else {
			if($monthset) {
				$template .= $tempfoot;
				$monthset = false;
			}
			if($setyaer != $newslist[$i]['year']) {
				$tmp = $temphead;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$template .= $tmp;
				$setyaer = $newslist[$i]['year'];
			}
			if($workmm != $newslist[$i]['month']) {
				$workmm = $newslist[$i]['month'];
				$tmp = $tempbody;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$tmp = str_replace("<!--yymm-->", sprintf("%d年%d月",$newslist[$i]['year'],$newslist[$i]['month']), $tmp);
				$tmp = str_replace("<!--links-->", " onclick=news_month(".$workyymm.")", $tmp);
				$template .= $tmp;
				$monthset = true;
			}
		}
	}
	if($monthset) {
		$template .= $tempfoot;
		$monthset = false;
	}
	//$tempbody = str_replace("<!--yearlist-->", $template, $tempbody);

	return $template;
}

/////////////////////////////////
//NEWS月
function news_monthedit2($tempbody, $ym="") {
	require('common.php');

	$newslist = news_get2();

	if("" == $ym) $ym = date('Ym');

	$setcnt = 0;
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);

		if($ym != $workyymm) {
			continue;
		}

		$template[$setcnt] = news_edit_date2($tempbody, $newslist[$i]['dname'],$ym);

		$setcnt++;
	}

	return $template;
}

/////////////////////////////////
//NEWS当月より以前の月
function news_ymlist2($tempbody, $ym, $type="") {
	require('common.php');

	$newslist = news_get2();

	if("" == $ym) {
		$thisyear = date('Y');
	} else {
		$thisyear = substr($ym,0,4);
	}

	$template = "";
	$template2 = "";
	$template3 = "";
	$workmm = "";
	$monthset = false;
	$setyaer = "";
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);
		if($thisyear == $newslist[$i]['year']) {
			if(!$monthset) {
				$tmp = $thisyear_tag;
				$template .= str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$template .= $monthlist_tag_h;
				$tmp = $thisyear_tag;
				$template2 .= str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$template2 .= $monthlist_tag_h;

				$tmp = $thisyear_tag_sm;
				$template3 .= str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$template3 .= $monthlist_tag_h;
			}
			if($workmm != $newslist[$i]['month']) {
				$workmm = $newslist[$i]['month'];
				$tmp = $monthlist_tag_b;
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$template .= $tmp;
				$tmp = $monthlist_tag_b;
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$template2 .= $tmp;
				$monthset = true;

				$tmp = $monthlist_tag_sm;
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$template3 .= $tmp;
			}
		} else {
			if($monthset) {
				$template .= $monthlist_tag_f;
				$monthset = false;
			}
			if($setyaer != $newslist[$i]['year']) {
				$tmp = $yearlist_tag;
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$template .= $tmp;
				$setyaer = $newslist[$i]['year'];
				$tmp = $yearlist_tag;
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$template3 .= $tmp;
			}
		}
	}
	if($monthset) {
		$template .= $monthlist_tag_f;
	}
	$tempbody = str_replace("<!--listyear-->", $template, $tempbody);
	$tempbody = str_replace("<!--tlistyear-->", $template2, $tempbody);
	$tempbody = str_replace("<!--rlistyear-->", $template3, $tempbody);

	return $tempbody;
}


//INFO（トピックス）
function info_get2($newsday = "") {
	require('common.php');

	//全ファイル
	$lines = file($info_log_file);
	$cnt = 0;
	$setcnt = 0;
	for($i=0;$i<@count($lines);$i++){

		$data = explode("<>",$lines[$i]);
		$dname = $data[0];
		$date = $data[2];
		$daytime = explode(" ",$date);
		$days = explode("/",$daytime[0]);
		$times = explode(":",$daytime[1]);
		$dtype = $data[3];
		$title = $data[4];
		$content = $data[5];
		$savefile = $data[6];
		if($newsday && $newsday != $dname) continue;
		//
		$newslist[$cnt] = array("dname" => $dname,
								"title" =>	$title,
								"year" =>	$days[0],
								"month" =>	$days[1],
								"day" =>	$days[2],
								"hour" =>	$times[0],
								"min" =>	$times[1],
								"simg" =>	$savefile,
								"dtype" =>	$dtype,
								"content" =>	$content);
		$cnt++;
		//
		if($newsday) break;
	}

	return $newslist;
}

/////////////////////////////////
//INFO（トピックス）
function info_edit_date2($tempbody, $newsday = "", $ym="") {
	require('common.php');

	$newslist = info_get2($newsday);
	if("" == $newsday && "" != $ym) {
		for($i=0;$i<@count($newslist);$i++) {
			if($ym == sprintf("%04d%02d",$newslist[$i]['year'],$newslist[$i]['month'])) {
				$news = $newslist[$i];
				break;
			}
		}
	} else {
		$news = $newslist[0];
	}

	$template = $tempbody;
	if($news['simg']) {
		$template = str_replace("<!--images-->", $news_images, $template);
		$template = str_replace("<!--images-->", $info_image_dir."pct_thumb".$news['simg'], $template);
		//$template = str_replace("<!--images-->", $info_image_dir."pc_thumb".$news['simg'], $template);
		$template = str_replace("<!--smimages-->", $news_images, $template);
		$template = str_replace("<!--images-->", $info_image_dir."sm_thumb".$news['simg'], $template);
	}  else {
		$template = str_replace("<!--images-->", "", $template);
	}

	if($news['dtype'] === "新着情報") {
		$template = str_replace("<!--dtype-->","<h3 class=\"info_news\">新着情報</h3>", $template);
	} else {
		$template = str_replace("<!--dtype-->","<h3 class=\"info_event\">イベント</h3>", $template);
	}

	$date = sprintf("%04d/%02d/%02d",$news['year'],$news['month'],$news['day']);
	$ym = sprintf("%04d%02d",$news['year'],$news['month']);
	// $template = str_replace("<!--links-->", $news['dname'], $template);
	$news_html = "info_detail.html";
	$template = str_replace("<!--links-->", $news_html."?no=".$news['dname'], $template);
	$template = str_replace("<!--ym-->", $ym, $template);
	$template = str_replace("<!--title-->", $news['title'], $template);
	$template = str_replace("<!--year-->", $news['year'], $template);
	$template = str_replace("<!--month-->", sprintf("%d",$news['month']), $template);
	$template = str_replace("<!--days-->", $news['day'], $template);
	$template = str_replace("<!--date-->",$date, $template);
	$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
	$template = str_replace("<!--content-->", $news['content'], $template);

	return $template;
}

/////////////////////////////////
//INFO月
function info_monthedit($logdir, $tempbody, $ym="") {
	require('common.php');

	$newslist = news_get($logdir);

	//if("" == $ym) $ym = date('Ym');

	$setcnt = 0;
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);
		if("" == $ym) {
			$ym = $workyymm;
		}

		//if("" != $ym && $ym != $workyymm) {
		if($ym != $workyymm) {
			continue;
		}

		$template .= info_edit_date2($tempbody, $newslist[$i]['dname']);

		$setcnt++;
	}

	return $template;
}

/////////////////////////////////
//INFO月
function info_ymlist($logdir, $temphead, $tempbody, $tempfoot, $ym, $type="") {
	require('common.php');

	$newslist = news_get($logdir);

	if("" == $ym) {
		$thisyear = date('Y');
	} else {
		$thisyear = substr($ym,0,4);
	}

	$template = "";
	$workmm = "";
	$monthset = false;
	$setyaer = "";
	for($i=0;$i<@count($newslist);$i++) {
		$workyymm = sprintf("%04d%02d", $newslist[$i]['year'],$newslist[$i]['month']);
		if($thisyear == $newslist[$i]['year']) {
			if(!$monthset) {
				$tmp = $temphead;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$template .= $tmp;
			}
			if($workmm != $newslist[$i]['month']) {
				$workmm = $newslist[$i]['month'];
				$tmp = $tempbody;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$tmp = str_replace("<!--yymm-->", sprintf("%d年%d月",$newslist[$i]['year'],$newslist[$i]['month']), $tmp);
					$tmp = str_replace("<!--links-->", " onclick=news_month(".$workyymm.")", $tmp);
				$template .= $tmp;
				$monthset = true;
			}
		} else {
			if($monthset) {
				$template .= $tempfoot;
				$monthset = false;
			}
			if($setyaer != $newslist[$i]['year']) {
				$tmp = $temphead;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--year-->", $newslist[$i]['year']."年", $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$template .= $tmp;
				$setyaer = $newslist[$i]['year'];
			}
			if($workmm != $newslist[$i]['month']) {
				$workmm = $newslist[$i]['month'];
				$tmp = $tempbody;
				$tmp = str_replace("<!--yy-->", $newslist[$i]['year'], $tmp);
				$tmp = str_replace("<!--ym-->", $workyymm, $tmp);
				$tmp = str_replace("<!--month-->", sprintf("%d",$newslist[$i]['month'])."月", $tmp);
				$tmp = str_replace("<!--yymm-->", sprintf("%d年%d月",$newslist[$i]['year'],$newslist[$i]['month']), $tmp);
				$tmp = str_replace("<!--links-->", " onclick=news_month(".$workyymm.")", $tmp);
				$template .= $tmp;
				$monthset = true;
			}
		}
	}
	if($monthset) {
		$template .= $tempfoot;
		$monthset = false;
	}
	//$tempbody = str_replace("<!--yearlist-->", $template, $tempbody);

	return $template;
}

/////////////////////////////////
//NEWS

function info_edit_no($logdir, $tempbody, $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$news = news_get($logdir);

	$template = "";
	for($i=0;$i<@count($news);$i++) {
		if((empty($no)) || $news[$i]['dname'] == $no) {
			$template .= $tempbody;
			if($news[$i]['simg']) {
				$template = str_replace("<!--images-->", $info_image_dir.$news[$i]['simg'], $template);
			} else {
				$template = str_replace("<!--images-->", "", $template);
			}

			if($news[$i]['dtype'] === "新着情報") {
				$template = str_replace("<!--dtype-->", "<h3 class=\"info_news\">新着情報</h3>", $template);
			} else {
				$template = str_replace("<!--dtype-->", "<h3 class=\"info_event\">イベント</h3>", $template);
			}

			$date = sprintf("%04d/%02d/%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
			$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
			$template = str_replace("<!--links-->", $news_html."?no=".$news[$i]['dname'], $template);
			// $template = str_replace("<!--links-->", $news[$i]['dname'], $template);
			$template = str_replace("<!--year-->", $news[$i]['year'], $template);
			$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
			$template = str_replace("<!--days-->", $news[$i]['day'], $template);
			$template = str_replace("<!--date-->",$date, $template);
			$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
			$template = str_replace("<!--title-->", $news[$i]['title'], $template);
			$template = str_replace("<!--content-->", $news[$i]['content'], $template);
			$template = str_replace("<!--no-->", $news[$i]['dname'], $template);

			$setcnt++;
			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}

	return $template;
}


function info_edit_no2($logdir, $tempbody, $max="", $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$news = news_get($logdir);

	$template = "";
	for($i=0;$i<@count($news);$i++) {
		if((empty($no)) || $news[$i]['dname'] == $no) {
			$template .= $tempbody;
			if($news[$i]['simg']) {
				$template = str_replace("<!--images-->", $info_image_dir.$news[$i]['simg'], $template);
			} else {
				$template = str_replace("<!--images-->", "", $template);
			}

			if($news[$i]['dtype'] === "新着情報") {
				$template = str_replace("<!--dtype-->", "<h3 class=\"info_news\">新着情報</h3>", $template);
			} else {
				$template = str_replace("<!--dtype-->", "<h3 class=\"info_event\">イベント</h3>", $template);
			}

			$date = sprintf("%04d/%02d/%02d",$news[$i]['year'],$news[$i]['month'],$news[$i]['day']);
			$ym = sprintf("%04d%02d",$news[$i]['year'],$news[$i]['month']);
			$template = str_replace("<!--links-->", $news_html."?no=".$news[$i]['dname'], $template);
			// $template = str_replace("<!--links-->", $news[$i]['dname'], $template);
			$template = str_replace("<!--year-->", $news[$i]['year'], $template);
			$template = str_replace("<!--month-->", sprintf("%d",$news[$i]['month']), $template);
			$template = str_replace("<!--days-->", $news[$i]['day'], $template);
			$template = str_replace("<!--date-->",$date, $template);
			$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
			$template = str_replace("<!--title-->", $news[$i]['title'], $template);
			$template = str_replace("<!--content-->", $news[$i]['content'], $template);
			$template = str_replace("<!--no-->", $news[$i]['dname'], $template);

			$setcnt++;
			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}

	return $template;
}

/////////////////////////////////

function info_get_cnt($file,$infono,&$preno,&$nextno) {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	$preno = 0;
	$nextno = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);
		$list[] = $fdata[0];
		$tcnt++;
	}
	fclose($fp);
	$now = array_search($infono, $list);
	$preno = $now>0?$list[$now-1]:0;
	$nextno = $now>=$tcnt?0:$list[$now+1];

	return $tcnt;
}


/////////////////////////////////
//EVENT（トピックス）
function event_get($file,$newsday = "") {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$dttm = explode(" ",$fdata[2]);
		$idNo = $dttm[0];
		if($newsday && $newsday != $idNo) continue;
		$dd = explode("/",$dttm[0]);
		$tt = explode(":",$dttm[1]);
		$eventlist[$tcnt] = array(	"dname" => $fdata[0],
									"year" =>	$dd[0],
									"month" =>	$dd[1],
									"day" =>	$dd[2],
									"hour" =>	$tt[0],
									"min" =>	$tt[1],
									"dtype" =>	$fdata[3],
									"title" =>	$fdata[4],
									"content" =>	$fdata[5],
									"simg" =>	$fdata[6],);
		$tcnt++;
		//
		if($newsday) break;
	}
	fclose($fp);

	return $eventlist;
}

function event_edit_no($logdir, $tempbody, $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$event = event_get($logdir);

	$template = "";
	for($i=0;$i<@count($event);$i++) {
		if((empty($no)) || $event[$i]['dname'] == $no) {
			$template .= $tempbody;
			if($event[$i]['simg']) {
				$template = str_replace("<!--images-->", $event_image_dir.$event[$i]['simg'], $template);
			}
			else {
				$template = str_replace("<!--images-->", "", $template);
			}
			$date = sprintf("%04d/%02d/%02d",$event[$i]['year'],$event[$i]['month'],$event[$i]['day']);
			$ym = sprintf("%04d%02d",$event[$i]['year'],$event[$i]['month']);
			//$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
			// $template = str_replace("<!--links-->", $event[$i]['dname'], $template);
			$template = str_replace("<!--year-->", $event[$i]['year'], $template);
			$template = str_replace("<!--month-->", sprintf("%d",$event[$i]['month']), $template);
			$template = str_replace("<!--days-->", $event[$i]['day'], $template);
			$template = str_replace("<!--date-->",$date, $template);
			$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
			$template = str_replace("<!--title-->", $event[$i]['title'], $template);
			$template = str_replace("<!--content-->", $event[$i]['content'], $template);

			$setcnt++;
			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}

	return $template;
}

///////////////////
//EVENT
function event_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$event = event_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($event);$i++) {
		$template .= $tempbody;
		if($event[$i]['simg']) {
			$template = str_replace("<!--images-->", $event_image_dir.$headtag.$event[$i]['simg'], $template);
		}
		else {
			$template = str_replace("<!--images-->", "", $template);
		}

		if($event[$i]['dtype'] === "新着情報") {
			$template = str_replace("<!--dtype-->", "<span class=\"news\">新着情報</span>", $template);
		} else {
			$template = str_replace("<!--dtype-->", "<span class=\"event\">イベント</span>", $template);
		}


		$date = sprintf("%04d/%02d/%02d",$event[$i]['year'],$event[$i]['month'],$event[$i]['day']);
		$ym = sprintf("%04d%02d",$event[$i]['year'],$event[$i]['month']);
		$event_html = "info_detail.html";
		$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		//$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		// $template = str_replace("<!--links-->", $event[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $event[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$event[$i]['month']), $template);
		$template = str_replace("<!--days-->", $event[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
		$template = str_replace("<!--title-->", $event[$i]['title'], $template);
		$template = str_replace("<!--content-->", $event[$i]['content'], $template);

		$setcnt++;
		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}

///////////////////
//TOPINFO
function topinfo_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$event = event_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($event);$i++) {
		$template .= $tempbody;
		if($event[$i]['simg']) {
			$template = str_replace("<!--images-->", $topinfo_image_dir.$headtag.$event[$i]['simg'], $template);
		}
		else {
			$template = str_replace("<!--images-->", "", $template);
		}

		if($event[$i]['dtype'] === "新着情報") {
			$template = str_replace("<!--dtype-->", "<span class=\"news\">新着情報</span>", $template);
		} else {
			$template = str_replace("<!--dtype-->", "<span class=\"event\">イベント</span>", $template);
		}


		$date = sprintf("%04d/%02d/%02d",$event[$i]['year'],$event[$i]['month'],$event[$i]['day']);
		$ym = sprintf("%04d%02d",$event[$i]['year'],$event[$i]['month']);
		$event_html = "info_detail.html";
		$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		//$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		// $template = str_replace("<!--links-->", $event[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $event[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$event[$i]['month']), $template);
		$template = str_replace("<!--days-->", $event[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
		$template = str_replace("<!--title-->", $event[$i]['title'], $template);
		$template = str_replace("<!--content-->", $event[$i]['content'], $template);

		$setcnt++;
		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}

///////////////////
//VOICE
function voice_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	// switch($type) {
	// 	case "TPC":
	// 		$headtag = "pct_thumb";
	// 		break;
	// 	case "LPC":
	// 		$headtag = "pcl_thumb";
	// 		break;
	// 	default:
	// 		$headtag = "";
	// 		break;
	// }

	$event = event_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($event);$i++) {
		$template .= $tempbody;
		if($event[$i]['simg']) {
			$template = str_replace("<!--images-->", $voice_image_dir.$headtag.$event[$i]['simg'], $template);
		}
		else {
			$template = str_replace("<!--images-->", "", $template);
		}


		$date = sprintf("%04d/%02d/%02d",$event[$i]['year'],$event[$i]['month'],$event[$i]['day']);
		$ym = sprintf("%04d%02d",$event[$i]['year'],$event[$i]['month']);
		$event_html = "info_detail.html";
		$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		//$template = str_replace("<!--links-->", $event_html."?no=".$event[$i]['dname'], $template);
		// $template = str_replace("<!--links-->", $event[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $event[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$event[$i]['month']), $template);
		$template = str_replace("<!--days-->", $event[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--weekday-->",$date.$weekday[get_wday($date)], $template);
		$template = str_replace("<!--title-->", $event[$i]['title'], $template);
		$template = str_replace("<!--content-->", $event[$i]['content'], $template);

		$setcnt++;
		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}


/////////////////////////////////
//STUDIO取得
function studio_get($file,$studioday = "") {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$dttm = explode(" ",$fdata[2]);
		$idNo = $dttm[0];
		if($studioday && $studioday != $idNo) continue;
		$dd = explode("/",$dttm[0]);
		$tt = explode(":",$dttm[1]);
		$studiolist[$tcnt] = array(	"dname" => $fdata[0],
															"year" =>	$dd[0],
															"month" =>	$dd[1],
															"day" =>	$dd[2],
															"hour" =>	$tt[0],
															"min" =>	$tt[1],
															"title" =>	$fdata[4],
															"comment" =>	$fdata[5],
															"simg1" =>	$fdata[6],
															"simg2" =>	$fdata[7],
															"simg3" =>	$fdata[8]);
		$tcnt++;
		//
		if($studioday) break;
	}
	fclose($fp);

	return $studiolist;
}

/////////////////////////////////
//STUDIO
function studio_edit_no($logdir, $tempbody, $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$studio = studio_get($logdir);

	$template = "";
	for($i=0;$i<@count($studio);$i++) {
		if(empty($no) || $studio[$i]['dname'] == $no) {
			$template .= $tempbody;
			for($j=1;$j<=5;$j++) {
				if($studio[$i]['simg'.$j]) {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--thumbimages-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $studio_image_dir.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--images-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--thumbimages-->", "", $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--images-->", "", $template);
				}
			}
			$date = sprintf("%04d-%02d-%02d",$studio[$i]['year'],$studio[$i]['month'],$studio[$i]['day']);
			$ym = sprintf("%04d%02d",$studio[$i]['year'],$studio[$i]['month']);
			$template = str_replace("<!--links-->", $studio_html."?no=".$studio[$i]['dname'], $template);
			$template = str_replace("<!--title-->", $studio[$i]['title'], $template);
			$template = str_replace("<!--comment-->", $studio[$i]['comment'], $template);
			break;
		}
	}

	return $template;
}

/////////////////////////////////
function studio_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$studio = studio_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($studio);$i++) {
		$template .= $tempbody;
		for($j=1;$j<=5;$j++) {
			if($studio[$i]['simg'.$j]) {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--thumbimages-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $studio_image_dir.$studio[$i]['simg'.$j], $template);
					$template = str_replace("<!--images-->", $studio_image_dir.$headtag.$studio[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--thumbimages-->", "", $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--images-->", "", $template);
			}
		}
		$date = sprintf("%04d-%02d-%02d",$studio[$i]['year'],$studio[$i]['month'],$studio[$i]['day']);
		$ym = sprintf("%04d%02d",$studio[$i]['year'],$studio[$i]['month']);
		$template = str_replace("<!--links-->", $studio_html."?no=".$studio[$i]['dname'], $template);
		$template = str_replace("<!--title-->", $studio[$i]['title'], $template);
		$template = str_replace("<!--comment-->", $studio[$i]['comment'], $template);

		$setcnt++;
		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}

/////////////////////////////////
//GALLEY取得
function gallery_get($file) {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$dttm = explode(" ",$fdata[2]);
		$dd = explode("/",$dttm[0]);
		$tt = explode(":",$dttm[1]);
		$galley[$tcnt] = array(	"dname" => $fdata[0],
															"year" =>	$dd[0],
															"month" =>	$dd[1],
															"day" =>	$dd[2],
															"hour" =>	$tt[0],
															"min" =>	$tt[1],
															"title" =>	$fdata[4],
															"comment" =>	$fdata[5],
															"simg1" =>	$fdata[6],
															);
		$tcnt++;
	}
	fclose($fp);

	return $galley;
}

function gallery_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$galley = gallery_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($galley);$i++) {
		$template .= $tempbody;
		for($j=1;$j<=5;$j++) {
			if($galley[$i]['simg'.$j]) {
				$imgsize = GetImageSize(".".$gallery_image_dir.$galley[$i]['simg'.$j]);
				if($imgsize[0] > $imgsize[1]) {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $gallery_image_dir.$headtag.$galley[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $gallery_image_dir."thumb".$galley[$i]['simg'.$j], $template);
				}
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $gallery_image_dir.$galley[$i]['simg'.$j], $template);
				$template = str_replace("<!--images-->", $gallery_image_dir.$galley[$i]['simg'.$j], $template);
			} else {
				$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images-->", "", $template);
			}
		}
		$date = sprintf("%04d-%02d-%02d",$galley[$i]['year'],$galley[$i]['month'],$galley[$i]['day']);
		$ym = sprintf("%04d%02d",$galley[$i]['year'],$galley[$i]['month']);
		$template = str_replace("<!--links-->", $galleyhtml."?no=".$galley[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $galley[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$galley[$i]['month']), $template);
		$template = str_replace("<!--days-->", $galley[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--title-->", $galley[$i]['title'], $template);
		$template = str_replace("<!--comment-->", $galley[$i]['comment'], $template);
		$setcnt++;

		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}


/////////////////////////////////
//details

//スタッフ情報
function details_get($file) {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$detail[$tcnt] = array(	"dname" => $fdata[0],
								"savefile" =>	$fdata[1],
								"name" =>	$fdata[2],
								"floor" =>	$fdata[3],
								"site" =>	$fdata[4],
								"method" =>	$fdata[5],
								"finish" =>	$fdata[6],
								"address" =>	$fdata[7],
								"point01" =>	$fdata[8],
								"point02" =>	$fdata[9],
								"point03" =>	$fdata[10],
								"point04" =>	$fdata[11],
								"point05" =>	$fdata[12],
								"simg1" =>	$fdata[13],
								"simg2" =>	$fdata[14],
								"simg3" =>	$fdata[15],
								"simg4" =>	$fdata[16],
								"simg5" =>	$fdata[17],
								"simg6" =>	$fdata[18],
								);
		$tcnt++;
	}
	fclose($fp);

	return $detail;
}

function details_edit_no($logdir, $tempbody, $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$details = details_get($logdir);

	$template = "";
	for($i=0;$i<@count($details);$i++) {
		if((empty($no)) || $details[$i]['dname'] == $no) {
			$template .= $tempbody;
			for($j=1;$j<=6;$j++) {
				if($details[$i]['simg'.$j]) {
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $details_image_dir.$details[$i]['simg'.$j], $template);
					// $template = str_replace("<!--images-->", $details_image_dir.$details[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
					// $template = str_replace("<!--images-->", "", $template);
				}
			}
			$date = sprintf("%04d-%02d-%02d",$details[$i]['year'],$details[$i]['month'],$details[$i]['day']);
			$ym = sprintf("%04d%02d",$details[$i]['year'],$details[$i]['month']);

			$template = str_replace("<!--name-->", $details[$i]['name'], $template);
			$template = str_replace("<!--floor-->", $details[$i]['floor'], $template);
			$template = str_replace("<!--site-->", $details[$i]['site'], $template);
			$template = str_replace("<!--method-->", $details[$i]['method'], $template);
			$template = str_replace("<!--finish-->", $details[$i]['finish'], $template);
			$template = str_replace("<!--address-->", $details[$i]['address'], $template);
			$template = str_replace("<!--point01-->", $details[$i]['point01'], $template);
			$template = str_replace("<!--point02-->", $details[$i]['point02'], $template);
			$template = str_replace("<!--point03-->", $details[$i]['point03'], $template);
			$template = str_replace("<!--point04-->", $details[$i]['point04'], $template);
			$template = str_replace("<!--point05-->", $details[$i]['point05'], $template);
			$setcnt++;

			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}
	return $template;
}

function details_edit_no2($logdir, $tempbody, $max="", $no="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$details = details_get($logdir);

	$template = "";
	for($i=0;$i<@count($details);$i++) {
		if((empty($no)) || $details[$i]['dname'] == $no) {
			$template .= $tempbody;
			for($j=1;$j<=5;$j++) {
				if($details[$i]['simg'.$j]) {
					$imgsize = GetImageSize(".".$details_image_dir.$details[$i]['simg'.$j]);
					if($imgsize[0] > $imgsize[1]) {
						$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template);
					} else {
						$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir."thumb".$details[$i]['simg'.$j], $template);
					}
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $details_image_dir.$details[$i]['simg'.$j], $template);
					$template = str_replace("<!--images-->", $details_image_dir.$details[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
					$template = str_replace("<!--images-->", "", $template);
				}
			}
			$template = str_replace("<!--no-->", $details[$i]['dname'], $template);
			$template = str_replace("<!--name-->", $details[$i]['name'], $template);
			$template = str_replace("<!--floor-->", $details[$i]['floor'], $template);
			$template = str_replace("<!--site-->", $details[$i]['site'], $template);
			$template = str_replace("<!--method-->", $details[$i]['method'], $template);
			$template = str_replace("<!--finish-->", $details[$i]['finish'], $template);
			$template = str_replace("<!--address-->", $details[$i]['address'], $template);
			$template = str_replace("<!--point01-->", $details[$i]['point01'], $template);
			$template = str_replace("<!--point02-->", $details[$i]['point02'], $template);
			$template = str_replace("<!--point03-->", $details[$i]['point03'], $template);
			$template = str_replace("<!--point04-->", $details[$i]['point04'], $template);
			$template = str_replace("<!--point05-->", $details[$i]['point05'], $template);
			$setcnt++;

			if(!empty($max)) {
				if($setcnt >= $max) break;
			}
		}
	}
	return $template;
}

function details_edit($logdir, $tempbody, $max="", $type="") {
	require('common.php');

	switch($type) {
		case "TPC":
			$headtag = "pct_thumb";
			break;
		case "LPC":
			$headtag = "pcl_thumb";
			break;
		default:
			$headtag = "";
			break;
	}

	$details = details_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($details);$i++) {
		$template .= $tempbody;
		for($j=1;$j<=11;$j++) {
			if($details[$i]['simg'.$j]) {
				$imgsize = GetImageSize(".".$details_image_dir.$details[$i]['simg'.$j]);
				if($imgsize[0] > $imgsize[1]) {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir."thumb".$details[$i]['simg'.$j], $template);
				}
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $details_image_dir.$details[$i]['simg'.$j], $template);
				$template = str_replace("<!--images-->", $details_image_dir.$details[$i]['simg'.$j], $template);
			} else {
				$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images-->", "", $template);
			}
		}
		$date = sprintf("%04d-%02d-%02d",$details[$i]['year'],$details[$i]['month'],$details[$i]['day']);
		$ym = sprintf("%04d%02d",$details[$i]['year'],$details[$i]['month']);

		$template = str_replace("<!--year-->", $details[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$details[$i]['month']), $template);
		$template = str_replace("<!--days-->", $details[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--name-->", $details[$i]['name'], $template);
		$template = str_replace("<!--floor-->", $details[$i]['floor'], $template);
		$template = str_replace("<!--site-->", $details[$i]['site'], $template);
		$template = str_replace("<!--method-->", $details[$i]['method'], $template);
		$template = str_replace("<!--finish-->", $details[$i]['finish'], $template);
		$template = str_replace("<!--address-->", $details[$i]['address'], $template);
		$template = str_replace("<!--point01-->", $details[$i]['point01'], $template);
		$template = str_replace("<!--point02-->", $details[$i]['point02'], $template);
		$template = str_replace("<!--point03-->", $details[$i]['point03'], $template);
		$template = str_replace("<!--point04-->", $details[$i]['point04'], $template);
		$template = str_replace("<!--point05-->", $details[$i]['point05'], $template);
		$setcnt++;

		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}

/////////////////////////////////
function topdetails_edit_rand($logdir, $tempbody, $max="", $type) {
	require('common.php');
//ChromePhp::log($type);
//	switch($type) {
//		case "TPC":
//			$headtag = "pct_thumb";
//			break;
//		case "LPC":
//			$headtag = "pcl_thumb";
//			break;
//		default:
//			$headtag = "";
//			break;
//	}

	$details = details_get($logdir);

	$setcnt = 0;
	$template = array();
	for($i=0;$i<@count($details);$i++) {
		//ChromePhp::log($details);
		$template[$i] = $tempbody;
		for($j=1;$j<=5;$j++) {

			if($details[$i]['simg'.$j]) {
				$template[$i] = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--thumbimages-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--images".sprintf("%02d",$j)."-->", $details_image_dir.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--images-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
			} else {
				$template[$i] = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template[$i]);
				$template[$i] = str_replace("<!--thumbimages-->", "", $template[$i]);
				$template[$i] = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template[$i]);
				$template[$i] = str_replace("<!--images-->", "", $template[$i]);
			}
		}
		$detailshtml = 'works_details.html';
		$template[$i] = str_replace("<!--links-->", $detailshtml."?no=".$details[$i]['dname'], $template[$i]);
		$template = str_replace("<!--year-->", $details[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$details[$i]['month']), $template);
		$template = str_replace("<!--days-->", $details[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--name-->", $details[$i]['name'], $template);
		$template = str_replace("<!--floor-->", $details[$i]['floor'], $template);
		$template = str_replace("<!--site-->", $details[$i]['site'], $template);
		$template = str_replace("<!--method-->", $details[$i]['method'], $template);
		$template = str_replace("<!--finish-->", $details[$i]['finish'], $template);
		$template = str_replace("<!--address-->", $details[$i]['address'], $template);
		$template = str_replace("<!--point01-->", $details[$i]['point01'], $template);
		$template = str_replace("<!--point02-->", $details[$i]['point02'], $template);
		$template = str_replace("<!--point03-->", $details[$i]['point03'], $template);
		$template = str_replace("<!--point04-->", $details[$i]['point04'], $template);
		$template = str_replace("<!--point05-->", $details[$i]['point05'], $template);
	}
	// shuffle($template);
	$datalist = "";
	for($h=0;$h<$max;$h++) {
		$datalist .= $template[$h];
	}

	return $datalist;
}

/////////////////////////////////
function topdetails_edit_rand2($logdir, $tempbody, $max="", $type) {
	require('common.php');

	$details = details_get($logdir);

	$setcnt = 0;
	$template = array();
	for($i=0;$i<@count($details);$i++) {
		$template[$i] = $tempbody;
		for($j=1;$j<=5;$j++) {

			if($details[$i]['simg'.$j]) {
				$template[$i] = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--thumbimages-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--images".sprintf("%02d",$j)."-->", $details_image_dir.$details[$i]['simg'.$j], $template[$i]);
				$template[$i] = str_replace("<!--images-->", $details_image_dir.$headtag.$details[$i]['simg'.$j], $template[$i]);
			} else {
				$template[$i] = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template[$i]);
				$template[$i] = str_replace("<!--thumbimages-->", "", $template[$i]);
				$template[$i] = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template[$i]);
				$template[$i] = str_replace("<!--images-->", "", $template[$i]);
			}
		}
		$detailshtml = 'works_details.html';
		$template[$i] = str_replace("<!--links-->", $detailshtml."?no=".$details[$i]['dname'], $template[$i]);
		$template = str_replace("<!--year-->", $details[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$details[$i]['month']), $template);
		$template = str_replace("<!--days-->", $details[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--name-->", $details[$i]['name'], $template);
		$template = str_replace("<!--floor-->", $details[$i]['floor'], $template);
		$template = str_replace("<!--site-->", $details[$i]['site'], $template);
		$template = str_replace("<!--method-->", $details[$i]['method'], $template);
		$template = str_replace("<!--finish-->", $details[$i]['finish'], $template);
		$template = str_replace("<!--address-->", $details[$i]['address'], $template);
		$template = str_replace("<!--point01-->", $details[$i]['point01'], $template);
		$template = str_replace("<!--point02-->", $details[$i]['point02'], $template);
		$template = str_replace("<!--point03-->", $details[$i]['point03'], $template);
		$template = str_replace("<!--point04-->", $details[$i]['point04'], $template);
		$template = str_replace("<!--point05-->", $details[$i]['point05'], $template);
	}
	// shuffle($template);
	$datalist = "";
	//for($h=4;$h<$max;$h++) {	2021.8.5EDIT なんで４？
	for($h=0;$h<$max;$h++) {
		$datalist .= $template[$h];
	}

	return $datalist;
}


function details_get_cnt($file,$detailsno,&$preno,&$nextno) {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	$preno = 0;
	$nextno = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);
		$list[] = $fdata[0];
		$tcnt++;
	}
	fclose($fp);
	$now = array_search($detailsno, $list);
	$preno = $now>0?$list[$now-1]:0;
	$nextno = $now>=$tcnt?0:$list[$now+1];

	return $tcnt;
}

/////////////////////////////////
//MOVIE取得
function movie_get($file) {
	require('common.php');

	//ファイル
	$fp = fopen($file, "r");
	if(! $fp) {
		error('ファイルエラー');
	}
	$tcnt = 0;
	while(! feof($fp)) {
		$line = fgets($fp);
		if(empty($line)) break;
		$fdata = explode("<>",$line);

		$dttm = explode(" ",$fdata[2]);
		$dd = explode("/",$dttm[0]);
		$tt = explode(":",$dttm[1]);
		$movie[$tcnt] = array(	"dname" => $fdata[0],
															"year" =>	$dd[0],
															"month" =>	$dd[1],
															"day" =>	$dd[2],
															"hour" =>	$tt[0],
															"min" =>	$tt[1],
															"title" =>	$fdata[4],
															"comment" =>	$fdata[5],
															"simg1" =>	$fdata[6],
															);
		$tcnt++;
	}
	fclose($fp);

	return $movie;
}
function movie_edit($logdir, $tempbody) {
	require('common.php');

	$movie = movie_get($logdir);

	$setcnt = 0;
	$template = "";
	for($i=0;$i<@count($movie);$i++) {
		$template .= $tempbody;
		/*for($j=1;$j<=5;$j++) {
			if($galley[$i]['simg'.$j]) {
				$imgsize = GetImageSize(".".$gallery_image_dir.$galley[$i]['simg'.$j]);
				if($imgsize[0] > $imgsize[1]) {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $gallery_image_dir.$headtag.$galley[$i]['simg'.$j], $template);
				} else {
					$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", $gallery_image_dir."thumb".$galley[$i]['simg'.$j], $template);
				}
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", $gallery_image_dir.$galley[$i]['simg'.$j], $template);
				$template = str_replace("<!--images-->", $gallery_image_dir.$galley[$i]['simg'.$j], $template);
			} else {
				$template = str_replace("<!--thumbimages".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images".sprintf("%02d",$j)."-->", "", $template);
				$template = str_replace("<!--images-->", "", $template);
			}
		}*/
		$date = sprintf("%04d-%02d-%02d",$movie[$i]['year'],$movie[$i]['month'],$movie[$i]['day']);
		$ym = sprintf("%04d%02d",$movie[$i]['year'],$galley[$i]['month']);
		$template = str_replace("<!--links-->", $movie[$i]['dname'], $template);
		$template = str_replace("<!--year-->", $movie[$i]['year'], $template);
		$template = str_replace("<!--month-->", sprintf("%d",$galley[$i]['month']), $template);
		$template = str_replace("<!--days-->", $movie[$i]['day'], $template);
		$template = str_replace("<!--date-->",$date, $template);
		$template = str_replace("<!--title-->", $movie[$i]['title'], $template);
		$template = str_replace("<!--comment-->", $movie[$i]['comment'], $template);
		$setcnt++;

		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}

	return $template;
}


/////////////////////////////////
//犬種取得
function breed_get($logdir, $tempbody) {
	require('common.php');

	$dog_breed_file = str_replace(array("\r\n", "\r", "\n"),"",@file($logdir));

	$setcnt = 0;
	$template = "";
	$template .= '<option value="-1"></option>';
	for($i=0;$i<@count($dog_breed_file);$i++) {
		$template .= $tempbody;
		$template .= '<option value="'.$dog_breed_file[$i].'">'.$dog_breed_file[$i].'</option>';
		$setcnt++;

		if(!empty($max)) {
			if($setcnt >= $max) break;
		}
	}




	return $template;
}

?>
