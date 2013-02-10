<?php
require_once("../bl/friendManageBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId = $_SESSION["userId"];

$vo = Array("userId"=>$userId);

$bl = new friendManageBl();
$ret = $bl->getFriendList($vo);

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>