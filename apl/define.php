<?php
$stylist_type = array('オーナースタイリスト','スタイリスト','アシスタント','レセプション');

$hair_lady_length = array('ミディアム','ショート','セミロング','ロング','ベリーショート','ヘアセット');
$hair_men_length = array('ボウズ','ベリーショート','ショート','ミディアム','ロング','その他');
$hairimage_type = array('モテ・愛され','オフィス・コンサバ','ナチュラル','ギャル','カジュアル・ストリート','ティーンズ・ガーリー');
$haircolor_type = array('ブラウン・ベージュ系','レッド・ピンク系','イエロー・オレンジ系','アッシュ・ブラック系','その他カラー');

$hair_menu = array('パーマ','ストレートパーマ','縮毛矯正','エクステ','カット','カラー','デジタルパーマ','トリートメント','グラデーションカラー','ドルチェメンテカール');

$hair_amount = array('少ない','普通','多い');
$hair_amount_class = array(array('sukunai_off','futsuu_off','ooi_off'),array('sukunai_on','futsuu_on','ooi_on'));
$hair_type = array('柔かい','普通','硬い');
$hair_type_class = array(array('yawarakai_off','futsuu_off','katai_off'),array('yawarakai_on','futsuu_on','katai_on'));
$hair_thickness = array('細い','普通','太い');
$hair_thickness_class = array(array('hosoi_off','futsuu_off','futoi_off'),array('hosoi_on','futsuu_on','futoi_on'));
$hair_habit = array('なし','普通','強い');
$hair_habit_class = array(array('nashi_off','sukoshi_off','tsuyoi_off'),array('nashi_on','sukoshi_on','tsuyoi_on'));
$face_shape = array('丸型','卵型','四角','逆三角','ベース');
$face_shape_class = array(array('maru_off','tamago_off','shikaku_off','gyakusankaku_off','besu_off'),array('maru_on','tamago_on','shikaku_on','gyakusankaku_on','besu_on'));

$stlistlist_tag =
'<div class="detailgr clearfix">
<div class="detail-ko">スタイリスト歴</div>
<div class="detail-txt"><!--years_exp--></div>
</div>
<div class="detailgr clearfix">
<div class="detail-ko">得意なイメージ</div>
<div class="detail-txt"><!--specimage--></div>
</div>
<div class="detailgr clearfix">
<div class="detail-ko">得意な技術</div>
<div class="detail-txt"><!--spectech--></div>
</div>
<div class="detailgr clearfix">
<div class="detail-ko">趣味・マイブーム</div>
<div class="detail-txt"><!--hoby--></div>
</div>';

$stlistlist_tag2 = '
<div class="detailgr clearfix">
<div class="detail-ko">得意な技術</div>
<div class="detail-txt"><!--spectech--></div>
</div>
<div class="detailgr clearfix">
<div class="detail-ko">趣味・マイブーム</div>
<div class="detail-txt"><!--hoby--></div>
</div>';

$stlistlist_tag3 = '
<div class="detailgr clearfix">
<div class="detail-ko">趣味・マイブーム</div>
<div class="detail-txt"><!--hoby--></div>
</div>';

$smstlistlist_tag ='
<div class="group">
<div class="komoku">スタイリスト歴</div><div class="desc"><!--years_exp--></div>
</div>
<div class="group">
<div class="komoku">得意なイメージ</div><div class="desc"><!--specimage--></div>
</div>
<div class="group">
<div class="komoku">得意な技術</div><div class="desc"><!--spectech--></div>
</div>
<div class="group">
<div class="komoku">趣味・マイブーム</div><div class="desc"><!--hoby--></div>
</div>
';
$smstlistlist_tag2 ='
<div class="group">
<div class="komoku">得意な技術</div><div class="desc"><!--spectech--></div>
</div>
<div class="group">
<div class="komoku">趣味・マイブーム</div><div class="desc"><!--hoby--></div>
</div>
';
$smstlistlist_tag3 ='
<div class="group">
<div class="komoku">趣味・マイブーム</div><div class="desc"><!--hoby--></div>
</div>
';

$stlisttabname_tag = '<li onclick="location.hash=\'horizontalTab<!--no-->\';location.reload();"><!--name--></li>';
$stlisttab_tag = '<li class="<!--onoff-->"><a href="../haircatalog.html#horizontalTab<!--no-->"><!--name--></a></li>';
$stlist_pc_pickup_tag = '<a href="<!--imagelink-->"><img src="<!--image1-->" alt="<!--alt-->"></a>';
$stlist_pickup_tag = '<div><a href="<!--imagelink-->"><img src="<!--image1-->" alt="<!--alt-->"></a></div>';
$stllist_image_tag = '<li><a href="<!--imagelink-->"><img src="<!--image1-->" alt="<!--alt-->"></a></li>';
$stllist_top_tag = '<li><a href="staff.html#<!--staffanchor-->"><img src="<!--image1-->" alt="<!--alt-->"></a><!--name--><br><!--type--></li>';
$sm_catalog_tag_st = '<section id="styles<!--no-->"><h2><a href="#styles<!--no-->"><!--catalogname--></a></h2><div class="autoplay resizer">';
$sm_catalog_tag_end = '</div></section>';


$movie_tag = '<a href="<!--movielink-->" class="lightbox" title="<!--title-->" data-height="480"><img src="<!--image1-->" width="390" height="220" alt=""/></a>';
$movie_list_tag = '<div class="mov" style="background:url(<!--image1-->) no-repeat;"><a href="<!--movielink-->" class="lightbox" title="<!--title-->:<!--comment-->" data-height="480"><img src="<!--image1-->" alt=""/></a><div class="title"><!--title--></div><div class="movdes"><!--comment--></div></div>';
$movie_category_top_tag = '<li><a href="."><!--category--></a><ul>';
$movie_category_list_tag = '<li><a href="<!--movielink-->" class="lightbox" title="<!--title-->:<!--comment-->" data-height="480"><!--title--></a></li>';
$movie_category_bottom_tag = '</ul></li>';
$movie_playtag = '<iframe width="300" height="169" src="<!--movielink-->" frameborder="0" allowfullscreen></iframe>';
$smmovie_category_list_tag = '<li><label onclick="movie_change(\'<!--movielink-->\',\'<!--title-->\',\'<!--comment-->\')"><!--title--></label></li>';

$pickup_max = 8;
$catalog_pmax = 15;
$sm_catalog_pmax = 4;
$movie_max = 4;
?>