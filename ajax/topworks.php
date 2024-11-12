<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');

	$temp_body = load_template2($temp_dir . $topworks_temp_file);

	/////////////////////////////////
	//NEWS
	$template = topdetails_edit_rand($details_log_file, $temp_body, DETAIL_TOPMAXCNT, $type);

	/////////////////////////////////
	$template = str_replace("\r\n", "", $template);
	$template = str_replace("\r", "", $template);
	$template = str_replace("\n", "", $template);
	$template = str_replace('&amp;','&',$template);
	$template = str_replace("\"","'",$template);
	//出力
	$returnData = array(
			'listdata' => $template,
			);
	$hash	= json_encode($returnData);

	echo $hash;
?>