<?php
require_once("baseDao.php");

/**
 * FRIEND_TBLのDAOクラス.
 * @author saku
*/
class friendTblDao extends baseDao {
	
	function addUser($vo){
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		
		//insert実行
		$sql = "insert into friend_tbl ("
				. "user_id, friend_id) values ( '"
				. $userId . "', '"
				. $userId . "');";
		$result = mysql_query($sql);
		
		//DB接続終了
		$this->closeConnection();
		
		//insertの成否を返却
		return $result;
	}
	
	function addFriend($vo){
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendId = mysql_real_escape_string($vo["friendId"]);
	
		//insert実行
		$sql = "insert into friend_tbl ("
				. "user_id, friend_id) values ( '"
				. $userId . "', '"
				. $friendId . "');";
		$result = mysql_query($sql);
	
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
	
	function addFriendReverse($vo){
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendId = mysql_real_escape_string($vo["friendId"]);
	
		//insert実行
		$sql = "insert into friend_tbl ("
				. "user_id, friend_id) values ( '"
				. $friendId . "', '"
				. $userId . "');";
		$result = mysql_query($sql);
	
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
}
?>