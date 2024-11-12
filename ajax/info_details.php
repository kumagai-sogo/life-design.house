<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');
	include 'ChromePhp.php';
	$no = $_REQUEST["no"];

	list($temp_details1,$temp_details2,$temp_details3) = load_template($temp_dir . $infodetails_temp_file);
	$temp_list2 = load_template2($temp_dir . $info_meta_temp_file);
	$temp_list3 = load_template2($temp_dir . $info_bread_temp_file);

	/////////////////////////////////
	$news = news_get($info_log_file);
	// ChromePhp::log($details);

	$template = "";
	for($i=0;$i<count($news);$i++) {
		if((empty($no) || ($news[$i]['dname'] == $no))) {
			for($j=1;$j<=5;$j++) {
				if($news[$i]['simg'.$j]) {
					$temp = str_replace("<!--thumbimages-->","<!--thumbimages".sprintf("%02d",$j)."-->",$temp_details2);
					$temp = str_replace("<!--images-->","<!--images".sprintf("%02d",$j)."-->",$temp);
					$temp_details .= $temp;
				}
			}
			break;
		}
	}
	//STUDIO
	$content = info_edit_no($info_log_file, $temp_details1, $no ,"LPC");
	$content .= info_edit_no($info_log_file, $temp_details, $no ,"LPC");
	$content .= $temp_details3;
	// $list = news_edit($news_log_file, $temp_list, 0 ,"LPC");

	$details = news_get($info_log_file);
	for($i=0;$i<count($details);$i++) {
		if((!empty($no)) && $details[$i]['dname'] == $no) {
			$meta = info_edit_no2($info_log_file, $temp_list2, DETAIL_LISTMAXCNT , $no ,"LPC");
		}
	}

	$details = news_get($info_log_file);
	for($i=0;$i<count($details);$i++) {
		if((!empty($no)) && $details[$i]['dname'] == $no) {
			$breaddata = info_edit_no2($info_log_file, $temp_list3, DETAIL_LISTMAXCNT , $no ,"LPC");
		}
	}

	$allcnt = info_get_cnt($info_log_file,$_REQUEST["no"],$preno,$nextno);

 // ChromePhp::log($temp_details1);

 // ChromePhp::log($list);
	//出力
	$returnData = array(
			'infodata' => $content,
			'metadata' => $meta,
			'breaddata' => $breaddata,
			'allcnt' => $allcnt,
			'preno' => $preno,
			'nextno' => $nextno,
			);
	$hash	= json_encode($returnData);

	echo $hash;
?>
