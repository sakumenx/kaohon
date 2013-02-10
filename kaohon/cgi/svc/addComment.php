<?php
require_once("../bl/commentBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId    = $_SESSION["userId"];
$messageId = $_POST["messageId"];
$comment   = $_POST["comment"]; 

//vo作成
$vo = Array("userId"=>$userId,"messageId"=>$messageId,"comment"=>$comment);

$bl = new commentBl();
$ret = $bl->addComment($vo);

if($ret["result"]){
	$list = $bl->getCommentList($vo);
	$ret["commentList"] = $list;
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>