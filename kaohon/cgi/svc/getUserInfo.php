<?php
require_once("../bl/userInfoBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId   = $_SESSION["userId"];

//vo作成
$vo = Array("userId"=>$userId);

$bl = new userInfoBl();
$userInfo = $bl->getUserInfo($vo);

//戻り値を設定
$ret = $userInfo;

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>