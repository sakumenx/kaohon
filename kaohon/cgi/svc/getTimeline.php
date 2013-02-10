<?php
require_once("../bl/timelineBl.php");

//処理開始
session_start();

//セッションチェック
if(!isset($_SESSION["userId"])){
	header('HTTP', true, 403);
	return;
}

//パラメーター取得
$userId = $_SESSION["userId"];

//timestampの有無によりBLを呼び分ける
if(isset($_POST["timestamp"])){
	//二発目を呼び出す
	
	$timestamp = $_POST["timestamp"];
	$vo = Array("userId"=>$userId,"timestamp"=>$timestamp);
	
	$bl = new timelineBl();
	if(isset($_POST["fresh"])){
		$timeline = $bl->getTimelinePrevious($vo);
	}else{
		$timeline = $bl->getTimelineNext($vo);
	}
	
}else{
	//一発目を呼び出す
	
	//vo作成
	$vo = Array("userId"=>$userId);
	
	$bl = new timelineBl();
	$timeline = $bl->getTimelineInitial($vo);
}

//戻り値を設定
$ret = $timeline;

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>