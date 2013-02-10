<?php
require_once("baseDao.php");

/**
 * MESSAGE_TBLに対する操作をつかさどるDAOクラス.
 * @author saku
*/
class messageTblDao extends baseDao {
	
	function addMessage($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$message = mysql_real_escape_string($vo["message"]);
	
		//insert実行
		$sql = "insert into message_tbl ("
				. "user_id, message) values ( '"
				. $userId . "', '"
				. $message . "');";
		$result = mysql_query($sql);
		
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
	
}
?>