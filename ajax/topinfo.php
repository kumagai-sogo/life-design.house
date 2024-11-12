<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');

	$temp_body = load_template2($temp_dir . $topinfo_temp_file);

	/////////////////////////////////
	//EVENT
	$template = topinfo_edit($topinfo_log_file, $temp_body, TOPINFO_TOPMAXCNT, "TPC");

	/////////////////////////////////
	$template = str_replace("\r\n", "", $template);
	$template = str_replace("\r", "", $template);
	$template = str_replace("\n", "", $template);
	$template = str_replace('&amp;','&',$template);
	$template = str_replace("\"","'",$template);
	//o—Í
	//o—Í
	$returnData = array(
			'listdata' => $template,
			);
	$hash	= json_encode($returnData);

	echo $hash;
?>