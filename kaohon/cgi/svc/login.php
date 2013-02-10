<?php
require_once("../bl/loginBl.php");
require_once("../bl/userInfoBl.php");

//処理開始
session_start();
//パラメーター取得
$userName = $_POST["userName"];
$password = $_POST["password"];

$vo = Array(
		"userName"=>$userName,
		"password"=>$password
		);

//ログイン情報を検証する
$bl = new loginBl();
$result = $bl->checkCredential($vo);

//ログイン可の場合の処理
if($result["result"]) {
	//セッション再生成
	session_regenerate_id(TRUE);
	
	//ユーザー情報を取得
	$bl = new userInfoBl();
	$userInfo = $bl->getUserInfoByUserName($vo);
	
	//セッション情報を設定する
	$_SESSION["userId"] = $userInfo["userId"];
	$result = Array("userInfo"=>$userInfo,"result"=>true);
}

//戻り値を設定
$ret = $result;

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>