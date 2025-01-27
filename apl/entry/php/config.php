<?php


/* -- 以下、基本の設定 ------------------------------------------------------------------------------------------------------------------------------------------------- */


//【必須】 自分のメールアドレスの設定 -- 複数のメールアドレスに送信したい場合は、以下の行をコピーして増やしていけばOKです。行頭の//を消せば有効となります。いくつでも追加可能。 --
$rm_send_address[] = 'info@life-design.house';
// $rm_send_address[] = 'saeda@sogo-ad.jp';
//$rm_send_address[] = 'bbb@example.co.jp';




//【必須】 サンクスページのURL -- index.htmlからの相対パス、またはhttp://からの絶対パス --
$rm_thanks_page_url = 'entry.html';








/* -- 以下、自分に届くメールの設定 ------------------------------------------------------------------------------------------------------------------------------------- */


//【任意】 自分に届くメールの題名
$rm_send_subject = 'エントリーフォームからお問い合わせがありました。';




//【任意】 自分に届くメールの本文 -- EOMからEOM;までの間の文章を自由に変更してください。 --
$rm_send_body = <<<EOM

エントリーフォームからお問い合わせがありました。
内容は以下の通りです。

EOM;








/* -- 以下、相手への自動返信メールの設定 ------------------------------------------------------------------------------------------------------------------------------- */


//【任意】 相手に自動返信メールを送るかどうか -- 送らない場合は0、送る場合は1にしてください。 --
$rm_reply_mail = 1;




//【だいたい必須】 メールの差出人名に表示される自分の名前 -- 相手への自動返信メールに使用されます --
$rm_send_name = '株式会社ライフ';




//【任意】 相手に届く自動返信メールの題名
$rm_thanks_subject = 'ご応募ありがとうございました。';




//【任意】 相手に届く自動返信メールの本文 -- EOMからEOM;までの間の文章を自由に変更してください。 --
$rm_thanks_body  = <<<EOM

この度は弊社の求人にご応募いただき、ありがとうございました。
折り返し担当者から返信が行きますので、しばらくお待ちください。
以下の内容でお受けいたしました。

EOM;




//【だいたい必須】 相手に届く自動返信メールの最後に付加される署名 -- EOMからEOM;までの間の文章を自由に変更してください。 --
$rm_thanks_body_signature = <<<EOM

この度はご応募頂き、重ねてお礼申し上げます。
-----------------------------------------------------------------------------------
株式会社ライフ

FREE PHONE:0120-077-988
PHONE:0584-71-7401
FAX:0584-71-7402
URL: https://life-design.house
-----------------------------------------------------------------------------------

EOM;








/* -- 以下、スパム対策機能 --------------------------------------------------------------------------------------------------------------------------------------------- */


//【任意】 メールフォームを設置するサイトのドメイン -- 記入した場合はリファラチェック機能が有効になります。 --
$rm_domain_name = 'life-design.house';
//$rm_domain_name = '1-firststep.com';








