<?php
require_once("../bl/messageBl.php");
require_once("../bl/timelineBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId    = $_SESSION["userId"];
$message   = $_POST["message"];

//vo作成
$vo = Array("userId"=>$userId,"message"=>$message);

$bl = new messageBl();
$ret = $bl->addMessage($vo);

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>