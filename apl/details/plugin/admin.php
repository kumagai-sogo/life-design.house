<?php

function redate($data){

$datearray = explode(" ",$data);
$datedata = explode("/",$datearray[0]);
$datedata['year'] = $datedata[0];
$datedata['mon'] = $datedata[1];
$datedata['mday'] = $datedata[2];

$hm = explode(":",$datearray[1]);
$datedata['hours'] = $hm[0];
$datedata['minutes'] = $hm[1];
$datedata[3] = $hm[0];
$datedata[4] = $hm[1];

return $datedata;
}


function index($html){

if(!$html || !ereg("ebc", $html) || !ereg("ttp", $html))exit();

return $html;
}


function logregist(){
global $log_file,$upimage_setcnt;

$lines[] = $_POST['fname']."<>".
		   $_POST['savefile']."<>".
		   $_POST['name']."<>".
		   $_POST['floor']."<>".
		   $_POST['site']."<>".
		   $_POST['method']."<>".
		   $_POST['finish']."<>".
		   $_POST['address']."<>".
		   $_POST['point01']."<>".
		   $_POST['point02']."<>".
		   $_POST['point03']."<>".
		   $_POST['point04']."<>".
		   $_POST['point05'];


for($h=1;$h<=$upimage_setcnt;$h++) {
	$lines[] .= "<>" . $_POST['savefile'.$h] ;
}
$lines[] .= "<><>"."\n";

$fp = fopen($log_file,"r") or die("Error");
if(function_exists('stream_set_write_buffer'))stream_set_write_buffer($fp, 0);
flock($fp, LOCK_EX);
while(!feof($fp)){

$lineschek = fgets($fp);
if($lineschek){
$lines[] = $lineschek;
}
}
flock($fp, LOCK_UN);
fclose($fp);

return $lines;
}


function logsort($mark,$lines){

$totallines = count($lines);

for($i=0;$i<$totallines;$i++){
	$data = explode("<>",$lines[$i]);
	if($data[0] == $mark){
		if(($_POST['updown'] == "up") && ($i != 0)){
			$d = $lines[$i];
			$lines[$i] = $lines[$i-1];
			$lines[$i-1] = $d;
		}elseif(($_POST['updown'] == "down") && ($i != $totallines-1)){
			$d = $lines[$i];
			$lines[$i] = $lines[$i+1];
			$lines[$i+1] = $d;
			$i++;
		}else{
			$lines[$i] = $lines[$i];
		}
	}else{
		$lines[$i] = $lines[$i];
	}
}

return $lines;
}


function setdataget($fname,$lines){
global $images_dir,$adminview_wsize,$adminview_hsize;

for($i=0;$i<count($lines);$i++){
	$data[$i] = explode("<>",$lines[$i]);
}

return $data;
}

function dataget($fname,$lines){
global $images_dir,$adminview_wsize,$adminview_hsize,$upimage_setcnt;

for($i=0;$i<count($lines);$i++){

$data = explode("<>",$lines[$i]);

if($data[0] == $fname){
break;
}
}

for($i=1;$i<$upimage_setcnt+1;$i++) {
	if($data[$i+12]){
		$imgsize = GetImageSize($images_dir.$data[$i+12]);
		$viewsize = imagesizedivision($imgsize[0],$imgsize[1],$adminview_wsize,$adminview_hsize);
		$data[$i+300] = imagelinktag($viewsize[4],$data[$i+12],$data[3],$viewsize[3]);
	}else{
		$data[$i+300] = "";
	}
}

return $data;
}


function imagelinktag($imagelink,$fname,$title,$size){
global $images_dir;

if($imagelink){
$tag = "<a href=\"${images_dir}$fname\" target=\"_blank\"><img src=\"${images_dir}$fname\" ${size} alt=\"$title\" border=\"0\"></a>";
}else{
$tag = "<img src=\"${images_dir}$fname\" ${size} alt=\"$title\">";
}

return $tag;
}


function listtoplist_renew_bt($txt){
global $PHP_SELF;

$list_renew_bt = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;font-size:13px;margin-top:15px;margin-bottom:15px;\"><tr><td>$txt</td><form action=\"$PHP_SELF\" method=\"post\"><td style=\"text-align:right;\"><input type=\"hidden\" name=\"mode\" value=\"listtoplisthtmlrenew\"><input type=\"submit\" value=\"HTMLページ更新\" style=\"margin:10px 10px;width:200px;\"></td></form></tr></table>";

return $list_renew_bt;
}


function toplist_renew_bt($txt){
global $PHP_SELF;

$toplist_renew_bt = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;font-size:13px;margin-top:15px;margin-bottom:15px;\"><tr><td>$txt</td><form action=\"$PHP_SELF\" method=\"post\"><td style=\"text-align:right;\"><input type=\"hidden\" name=\"mode\" value=\"toplisthtmlrenew\"><input type=\"submit\" value=\"TOPリストHTMLページ更新\" style=\"margin:10px 10px;width:200px;\"></td></form></tr></table>";

return $toplist_renew_bt;
}


function list_renew_bt($txt){
global $PHP_SELF;

$list_renew_bt = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;font-size:13px;margin-top:15px;margin-bottom:15px;\"><tr><td>$txt</td><form action=\"$PHP_SELF\" method=\"post\"><td style=\"text-align:right;\"><input type=\"hidden\" name=\"mode\" value=\"listhtmlrenew\"><input type=\"submit\" value=\"リストHTMLページ更新\" style=\"margin:10px 10px;width:200px;\"></td></form></tr></table>";

return $list_renew_bt;
}


function detailed_renew_bt($txt){
global $PHP_SELF;

$detailed_renew_bt = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;font-size:13px;margin-top:15px;margin-bottom:15px;\"><tr><td>$txt</td><form action=\"$PHP_SELF\" method=\"post\"><td style=\"text-align:right;\"><input type=\"hidden\" name=\"mode\" value=\"detailedhtmlrenew\"><input type=\"submit\" value=\"各HTMLページ更新\" style=\"margin:10px 10px;width:200px;\"></td></form></tr></table>";

return $detailed_renew_bt;
}


function adminlist_bt(){
global $PHP_SELF;

$html_adminlist_bt = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;text-align:center;\"><tr><form action=\"$PHP_SELF\" method=\"post\"><td><input type=\"submit\" value=\"登録情報一覧\" class=\"submit\" style=\"margin:50px 10px;\"></td></form></tr></table>";

return $html_adminlist_bt;
}


function noimageup(){
global $_FILES,$images_dir,$imagestmp_dir;
global $adminview_wsize,$adminview_hsize;
global $up_filesizelimit_upper,$up_filesizelimit_lower,$setextension;
global $up_wlimit_upper,$up_hlimit_upper,$up_wlimit_lower,$up_hlimit_lower,$save_wmax_b,$save_hmax_b,$save_wmax_s,$save_hmax_s;

$mictime = microtime();
$fname = substr($mictime,11,10).substr($mictime,2,3);

$savefile = "";

$snsavefile = "";

$_POST['fname'] = $fname;

}


function imageup($no){
global $_FILES,$images_dir,$imagestmp_dir;
global $adminview_wsize,$adminview_hsize;
global $up_filesizelimit_upper,$up_filesizelimit_lower,$setextension;
global $up_wlimit_upper,$up_hlimit_upper,$up_wlimit_lower,$up_hlimit_lower,$save_wmax_b,$save_hmax_b,$save_wmax_s,$save_hmax_s;
global $pct_save_wmax_s,$pct_save_hmax_s,$pcl_save_wmax_s,$pcl_save_hmax_s,$sml_save_wmax_s,$sml_save_hmax_s,$sm_save_wmax_s,$sm_save_hmax_s;

if(!is_uploaded_file($_FILES['userfile'.$no]['tmp_name'])){
html(error("画像を選択してください。"));
}

if(!($_FILES['userfile'.$no]['tmp_name'])){
html(error("アップロードできませんでした。ファイルサイズを確認してください。"));
}

if($_FILES['userfile'.$no]['size'] > ($up_filesizelimit_upper * 1024)){
html(error("ファイルサイズがサイズが大きいです。<br><br>アップロード可能サイズは ${up_filesizelimit_lower}KB 以上 ${up_filesizelimit_upper} までです。"));
}

if($_FILES['userfile'.$no]['size'] < ($up_filesizelimit_lower * 1024)){
html(error("ファイルサイズがサイズが小さいです。<br><br>アップロード可能サイズは ${up_filesizelimit_lower}KB 以上 ${up_filesizelimit_upper} までです。"));
}

$upfile_name = explode(".",$_FILES['userfile'.$no]['name']);

if (!in_array($upfile_name[1],$setextension)){

for($i=0;$i<count($setextension);$i++){
$html .= "$setextension[$i]　";
}

html(error("画像タイプに誤りがあります。<br><br>アップロードできる画像の拡張子は『${html}』のみです。"));
}


$mictime = microtime();
$fname = substr($mictime,11,10).substr($mictime,2,3);

$savefile = $fname . ".".$upfile_name[1];

$snsavefile = "thumb${fname}.".$upfile_name[1];

if(!$_POST['fname']){
$_POST['fname'] = $fname;
}

//$_POST[savefile] = $savefile;
/*
switch($no) {
	case 1:
		$_POST[savefile1] = $savefile;
		break;
	case 2:
		$_POST[savefile2] = $savefile;
		break;
	case 3:
		$_POST[savefile3] = $savefile;
		break;
	case 4:
		$_POST[savefile4] = $savefile;
		break;
	case 5:
		$_POST[savefile5] = $savefile;
		break;
}
*/
$_POST['savefile'.$no] = $savefile;


move_uploaded_file($_FILES['userfile'.$no]['tmp_name'], "${imagestmp_dir}$savefile");

$imgsize = GetImageSize("${imagestmp_dir}$savefile");
$imgwidth = $imgsize[0];
$imgheight = $imgsize[1];

$check_img_type = array("1","2","3");
if(!(in_array($imgsize[2] ,$check_img_type))){
@unlink("${imagestmp_dir}$savefile");
for($i=0;$i<count($setextension);$i++){
$html .= "$setextension[$i]　";
}
html(error("画像タイプに誤りがあります。<br><br>アップロードできる画像の拡張子は『${html}』のみです。"));
}


if(($imgsize[1] < $up_hlimit_lower) || ($imgsize[0] < $up_wlimit_lower)){
@unlink("${imagestmp_dir}$savefile");
html(error("画像の縦×横サイズが小さいです。<br><br>アップロード可能サイズは、<br>　縦${up_hlimit_lower}px　、　横${up_wlimit_lower}px　以上です。"));
}


if(($imgsize[1] > $up_hlimit_upper) || ($imgsize[0] > $up_wlimit_upper)){
@unlink("${imagestmp_dir}$savefile");
html(error("画像の縦×横サイズが大きいです。<br><br>アップロード可能サイズは、<br>　縦${up_hlimit_upper}px　、　横${up_wlimit_upper}px　以下です。"));
}


if($imgsize[2] == 1){

$originalimage = imagecreatefromgif("${imagestmp_dir}$savefile");

}elseif($imgsize[2] == 2){

$originalimage = imagecreatefromjpeg("${imagestmp_dir}$savefile");

}elseif($imgsize[2] == 3){

$originalimage = imagecreatefrompng("${imagestmp_dir}$savefile");

}

//本システム用サムネイル
$new_size_s = imagesizedivision($imgsize[0],$imgsize[1],$save_wmax_s,$save_hmax_s);
imageresize($originalimage,"${imagestmp_dir}$snsavefile",$new_size_s[0],$new_size_s[1],$imgsize[0],$imgsize[1],$imgsize[2]);

//WEB PCTOP用サムネイル
$pctsnsavefile = "pct_thumb${fname}.".$upfile_name[1];
$new_size_pct = imagesizedivision($imgsize[0],$imgsize[1],$pct_save_wmax_s,$pct_save_hmax_s);
imageresize($originalimage,"${imagestmp_dir}$pctsnsavefile",$new_size_pct[0],$new_size_pct[1],$imgsize[0],$imgsize[1],$imgsize[2]);
//WEB PC用サムネイル
$pclsnsavefile = "pcl_thumb${fname}.".$upfile_name[1];
$new_size_pcl = imagesizedivision($imgsize[0],$imgsize[1],$pcl_save_wmax_s,$pcl_save_hmax_s);
imageresize($originalimage,"${imagestmp_dir}$pclsnsavefile",$new_size_pcl[0],$new_size_pcl[1],$imgsize[0],$imgsize[1],$imgsize[2]);
//WEB スマホ用
$smsnsavefile = "sm_thumb${fname}.".$upfile_name[1];
$new_size_sm = imagesizedivision($imgsize[0],$imgsize[1],$sm_save_wmax_s,$sm_save_hmax_s);
imageresize($originalimage,"${imagestmp_dir}$smsnsavefile",$new_size_sm[0],$new_size_sm[1],$imgsize[0],$imgsize[1],$imgsize[2]);
//WEB スマホ用サムネイル
$smlsnsavefile = "sml_thumb${fname}.".$upfile_name[1];
$new_size_sml = imagesizedivision($imgsize[0],$imgsize[1],$sml_save_wmax_s,$sml_save_hmax_s);
imageresize($originalimage,"${imagestmp_dir}$smlsnsavefile",$new_size_sml[0],$new_size_sml[1],$imgsize[0],$imgsize[1],$imgsize[2]);


if($save_wmax_b && $save_hmax_b){
$new_size_b = imagesizedivision($imgsize[0],$imgsize[1],$save_wmax_b,$save_hmax_b);
}


if($new_size_b[4]){
imageresize($originalimage,"${imagestmp_dir}$savefile",$new_size_b[0],$new_size_b[1],$imgsize[0],$imgsize[1],$imgsize[2]);
$imgsize[0] = $new_size_b[0];
$imgsize[1] = $new_size_b[1];
}


imagedestroy($originalimage);

if(!file_exists("$imagestmp_dir$savefile") || !file_exists("$imagestmp_dir$snsavefile")){
html(error("画像データが正しくアップロードされませんでした。"));
}

$viewsize = imagesizedivision($imgsize[0],$imgsize[1],$adminview_wsize,$adminview_hsize);
if($viewsize[4]){
$imageurl = "<a href=\"${imagestmp_dir}$savefile\" target=\"_blank\"><img src=\"${imagestmp_dir}$savefile\" $viewsize[3] alt=\"$gname\" border=\"0\"></a>";
}else{
$imageurl = "<img src=\"${imagestmp_dir}$savefile\" $viewsize[3] alt=\"$gname\">";
}

return $imageurl;
}


function imageresize($originalimage,$new_imagefile,$new_wsize,$new_hsize,$wsize,$hsize,$new_filetype){

$new_image = imagecreatetruecolor($new_wsize, $new_hsize);

imagecopyresampled($new_image,$originalimage, 0, 0, 0, 0, $new_wsize, $new_hsize,$wsize,$hsize);

if($new_filetype == 1){
imagegif($new_image,$new_imagefile);
}elseif($new_filetype == 2){
imagejpeg($new_image,$new_imagefile);
}elseif($new_filetype == 3){
imagepng($new_image,$new_imagefile);
}

imagedestroy($new_image);
}


function imagesizedivision($wsize,$hsize,$wmax,$hmax){

if((($wmax > 0) && ($hmax > 0)) && (($wsize > $wmax) || ($hsize > $hmax))){

if(($wmax / $wsize) < ($hmax / $hsize)){
$maxratio = $wmax / $wsize;
}else{
$maxratio = $hmax / $hsize;
}

$size[0] = (int)($wsize * $maxratio);
$size[1] = (int)($hsize * $maxratio);
$size[3] = "width=\"$size[0]\" height=\"$size[1]\"";
$size[4] = 1;

}else{

$size[0] = $wsize;
$size[1] = $hsize;
$size[3] = "width=\"$size[0]\" height=\"$size[1]\"";
}

return $size;
}


function str_replace_template($str,$original){

foreach($str as $key => $value){

$mark = "<!--".$key."-->";
$original = str_replace($mark, $value, $original);
}

return $original;
}


function fsave_w($str,$savefile){

$fp = fopen($savefile,"w") or die("Error");
if(function_exists('stream_set_write_buffer'))stream_set_write_buffer($fp, 0);
flock($fp, LOCK_EX);
fwrite($fp, $str);
flock($fp, LOCK_UN);
fclose($fp);
}


function fsave_array_w($lines,$savefile){

$fp = fopen($savefile,"w") or die("Error");
if(function_exists('stream_set_write_buffer'))stream_set_write_buffer($fp, 0);
flock($fp, LOCK_EX);
for($i=0;$i<count($lines);$i++){
fwrite($fp, $lines[$i]);
}

flock($fp, LOCK_UN);
fclose($fp);
}


function log_del_save($check,$log_file){


$fp = fopen($log_file,"r+") or die("Error");
if(function_exists('stream_set_write_buffer'))stream_set_write_buffer($fp, 0);
flock($fp, LOCK_EX);
while(!feof($fp)){

$lineschek = fgets($fp);

$data = explode("<>",$lineschek);

if("$data[0]" != "$check" && $data[0]){
$lines .= $lineschek;
$returnlines[] = $lineschek;
}

}

rewind($fp);
fputs($fp, $lines);
ftruncate($fp, ftell($fp));
flock($fp, LOCK_UN);
fclose($fp);


return $returnlines;
}


function del_dir($dir_path){

$handle = opendir($dir_path);

while(($entry = readdir($handle))){

if(is_file($dir_path. $entry)){
unlink($dir_path. $entry);
}
}

closedir($handle);
}


function filemove($from, $to){

copy($from, $to);
unlink($from);
}


function navi_html($page,$totalpage){
global $navi_max;


if($page > 1){
$bt[1] = "<a href = \"page_".($page - 1).".html\">≪ 前のページ</a>&nbsp;&nbsp;&nbsp;&nbsp;";
}else{
$bt[1] = "";
}

if($totalpage > 1 && $page < $totalpage) {
$bt[2] = "&nbsp;&nbsp;&nbsp;&nbsp;<a href = \"page_". ($page + 1).".html\">次のページ ≫</a>";
}else{
$bt[2] = "";
}


if($page == 1){
$s = 1;
if($navi_max > $totalpage){
$e = $totalpage;
}else{
$e = $navi_max;
}
}elseif($page == $totalpage){
$e = $totalpage;
$s = $totalpage - $navi_max + 1;
if(1 > $s)$s = 1;
}else{
$s = $page - floor($navi_max / 2);
if(1 > $s)$s = 1;
$e = $s + $navi_max - 1;
if($e > $totalpage){$s = $totalpage - $navi_max + 1;$e = $totalpage;}
if(1 > $s)$s = 1;
}

for($i=$s;$i<=$e;$i++){

if($i==1 && $page==1){
$bt[0] .= "<b>1</b>";

}elseif($i == $page) {

$bt[0] .= "｜<b>$i</b>";

}elseif($i == $s){

$bt[0] .= "<a href=\"page_$i.html\">$i</a>";
}else{

$bt[0] .= "｜<a href=\"page_$i.html\">$i</a>";

}
}

return $bt;
}


function adminlist_html($mark,$lines){
global $PHP_SELF,$adminlist_max,$images_dir,$style_listnavi,$style_listimagetb,$style_listtxttb,$htmlinput,$dog_breed_file;


if($_POST['totallines']){$totallines = $_POST['totallines'];} else {if(is_array($lines)){$totallines = count($lines);}}

$totalpage = ceil($totallines / $adminlist_max);

if($totalpage == 0)$totalpage = 1;

if($_POST['page']){$page = $_POST['page'];}else{$page = 1;}

$html['topic'] = "<div$style_listnavi>${page} ページ目を表示 / ${totalpage}ページ (合計：${totallines}件)</div>\n";

if($totallines == 0){
$html['topic'] .= "<table cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:13px;\"><tr><td><p><center>現在0件です。</center></p></td></tr></table>\n";
return $html['topic'];
}

$html['topic'] .= "<table cellpadding=\"5\" cellspacing=\"0\" style=\"width:100%;border-collapse:collapse;font-size:14px;line-height:19px;\">\n";
$html['topic'] .= "<tr style=\"width:100%;background-color:#E5E5DC;\">\n<td class=\"pint\" style=\"border:1px solid #CCCCCC;text-align:center;\">\nプロフィール\n</td>\n<td style=\"border:1px solid #CCCCCC;text-align:center;\">\n画像\n</td>\n<td style=\"border:1px solid #CCCCCC;text-align:center;\">修正・削除<br>スタッフ情報の並び替え↑↓</td>\n</tr>\n";

if($page == $totalpage){
	$e = $totallines;
	$s = $adminlist_max * ($page-1);
}else{
	$e = $page * $adminlist_max;
	$s = $e - $adminlist_max;
}

for($i=$s;$i<$e;$i++){

$data = explode("<>",$lines[$i]);

$upimage2 = "";$upimage3 = "";$upimage4 = "";$upimage5 = "";
if($data[13]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[13]);
	$upimage = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[13]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}else{
	$upimage = "--\n";
}
if($data[14]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[14]);
	$upimage2 = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[14]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}

if($data[15]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[15]);
	$upimage3 = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[15]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}
if($data[16]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[16]);
	$upimage4 = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[16]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}

if($data[17]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[17]);
	$upimage5 = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[17]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}

if($data[18]){
	$imgsize = @GetImageSize($images_dir."thumb".$data[18]);
	$upimage5 = "<a href=\"$data[0].html\" target=\"_blank\"><img src=\"${images_dir}thumb$data[18]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";
}

if($data[3]){
	$dog_breed_name = "<font>カテゴリー【".$data[3]."】</font>&nbsp;&nbsp;&nbsp;";
}
else {
	$dog_breed_name = "";
}


$html['topic'] .= "<tr style=\"vertical-align:top;\">\n
<td style=\"border:1px solid #CCCCCC;\">
名前：$data[2]<br>
延床面積：$data[3]<br>
敷地面積：$data[4]<br>
工法・構造：$data[5]<br>
竣工年月：$data[6]<br>
施工場所:$data[7]<br>
ポイント1:$data[8]<br>
ポイント2:$data[9]<br>
ポイント3:$data[10]<br>
ポイント4:$data[11]<br>
ポイント5:$data[12]<br>
</td>\n
<td style=\"border:1px solid #CCCCCC;text-align:center;width:450px;\" class=\"topimg\">\n
$upimage$upimage2$upimage3$upimage4$upimage5$upimage6
</td>\n
<td style=\"border:1px solid #CCCCCC;text-align:center;\"><table cellpadding=\"8\" cellspacing=\"0\" border=\"0\"><tr><form method=\"post\" action=\"$PHP_SELF\"><td><input type=\"hidden\" name=\"fname\" value=\"$data[0]\"><input type=\"hidden\" name=\"mode\" value=\"logset\"><input type=\"hidden\" name=\"updown\" value=\"up\"><input type=\"hidden\" name=\"page\" value=\"$page\"><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input name=\"submit\" type=\"submit\" value=\"↑\"></td></form>\n<form method=\"post\" action=\"$PHP_SELF\"><td><input type=\"hidden\" name=\"fname\" value=\"$data[0]\"><input type=\"hidden\" name=\"mode\" value=\"renew\"><input name=\"submit\" type=\"submit\" value=\"修正\"></td></form>\n</tr><tr><form method=\"post\" action=\"$PHP_SELF\"><td><input type=\"hidden\" name=\"fname\" value=\"$data[0]\"><input type=\"hidden\" name=\"mode\" value=\"logset\"><input type=\"hidden\" name=\"updown\" value=\"down\"><input type=\"hidden\" name=\"page\" value=\"$page\"><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input name=\"submit\" type=\"submit\" value=\"↓\"></td></form>\n<form method=\"post\" action=\"$PHP_SELF\"><td><input type=\"hidden\" name=\"fname\" value=\"$data[0]\"><input type=\"hidden\" name=\"mode\" value=\"del\"><input name=\"submit\" type=\"submit\" value=\"削除\"></td></form>\n</tr>\n</table></td>\n</tr>\n";
}

$html['topic'] .= "</table>\n";

if($totalpage >= 2){

$bt[0] = "<table border=0 cellpadding=0 cellspacing=0><tr>";
if ($page > 1) {
$bt[0] .= "<form action=$PHP_SELF method=\"post\"><td><input type=\"hidden\" name=\"dtype\" value=\"${dtype}\"><input type=\"hidden\" name=\"page\" value=\"1\"><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input type=\"hidden\" name=\"mode\" value=\"adminlist\"><input type=submit value=\"≪最初のページ\"></td></form>";
$bt[0] .= "<form action=$PHP_SELF method=\"post\"><td><input type=\"hidden\" name=\"dtype\" value=\"${dtype}\"><input type=\"hidden\" name=\"page\" value=\"" . ($page - 1) . "\"><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input type=\"hidden\" name=\"mode\" value=\"adminlist\"><input type=submit value=\"≪前の $adminlist_max 件\"></td></form>";
}
if($totalpage > 1 and $page < $totalpage) {
$bt[0] .= "<form action=$PHP_SELF method=\"post\"><td><input type=\"hidden\" name=\"dtype\" value=\"${dtype}\"><input type=\"hidden\" name=\"page\" value=" . ($page + 1) . "><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input type=\"hidden\" name=\"mode\" value=\"adminlist\"><input type=submit value=\"次の $adminlist_max 件≫\"></td></form>";
$bt[0] .= "<form action=$PHP_SELF method=\"post\"><td><input type=\"hidden\" name=\"dtype\" value=\"${dtype}\"><input type=\"hidden\" name=\"page\" value=\"$totalpage\"><input type=\"hidden\" name=\"totallines\" value=\"$totallines\"><input type=\"hidden\" name=\"mode\" value=\"adminlist\"><input type=submit value=\"最後のページ≫\"></td></form>";
}
$bt[0] .= "</tr></table>";

$html['topic'] = "<div class=\"navi_line\">$bt[0]</div>\n".$html['topic']."<p><div class=\"navi_line\">$bt[0]</div></p>\n";
}

return $html['topic'];
}


function date_html($data){
global $dadedividing;

$datearray = explode(" ",$data);
$datedata = explode("/",$datearray[0]);

$data = "[ $datedata[0]$dadedividing$datedata[1]$dadedividing$datedata[2] ]";

return $data;
}


function toplist_html($mark,$lines){
global $toplistpagetitle,$style_toplisttb,$style_toplistlbottomtb,$style_toplistdatetb,$style_toplisttxttb,$list_max,$toplistlink,$toprsslink;

$html['title'] = $toplistpagetitle;

$template = file_get_contents(TEMPLATETOPLIST);

if(RSSFUNCTION){$rss = $toprsslink;}

$html['topic'] = "<table cellpadding=\"0\" cellspacing=\"0\"$style_toplisttb>\n";
$html['topic'] .= "<tr>\n<td colspan=\"2\"$style_toplistlbottomtb>\n$toplistlink$rss\n</td>\n</tr>\n";

$v_line = "<tr>\n<td colspan=\"2\"><hr size=\"1\" style=\"width:100%;margin:0px;color:#CCCCCC\"></td>\n</tr>\n";

$totallines = count($lines);
if($totallines >= TOPLISTMAX){
$e = TOPLISTMAX;
}else{
$e = $totallines;
}

for($i=0;$i<$e;$i++){

$data = explode("<>",$lines[$i]);

$html['topic'] .= "<tr>\n<td$style_toplistdatetb>\n".date_html($data[2])."\n</td>\n<td$style_toplisttxttb>\n<a href=\"$data[0].html\" target=\"_top\">$data[3]</a>\n</td>\n</tr>\n$v_line";
}


$html['topic'] .= "<tr>\n<td colspan=\"2\">\n${cr}\n</td>\n</tr>\n";
$html['topic'] .= "</table>\n";

$savedata = str_replace_template($html,$template);

fsave_w($savedata,TOPLISTFNAME);

}


function list_html($mark,$lines){
	global $imageinfo_dir,$images_dir,$listpagetitle,$style_listnavi,$style_listnavibt,$style_listimagetb,$style_listtxttb,$list_max,$upimage_setcnt;

if(is_array($lines)){
	$totallines = count($lines);
}
	for($i=0;$i<$totallines;$i++){
		$html = $temp_array[1];
		$data = explode("<>",$lines[$i]);

		if($data[0] == $mark){
			//if($_POST['mode'] == "renewend"){
				$returnlines[$i] = $_POST['fname']."<>".
								   $_POST['savefile']."<>".
								   $_POST['name']."<>".
								   $_POST['floor']."<>".
								   $_POST['site']."<>".
								   $_POST['method']."<>".
								   $_POST['finish']."<>".
								   $_POST['address']."<>".
								   $_POST['point01']."<>".
								   $_POST['point02']."<>".
								   $_POST['point03']."<>".
								   $_POST['point04']."<>".
								   $_POST['point05'];
								   
				for($h=1;$h<=$upimage_setcnt;$h++) {
					$returnlines[$i] .= "<>" . $_POST['savefile'.$h] ;
				}
				$returnlines[$i] .= "<><>"."\n";

				$data[0] = $_POST['fname'];
				$data[1] = $_POST['savefile'];
				$data[2] = $_POST['name'];
				$data[3] = $_POST['floor'];
				$data[4] = $_POST['site'];
				$data[5] = $_POST['method'];
				$data[6] = $_POST['finish'];
				$data[7] = $_POST['address'];
				$data[8] = $_POST['point01'];
				$data[9] = $_POST['point02'];
				$data[10] = $_POST['point03'];
				$data[11] = $_POST['point04'];
				$data[12] = $_POST['point05'];
				
				for($j=1;$j<=$upimage_setcnt;$j++) {
					$data[$j+12] = $_POST['savefile'.$j];
				}
		}else{
			$returnlines[$i] = $lines[$i];
		}

		if($data[0]){
			$html = str_replace("\$name", $data[2], $html);
			$html = str_replace("\$floor", $data[3], $html);
			$html = str_replace("\$site", $data[4], $html);
			$html = str_replace("\$method", $data[5], $html);
			$html = str_replace("\$finish", $data[6], $html);
			$html = str_replace("\$address", $data[7], $html);
			$html = str_replace("\$point01", $data[8], $html);
			$html = str_replace("\$point02", $data[9], $html);
			$html = str_replace("\$point03", $data[10], $html);
			$html = str_replace("\$point04", $data[11], $html);
			$html = str_replace("\$point05", $data[12], $html);
			

			for($j=1;$j<=$upimage_setcnt;$j++) {
				if(file_exists($images_dir."thumb".$data[$j+12])){
					$imgsize = @GetImageSize($images_dir."thumb".$data[$j+12]);
					$html = str_replace("\$image", $imageinfo_dir.$images_dir."thumb".$data[$j+12], $html);
					$html = str_replace("\$imgdata", $imgsize[3], $html);
					$html = str_replace("\$imglink", $imageinfo_dir.$data[0].".html", $html);
				}else{
					$html = str_replace("\$image", "", $html);
					$html = str_replace("\$imgdata", "", $html);
					$html = str_replace("\$imglink", "", $html);
				}
			}

			$template .= $html;
		}
	}
	//fsave_w($temp_array[0].$template.$temp_array[2],TOPPAGELISTNAME);


return $returnlines;
}


function check(){
global $_POST,$upimage_setcnt;

$errmsg = "";

if(!$_POST['name']){
$errmsg .= "名前を入力いただいたかご確認ください<br>";
}

if($errmsg != ""){
$errmsg = html(error($errmsg));
}
return $errmsg;

//if(!$imgflg) {
//	html(error("画像ファイルが1つも指定されていません、１つ以上指定してください"));
//}

}


function strcode($str){
global $htmlinput;

if(get_magic_quotes_gpc()){
$str = stripslashes($str);
}

if($htmlinput == 1 || $_POST['mode'] == "check" || $_POST['mode'] == "renewcheck"){
$str = htmlspecialchars($str);

}

$str = str_replace("<>", "<<!---->>", $str);

$str = chop($str);

return $str;
}


function loginform(){
global $PHP_SELF;

$html = <<<HTML
<form method="POST" action="$PHP_SELF">
<table border="0" cellpadding="0" cellspacing="0" style="width:650px;margin-top:20px;font-size:13px;color:#555555;">
<tr><td class="tabletitle">ID</td><td class="tableform"><input type="text" name="id" size="20" style="width:100px;"></td></tr>
<tr><td class="tabletitle">パスワード</td><td class="tableform"><input type="password" name="pass" size="10" style="width:100px;"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="ログイン" class="submit" style="margin:50px 10px;"></td></tr>
</table>
</form>
HTML;

return $html;
}

function logoutform(){
global $PHP_SELF;

$html = <<<HTML

<script type="text/javascript">
<!--
　　window.close();
//-->
</script>
<br/>ログアウトしました。
HTML;

return $html;
}


function passcheck($id,$pass){

if($id == ID && $pass == PASS)$chek = true;

return $chek;
}


function logincheck(){

session_cache_limiter('private');
session_start();

if($_POST['mode'] == "logout"){
$_SESSION['login'] = false;
@setcookie(session_name(), '', time()-42000, '/');
session_destroy();
session_cache_limiter('nocache');

//html(loginform());
html(logoutform());

exit;
}

if(!$_SESSION['login'] && !passcheck($_POST["id"] ,$_POST["pass"])){

if(isset($_POST["id"])||isset($_POST["pass"])){
html(error("ユーザー名またはパスワードが違います。").loginform());
}

html(loginform());
}

if(isset($_POST["id"])||isset($_POST["pass"]))session_regenerate_id();

$_SESSION['login'] = true;
}


function html($html){
global $menu;
$html = title() . $html;
include(TEMPLATEADMIN);
exit();
}


function ok($html){

$html = "<div style=\"font-size:14px;text-align:center;\">".$html."<hr size=\"1\" style=\"color:#DDDDDD;\">\n</div>\n";

return $html;
}


function error($html){
global $PHP_SELF;

$html = "<div style=\"font-size:14px;text-align:center;color:#CC0000;\">".$html."<hr size=\"1\" style=\"color:#DDDDDD;\">\n</div>\n";

if($_POST['mode']){
$html .= "<div style=\"text-align:center;\">\n<input type=reset value=\"戻る\" name=reset onClick=\"javascript:history.back()\" class=\"submit\" style=\"margin:50px 10px;\"></div>\n";
}
return $html;
}


function menu(){
global $PHP_SELF;

$menu = "
<table cellpadding=\"0\" cellspacing=\"0\">\n
<tr>
<td>\n
<form action=\"${PHP_SELF}\" method=\"post\">
<input type=\"hidden\" name=\"mode\" value=\"adminlist\"><input type=\"submit\" value=\"登録情報一覧\" class=\"submit_button\"><br>
</form>\n
<td>\n
<form action=\"${PHP_SELF}\" method=\"post\">
<input type=\"hidden\" name=\"mode\" value=\"regist\"><input type=\"submit\" value=\"新規登録\" class=\"submit_button\"><br>
</form>\n
</td>
<td>
<form action=\"${PHP_SELF}\" method=\"post\">\n
<input type=\"hidden\" name=\"mode\" value=\"logout\"><input type=\"submit\" value=\"ログアウト\" class=\"submit_button\">
</td>
</form>\n
</tr>\n
</table>\n
";

return $menu;
}


function title(){

if($_POST['mode'] == "adminlist"){
	//$title = "<img src=\"template/images/title_adminlist.gif\" alt=\"登録情報一覧\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">登録情報一覧</h2>\n";
}elseif($_POST['mode'] == "regist" || $_POST['mode'] == "check"){
	//$title = "<img src=\"template/images/title_regist.gif\" alt=\"新規登録\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">新規登録</h2>\n";
}elseif($_POST['mode'] == "del" || $_POST['mode'] == "renew" || $_POST['mode'] == "renewcheck"){
	//$title = "<img src=\"template/images/title_regist.gif\" alt=\"情報更新\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">情報更新</h2>\n";
}elseif($_POST['mode'] == "dsort"){
	$title = "<h2 class=\"bg-grad\">情報並替</h2>\n";
}elseif($_POST['mode'] == "assistant_catalog"){
	$title = "<h2 class=\"bg-grad\">アシスタントカタログ</h2>\n";
}elseif($_POST['mode'] == "htmlrenew"){
	//$title = "<img src=\"template/images/title_htmlrenew.gif\" alt=\"HTMLファイルの更新\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">HTMLファイルの更新</h2>\n";
}elseif($_SESSION['login']){
	//$title = "<img src=\"template/images/title_adminlist.gif\" alt=\"ページ一覧\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">ページ一覧</h2>\n";
}else{
	//$title = "<img src=\"template/images/title_login.gif\" alt=\"ログイン\" width=\"650\" height=\"40\" style=\"margin-bottom:10px;\">\n";
	$title = "<h2 class=\"bg-grad\">ログイン</h2>\n";
}

return $title;
}


function list_html_original($mark,$lines){
global $images_dir,$listpagetitle,$style_listnavi,$style_listnavibt,$style_listimagetb,$style_listtxttb,$list_max,$upimage_setcnt;

$html['title'] = $listpagetitle;

$template = file_get_contents(TEMPLATELIST);

$totallines = count($lines);
$totalpage = ceil($totallines / $list_max);

if($totalpage == 0)$totalpage = 1;

$total = $totallines;

if(RSSFUNCTION){$rss = "　<a href=\"rss.php\">RSS</a>";}

$l = 0;

for($page=1;$page<=$totalpage;$page++){

$navi = "<div$style_listnavi>${page} ページ目を表示 / ${totalpage}ページ (合計：${total}件)$rss</div>\n";

$html['topic'] = "<table cellpadding=\"5\" cellspacing=\"0\" style=\"width:100%;\">\n";
$v_line = "<tr>\n<td colspan=\"2\"><hr size=\"1\" style=\"width:100%;margin:0px;color:#CCCCCC\"></td>\n</tr>\n";

if($page == $totalpage){$e = $totallines;$s = $list_max * ($page-1);}else{$e = $page * $list_max;$s = $e - $list_max;}

for($i=$s;$i<$e;$i++){

$data = explode("<>",$lines[$i]);

if($data[0] == $mark){

if($_POST['mode'] == "renewend"){
	$returnlines[$l] = $_POST['fname']."<>".
					   $_POST['savefile']."<>".
					   $_POST['name']."<>".
					   $_POST['floor']."<>".
					   $_POST['site']."<>".
					   $_POST['method']."<>".
					   $_POST['finish']."<>".
					   $_POST['address']."<>".
					   $_POST['point01']."<>".
					   $_POST['point02']."<>".
					   $_POST['point03']."<>".
					   $_POST['point04']."<>".
					   $_POST['point05'];
					   
//."<>".$_POST['savefile1']."<>".$_POST['savefile2']."<>".$_POST['savefile3']."<>".$_POST['savefile4']."<>".$_POST['savefile5']."<>"."<>"."\n";
	for($h=1;$h<=$upimage_setcnt;$h++) {
		$returnlines[$l] .= "<>" . $_POST['savefile'.$h] ;
	}
	$returnlines[$l] .= "<><>"."\n";

	$data[0] = $_POST['fname'];
	$data[1] = $_POST['savefile'];
	$data[2] = $_POST['name'];
	$data[3] = $_POST['floor'];
	$data[4] = $_POST['site'];
	$data[5] = $_POST['method'];
	$data[6] = $_POST['finish'];
	$data[7] = $_POST['address'];
	$data[8] = $_POST['point01'];
	$data[9] = $_POST['point02'];
	$data[10] = $_POST['point03'];
	$data[11] = $_POST['point04'];
	$data[12] = $_POST['point05'];
	$data[13] = $_POST['savefile1'];
	$data[14] = $_POST['savefile2'];
	$data[15] = $_POST['savefile3'];
	$data[16] = $_POST['savefile4'];
	$data[17] = $_POST['savefile5'];
}


}else{
$returnlines[$l] = $lines[$i];
}

if($data[0]){

if(file_exists($images_dir."thumb".$data[1])){
	$imgsize = @GetImageSize($images_dir."thumb".$data[1]);
	$upimage = "<a href=\"$data[0].html\"><img src=\"${images_dir}thumb$data[13]\" $imgsize[3] alt=\"$data[3]\" border=\"0\"></a>\n";

}else{
	$upimage = "";
}

	$html['topic'] .= "$v_line<tr>\n<td$style_listtxttb>".date_html($data[2])."\n<br>\n<a href=\"$data[0].html\">$data[3]</a>\n</td>\n<td$style_listimagetb>\n$upimage\n</td>\n</tr>\n";

}

	$l++;
}


$html['topic'] .= "<tr>\n<td colspan=\"2\"><hr size=\"1\" style=\"width:100%;margin:0px;color:#CCCCCC\"></td>\n</tr>\n";
$html['topic'] .= "</table>\n";

if($totalpage >= 2){
	$bt = navi_html($page,$totalpage);
	$html['topic'] = "$navi\n<div$style_listnavibt>$bt[1]$bt[0]$bt[2]</div>\n".$html['topic']."<p><div$style_listnavibt>$bt[1]$bt[0]$bt[2]</div></p>\n${cr}\n";
}else{
	$html['topic'] = "$navi\n".$html['topic']."\n${cr}\n";
}

if($totallines == 0){
	$html['topic'] = "$navi<table cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:13px;\"><tr><td><p><center>現在0件です。</center></p></td></tr></table>\n${cr}\n";
}

$fname = "page_$page";
$savedata = str_replace_template($html,$template);

fsave_w($savedata,$fname.".html");

}
}


?>