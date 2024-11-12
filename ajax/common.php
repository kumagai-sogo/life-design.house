<?php
//URL
define("NEWS_HTML","news.html");
define("STUDIO_HTML","studio.html");

//MAX
define("NEWS_TOPMAXCNT",1);
define("NEWS_MAXLINECNT",3);
define("NEWS_PAGEMAXCNT",3);
define("NEWSSM_TOPMAXCNT",1);
define("NEWS_LISTMAXCNT",10);
define("DETAIL_TOPMAXCNT",4);
define("OTHER_TOPMAXCNT",999);
define("DETAIL_STAFFMAXCNT",999);
define("DETAIL_LISTMAXCNT",1);
define("DETAIL_INFOMAXCNT",999);
define("PARENTDETAIL_MAXCNT",2);
define("EVENT_TOPMAXCNT",3);
define("TOPINFO_TOPMAXCNT",3);
define("VOICE_TOPMAXCNT",4);
define("VOICE_MAXCNT",999);

//TOP INFO
$topinfo_temp_file = "../template/top_info.html";
$eventdetails_temp_file = "../template/event_details.html";

//INFO
$info_temp_file = "../template/info_details.html";
$infoym_temp_file = "../template/info_ym.html";
$info_meta_temp_file = "../template/info_meta.html";
$info_bread_temp_file = "../template/info_breadcrumb.html";
$infodetails_temp_file = "../template/news_contents.html";

//TOP WORKS
$topworks_temp_file = "../template/top_works.html";
$otherworks_temp_file = "../template/top_works_other.html";

//WORKS
$works_temp_file = "../template/works_list.html";
$workspoint_temp_file = "../template/works_point.html";
$works_meta_temp_file = "../template/works_meta.html";
$works_bread_temp_file = "../template/works_breadcrumb.html";
$worksdetails_temp_file = "../template/works_data.html";

//TOP VOICE
$topvoice_temp_file = "../template/top_voice.html";
// $eventdetails_temp_file = "../template/event_details.html";
// $eventlist_temp_file = "../template/event_list.html";
// $eventym_temp_file = "../template/event_ym.html";

//VOICE
$voice_temp_file = "../template/voice_con.html";

// $studio_details_temp_file = "../template/studio_details.html";
// $studio_list_temp_file = "../template/studio_list.html";
// $studio_details_sm_temp_file = "../template/studio_details_sm.html";

// $details_temp_file = "../template/details.html";
// $details_list_temp_file = "../template/details_list.html";
// $details_meta_temp_file = "../template/details_meta.html";
// $topdetails_temp_file = "../template/topdetails.html";
// $movietails_temp_file = "../template/details_movie.html";
// $gallery_contentsm_temp_file = "../template/gallery_content_sm.html";
// $movie_list_temp_file = "../template/movie_list.html";

$maxcnt = 1;
$sm_maxcnt = 1;

//TOP INFO
$topinfodir = "../apl/info/";
$topinfologdir = $topinfodir."config/";
$topinfo_log_file = $topinfologdir."log.cgi";
$topinfo_image_dir = "./apl/info/images/";

//INFO
$infodir = "../apl/info/";
$infologdir = $infodir."config/";
$info_log_file = $infologdir."log.cgi";
$info_image_dir = "./apl/info/images/";

//TOP VOICE
$voicedir = "../apl/voice/";
$voicelogdir = $voicedir."config/";
$voice_log_file = $voicelogdir."log.cgi";
$voice_image_dir = "./apl/voice/images/";

//TOP WORKS
$detailsdir = "../apl/details/";
$details_log_file = $detailsdir."config/log.cgi";
$details_image_dir = "./apl/details/images/";

// $newsdir = "../apl/news/";
// $newslogdir = $newsdir."config/";
// $news_log_file = $newslogdir."log.cgi";
// $news_image_dir = "./apl/news/images/";

// $eventdir = "../apl/event/";
// $eventlogdir = $eventdir."config/";
// $event_log_file = $eventlogdir."log.cgi";
// $event_image_dir = "./apl/event/images/";

// $studiodir = "../apl/studio/";
// $studiologdir = $studiodir."config/";
// $studio_log_file = $studiologdir."log.cgi";
// $studio_image_dir = "./apl/studio/images/";

// $studiofloordir = "../apl/studiofloor/";
// $studiofloorlogdir = $studiofloordir."config/";
// $studiofloor_log_file = $studiofloorlogdir."log.cgi";
// $studiofloor_image_dir = "./apl/studiofloor/images/";

// $gallerydir = "../apl/gallery/";
// $gallery_log_file = $gallerydir."config/log.cgi";
// $gallery_image_dir = "./apl/gallery/images/";

// $detailsdir = "../apl/details/";
// $details_log_file = $detailsdir."config/log.cgi";
// $details_image_dir = "./apl/details/images/";

// $parent_detailsdir = "../apl/parent_details/";
// $parent_details_log_file = $parent_detailsdir."config/log.cgi";
// $parent_details_image_dir = "./apl/parent_details/images/";

// $moviedir = "../apl/movie/";
// $movie_log_file = $moviedir."config/log.cgi";

//imgtag
$topnews_images = '<img src="<!--images-->" alt="<!--title-->" />';
$news_images = '<img src="<!--images-->" class="card-img" alt="<!--title-->" />';

$weekday = array(" Sun"," Mon"," Tue"," Wed"," Thu"," Fri"," Sat");

define("IMGDATE_WIDTH", 155);	
define("IMGDATE_HEIGHT", 24);	

//news page tag
$pre_page_tag = '<a href="<!--link-->" class="backnum">&lt;&lt;</a>';
$page_tag = '<a href="<!--link-->" class="backnum"><!--pages--></a>';
$pagepause_tag = '<span class="backnum2">-</span>';
$next_page_tag = '<a href="<!--link-->">&gt;&gt;</a>';


?>
