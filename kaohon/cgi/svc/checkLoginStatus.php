<?php
//処理開始
session_start();

//セッションチェック
$result = isset($_SESSION["userId"]) ? true : false;

$ret = Array("result"=>$result);

//jsonとして出力
header('Content-type: application/json');
echo json_encode($ret);
?>