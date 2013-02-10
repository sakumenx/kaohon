<?php
require_once("baseDao.php");

/**
 */
class friendRequestTblDao extends baseDao {

	function getFriendRequestCount($vo){
	
		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendId = mysql_real_escape_string($vo["friendId"]);
		
		//ユニークキー照会
		$sql = "select count(friend_id) from friend_request_tbl "
				. "where user_id = '" . $userId . "' and friend_id = '" . $friendId . "';";
		$result = mysql_query($sql);
		$ret = mysql_fetch_row($result);
		
		//DB接続終了
		$this->closeConnection();
		
		//件数を返却
		return Array("count"=>$ret[0]);

	}
	
	function addFriendRequest($vo){
	
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendId = mysql_real_escape_string($vo["friendId"]);
	
		//
		//insert実行
		$sql = "insert into friend_request_tbl ("
				. "user_id, friend_id) values ( '"
				. $userId . "', '"
				. $friendId . "');";
		$result = mysql_query($sql);
		
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}

	function removeFriendRequest($vo){
	
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendId = mysql_real_escape_string($vo["friendId"]);
	
		//delete実行
		$sql = "delete from friend_request_tbl "
				. "where user_id = '" . $friendId . "' and friend_id = '" . $userId . "';";
		$result = mysql_query($sql);
	
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
	
}

?>