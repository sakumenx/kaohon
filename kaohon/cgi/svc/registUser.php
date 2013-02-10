<?php
require_once("../bl/registUserBl.php");
require_once("../bl/userInfoBl.php");


//処理開始
session_start();
//パラメーター取得
$mailAddress = isset($_POST["mailAddress"]) ? $_POST["mailAddress"] : "";
$userName    = isset($_POST["userName"])    ? $_POST["userName"]    : "";
$familyName  = isset($_POST["familyName"])  ? $_POST["familyName"]  : "";
$firstName   = isset($_POST["firstName"])   ? $_POST["firstName"]   : "";
$description = isset($_POST["description"]) ? $_POST["description"] : "";
$password1   = isset($_POST["password1"])   ? $_POST["password1"]   : "";
$password2   = isset($_POST["password2"])   ? $_POST["password2"]   : "";

$vo = Array(
		"mailAddress"=>$mailAddress,
		"userName"=>$userName,
		"firstName"=>$firstName,
		"familyName"=>$familyName,
		"description"=>$description,
		"password"=>$password1,
		"password1"=>$password1,
		"password2"=>$password2
);

//ログイン情報を検証する
$bl = new registUserBl();
$validResult = $bl->validRegistrationData($vo);

//ログイン可の場合の処理
if(!$validResult["result"]) {
	header('Content-type: application/json');
	echo json_encode($validResult);
	return;
}

//登録処理を実行
$registResult = $bl->registUser($vo);

//登録失敗時の処理
if(!$registResult["result"]){
	header('Content-type: application/json');
	echo json_encode($validResult);
	return;
}


//セッション再生成
session_regenerate_id(TRUE);

//セッション情報を設定する
$_SESSION["userId"] = $registResult["userId"];

//ユーザー情報を取得
$userVo = Array("userId"=>$registResult["userId"]);
$bl = new userInfoBl();
$userInfo = $bl->getUserInfo($userVo);

//戻り値を設定
$ret = Array("userInfo"=>$userInfo,"result"=>true);

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>