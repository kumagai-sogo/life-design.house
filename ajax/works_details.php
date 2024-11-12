<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');
    include 'ChromePhp.php';
	$no = $_REQUEST["no"];

	// list($temp_details1,$temp_details2,$temp_details3) = load_template($temp_dir . $workspoint_temp_file);
	$temp_point = load_template2($temp_dir . $workspoint_temp_file);
	$temp_list = load_template2($temp_dir . $worksdetails_temp_file);
	$temp_list2 = load_template2($temp_dir . $works_meta_temp_file);
	$temp_list3 = load_template2($temp_dir . $works_bread_temp_file);
	/////////////////////////////////

	$content .= details_edit_no($details_log_file, $temp_point, $no ,"LPC");

	
	$details = details_get($details_log_file);
	for($i=0;$i<count($details);$i++) {
		if((!empty($no)) && $details[$i]['dname'] == $no) {
			$list = details_edit_no2($details_log_file, $temp_list, DETAIL_LISTMAXCNT , $no ,"LPC");
			 //ChromePhp::log($list);
		}
	}

	$details = details_get($details_log_file);
	for($i=0;$i<count($details);$i++) {
		if((!empty($no)) && $details[$i]['dname'] == $no) {
			$meta = details_edit_no2($details_log_file, $temp_list2, DETAIL_LISTMAXCNT , $no ,"LPC");
		}
	}

	$details = details_get($details_log_file);
	for($i=0;$i<count($details);$i++) {
		if((!empty($no)) && $details[$i]['dname'] == $no) {
			$bread = details_edit_no2($details_log_file, $temp_list3, DETAIL_LISTMAXCNT , $no ,"LPC");
		}
	}

	$allcnt = details_get_cnt($details_log_file,$_REQUEST["no"],$preno,$nextno);



	//出力
	$returnData = array(
			'detailsimgdata' => $content,
			'listdata' => $list,
			'metadata' => $meta,
			'breaddata' => $bread,
			'allcnt' => $allcnt,
			'preno' => $preno,
			'nextno' => $nextno,
			);
	$hash	= json_encode($returnData);

	echo $hash;
?>
