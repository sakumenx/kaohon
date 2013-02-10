<?php
require_once("../dao/userTblDao.php");

class userInfoBl {
	function getUserId($vo) {
		//ユーザー情報を取得する
		$dao = new userTblDao();
		return $dao->getUserId($vo);
	}
	
	function getUserInfo($vo) {
		//ユーザー情報を取得する
		$dao = new userTblDao();
		return $dao->getUserInfo($vo);
	}
	
	function getUserInfoByUserName($vo) {
		//ユーザー情報を取得する
		$dao = new userTblDao();
		return $dao->getUserInfoByUserName($vo);
	}
}
?>