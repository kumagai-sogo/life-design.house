<?php
	require_once($rootdir.'./common.php');
	require_once($rootdir.'./myfunction.php');

	//$id = $_REQUEST["id"];
	$ym = $_REQUEST["ym"];
	if($ym) {
		$yy = substr($ym,0,4);
	} else {
		$yy = date("Y");
	}

	list($temp_ymhead, $temp_ymbody,
		$temp_ymfoot) = load_template($temp_dir . $infoym_temp_file);
	$temp_detail = load_template2($temp_dir . $info_temp_file);

	/////////////////////////////////
	//NEWS月
	$news_body = info_monthedit($info_log_file, $temp_detail, $ym);
	//ymlist
	$ymdata = info_ymlist($info_log_file, $temp_ymhead, $temp_ymbody, $temp_ymfoot, $ym);

	/////////////////////////////////
	//出力
	$returnData = array(
			'listdata' => $news_body,
			'ymdata' => $ymdata,
			'year' => $yy,
			);
	$hash	= json_encode($returnData);

	echo $hash;
?>
