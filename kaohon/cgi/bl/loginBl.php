<?php
require_once("../dao/userTblDao.php");

class loginBl {
	function checkCredential($vo) {
		//パスワードを取得する
		$dao = new userTblDao();
		$result = $dao->getPassword($vo);
		
		//パスワードの比較結果を返却する
		if($result==null){
			$success = FALSE;
		} else {
			$success = ($vo["password"]==$result["password"]);
		}
		
		$ret = Array("result"=>$success);
		
		return $ret;
	}
}
?>