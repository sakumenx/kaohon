<?php
//処理開始
session_start();

//セッション変数のクリア
$_SESSION = array();

//クライアントのセッションIDを破棄
if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", '', time() - 1800, '/');
}

//セッション破棄
session_destroy();

$ret = Array("result"=>true);

header('Content-type: application/json');
echo json_encode($ret);
?>