<?php
include("config/config.php");
include("plugin/rss.php");

if(RSSFUNCTION){
$lines = file($log_file);
echo RSS_mark($lines);
}else{
echo "RSS機能の設定がOFFになっています。";
}



?>