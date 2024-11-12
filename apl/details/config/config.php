<?php

//----------------------------------------------------------------
// ■ 管理画面に関する設定
//----------------------------------------------------------------

//管理画面ログイン用のID
define("ID", "admin");


//管理画面ログイン用のパスワード
define("PASS", "v6Z3UYXy");


//管理画面デザインテンプレートファイル
define("TEMPLATEADMIN", "template/template_admin.html");


//入力画面のフォーム
define("INDEXPAGE", "template/index.php");


//確認画面
define("CHECKPAGE", "template/check.php");


//管理用一覧ページの1ページあたりにリスト表示する件数
$adminlist_max = 10;


//管理用ページの確認画面で表示する画像の表示用最大サイズ
//この設定サイズより大きい画像は、タグで縮小され、画像にリンクタグが追加されます。
$adminview_wsize = 500;
$adminview_hsize = 800;



//----------------------------------------------------------------
// ■ RSSに関する設定
//----------------------------------------------------------------

//RSS機能（0：無効　1：有効）
//有効にする場合、下記のRSS設定が必要です。
define("RSSFUNCTION", 0);

//スクリプトを設置したディレクトリパス（http://～）
$pageurl = "http://★★★/imageinfo/";


//RSS表示用スクリプトを設置したディレクトリパス（http://～）
$rssurl = "http://★★★/imageinfo/rss.php";


//RSS機能を使用する場合のRSSタイトル（ブラウザで表示される作成者名）
$rssname = "ImageInfo";

//RSS機能を使用する場合の情報登録者名（ブラウザで表示される作成者名）
$rsscreator = "admin";


//設定ファイル
$seting_file = "config/seting.cgi";



//----------------------------------------------------------------
// ■ ログ・画像データ保存ディレクトリ設定
//----------------------------------------------------------------
$imageinfo_dir = "apl/info/";

//確認用画像データの保存ディレクトリ
$imagestmp_dir = "imagestmp/";


//画像データの保存ディレクトリ
$images_dir = "images/";


//ログファイル
$log_file = "config/log.cgi";

$parent_log_file = "../parent_details/config/log.cgi";
$breed_file = "../parent_details/config/categorymain.cgi";

//HTMLファイル更新関連ファイル
$htmlrenew_file = "config/htmlrenew.cgi";



//----------------------------------------------------------------
// ■ TOPページ表示用のHTMLページに関する設定
//----------------------------------------------------------------
//ファイルネーム
define("TOPPAGELISTNAME", "../../item.html");


//TOPページ表示用リストページのHTMLファイルの書出し（0：無効　1：有効）
define("TOPHTML", 0);


//デザインテンプレートファイル
define("TEMPLATETOPLIST", "template/template_toplist.html");

//ページのタイトル
$toplistpagetitle = "リストページ";


//ファイルネーム
define("TOPLISTFNAME", "index.html");


//TOPページ表示用リストページにリスト表示する最大件数
define("TOPLISTMAX", 10);


//メインテーブルのスタイルシート
$style_toplisttb = <<<HTML
 style="width:100%;padding:2px;margin-top:3px;"
HTML;


//日付表示部分のスタイルシート
$style_toplistdatetb = <<<HTML
 style="font-size:12px;width:80px;vertical-align:top;"
HTML;


//タイトル表示部分のスタイルシート
$style_toplisttxttb = <<<HTML
 style="font-size:12px;vertical-align:top;"
HTML;


//一覧リンク部分のスタイルシート
$style_toplistlbottomtb = <<<HTML
 style="font-size:12px;text-align:right;padding-right:5px;"
HTML;


//一覧リンク表示部分のHTMLタグ
$toplistlink = <<<HTML
<a href="page_1.html" target="_top">一覧</a>
HTML;

//RSSリンク表示部分のHTMLタグ
$toprsslink = <<<HTML
｜<a href="rss.php" target="_top">RSS</a>
HTML;


//----------------------------------------------------------------
// ■ 全登録情報をリスト表示するHTMLページに関する設定
//----------------------------------------------------------------

//デザインテンプレートファイル
define("TEMPLATELIST", "template/template_list.html");


//ページのタイトル
$listpagetitle = "リストページ";


//画像表示テーブルのスタイルシート
$style_listimagetb = <<<HTML
 style="width:100px;vertical-align:top;"
HTML;


//日付・タイトル部分のスタイルシート
$style_listtxttb = <<<HTML
 style="font-size:14px;vertical-align:top;line-height:17px;"
HTML;


//ページ数表示部分のスタイルシート
$style_listnavi = <<<HTML
 style="width:100%;font-size:13px;padding-left:5px;"
HTML;


//ページ移動用リンクナビのスタイルシート
$style_listnavibt = <<<HTML
 style="width:100%;font-size:13px;padding:5px;text-align:center;"
HTML;


//リストページの1ページあたりにリスト表示する件数
$list_max = 10;//１ページに表示する件数


//リストページのページ移動用リンクナビの最大表示数
$navi_max = 10;



//----------------------------------------------------------------
// ■ 登録情報の詳細ページに関する設定
//----------------------------------------------------------------

//登録情報の詳細ページ用デザインテンプレートファイル
define("TEMPLATEDETAILED", "template/template_detailed.html");




//----------------------------------------------------------------
// ■ 各ページ共通設定
//----------------------------------------------------------------

//日付表示部分の年月日の区切り文字
$dadedividing = "/";




//----------------------------------------------------------------
// ■ 情報登録の入力に関する設定
//----------------------------------------------------------------

//コメント欄のHTML入力（0：可　1：不可）
$htmlinput = 0;


//コメントを入力必須項目にするか、任意の項目にするか
//　0：任意で入力　1：入力必須
define("COMMENT", 0);


//タイトルの入力可能な最大文字数を何文字にするか
//　文字数は、半角1文字で1、全角は1文字で2となります
define("TYTLEMAX", 140);


//コメントの入力可能な最大文字数を何文字にするか
//　文字数は、半角1文字で1、全角は1文字で2となります
define("COMMENTMAX", 1000);



//----------------------------------------------------------------
// ■ 画像アップロードに関する設定
//----------------------------------------------------------------
//アップロード可能なファイルの拡張子
$setextension = array("jpg","JPG","jpeg","JPEG","png","PNG","gif","GIF");


//アップロード可能な最大ファイルサイズ（KB）
$up_filesizelimit_upper = "10000";


//アップロード可能な最小ファイルサイズ（KB）
//　KBかMBの単位をつけてください1024KB = 1MBです。
$up_filesizelimit_lower = "5";


//アップロードできる最大の縦横サイズ（ピクセル）
$up_wlimit_upper = "4200";//横幅
$up_hlimit_upper = "4200";//縦幅


//アップロードできる最小の縦横サイズ（ピクセル）
$up_wlimit_lower = "300";//横幅
$up_hlimit_lower = "300";//縦幅


//アップロード画像点数
$upimage_setcnt = 6;

//----------------------------------------------------------------
// ■ アップロード画像の保存に関する設定
//----------------------------------------------------------------

//画像の保存サイズ
//未指定の場合はサイズ変更なし
$save_wmax_b = "930";//横幅最大
$save_hmax_b = "620";//縦幅最大


//サムネイル画像の保存サイズ
$save_wmax_s = 220;//横幅最大
$save_hmax_s = 146;//縦幅最大

//PCTOP一覧用サムネイル画像の保存サイズ
$pct_save_wmax_s = 290;//横幅最大
$pct_save_hmax_s = 193;//縦幅最大
//PC一覧用サムネイル画像の保存サイズ
$pcl_save_wmax_s = 290;//横幅最大
$pcl_save_hmax_s = 193;//縦幅最大
//PC表示画像の保存サイズ
$pc_save_wmax_s = 1840;//横幅最大
$pc_save_hmax_s = 945;//縦幅最大

//スマホTOP一覧用サムネイル画像の保存サイズ
$smt_save_wmax_s = 290;//横幅最大
$smt_save_hmax_s = 193;//縦幅最大
//スマホ一覧用サムネイル画像の保存サイズ
$sml_save_wmax_s = 290;//横幅最大
$sml_save_hmax_s = 193;//縦幅最大
//スマホ用画像の保存サイズ
$sm_save_wmax_s = 290;//横幅最大
$sm_save_hmax_s = 193;//縦幅最大

//作成するHTMLページで、表示する画像の表示用最大サイズ
//この設定サイズより大きい画像は、タグで縮小され、画像にリンクタグが追加されます。
//未設定にするには、縦横共に0に設定ください
$view_wsize = 0;//横幅最大
$view_hsize = 0;//縦幅最大


$weekday = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

$dog_breed_file = str_replace(array("\r\n", "\r", "\n"),"",@file($breed_file));


?>