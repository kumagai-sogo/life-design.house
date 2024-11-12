<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');

	$temp_body = load_template2($temp_dir . $voice_temp_file);

	/////////////////////////////////
	//topvoice
	$template = voice_edit($voice_log_file, $temp_body, VOICE_MAXCNT, "TPC");

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