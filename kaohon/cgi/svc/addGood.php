<?php
require_once("../bl/goodBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId    = $_SESSION["userId"];
$messageId   = $_POST["messageId"];

//vo作成
$vo = Array("userId"=>$userId,"messageId"=>$messageId);

$bl = new goodBl();
$ret = $bl->addGood($vo);

if($ret["result"]){
	$count = $bl->getGoodCount($vo);
	$ret["count"] = $count["count"];
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>