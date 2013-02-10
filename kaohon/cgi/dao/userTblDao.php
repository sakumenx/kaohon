<?php
require_once("baseDao.php");

/**
 * USER_TBLに対する操作をつかさどるDAOクラス.
 * @author saku
 */
class userTblDao extends baseDao {
	
	/** ユーザーを追加する. */
	function registUser($vo) {
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userName = mysql_real_escape_string($vo["userName"]);
		$mailAddress = mysql_real_escape_string($vo["mailAddress"]);
		$password = mysql_real_escape_string($vo["password"]);
		$familyName = mysql_real_escape_string($vo["familyName"]);
		$firstName = mysql_real_escape_string($vo["firstName"]);
		$description = mysql_real_escape_string($vo["description"]);
		
		//insert実行
		$sql = "insert into user_tbl ("
				. "user_name, mail_address, password, family_name, first_name, description) values ( '"
				. $userName . "', '"
				. $mailAddress . "', '"
				. $password . "', '"
				. $familyName . "', '"
				. $firstName . "', '"
				. $description . "');";
		$result = mysql_query($sql);
		
		//DB接続終了
		$this->closeConnection();
		
		//insertの成否を返却
		return $result;
	}
	
	/** 指定されたユーザー名の件数を取得する. */
	function getUserNameCount($vo){
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userName = mysql_real_escape_string($vo["userName"]);
		
		//ユニークキー照会
		$sql = "select count(user_name) from user_tbl where user_name = '"
				. $userName . "';";
		$result = mysql_query($sql);
		$ret = mysql_fetch_row($result);
		
		//DB接続終了
		$this->closeConnection();
		
		//件数を返却
		return Array("count"=>$ret[0]);
	}
	
	/** パスワードを取得する. */
	function getPassword($vo) {
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userName = mysql_real_escape_string($vo["userName"]);
				
		//ユニークキー照会
		$sql = "select password from user_tbl where user_name = '"
				. $userName . "';";
		
		$ret = null;
		if($result = mysql_query($sql)){
			if($row = mysql_fetch_row($result)){
				$ret = Array("password"=>$row[0]);
			}
		}

		//DB接続終了
		$this->closeConnection();
		
		//パスワードを返却
		return $ret;
	}
	
	/** ユーザーIDを取得する. */
	function getUserId($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userName = mysql_real_escape_string($vo["userName"]);
	
		//ユニークキー照会
		$sql = "select user_id from user_tbl where user_name = '"
				. $userName . "';";
		
		$ret = null;
		if($result = mysql_query($sql)){
			if($row = mysql_fetch_row($result)){
				$ret = Array("userId"=>$row[0]);
			}
		}
		//DB接続終了
		$this->closeConnection();

		//ユーザー情報ハッシュを返却
		return $ret;
	}
	
	/** ユーザー情報を取得する. */
	function getUserInfo($vo) {
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);

		//ユニークキー照会
		$sql = "select user_id,user_name,first_name,family_name,description from user_tbl where user_id = '"
				. $userId . "';";
		if($result = mysql_query($sql)){
			$row = mysql_fetch_row($result);
			$ret = Array(
					"userId"=>$row[0],
					"userName"=>$row[1],
					"firstName"=>$row[2],
					"familyName"=>$row[3],
					"description"=>$row[4]
			);
		}else{
			$ret = null;
		}
		
		//DB接続終了
		$this->closeConnection();

		//ユーザー情報ハッシュを返却
		return $ret;
	}
	
	function getUserInfoByUserName($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userName = mysql_real_escape_string($vo["userName"]);
	
		//ユニークキー照会
		$sql = "select user_id,user_name,first_name,family_name,description from user_tbl where user_name = '"
				. $userName . "';";
		if($result = mysql_query($sql)){
			$row = mysql_fetch_row($result);
			$ret = Array(
					"userId"=>$row[0],
					"userName"=>$row[1],
					"firstName"=>$row[2],
					"familyName"=>$row[3],
					"description"=>$row[4]
			);
		}else{
			$ret = null;
		}
	
		//DB接続終了
		$this->closeConnection();
	
		//ユーザー情報ハッシュを返却
		return $ret;
	}
}
?>