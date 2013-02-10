<?php
require_once("baseDao.php");

/**
 * COMMENT_TBLのDAOクラス.
 * @author saku
*/
class commentTblDao extends baseDao {

	function getCommentCountList($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		$param = "";
		for($i=0; $i<count($vo); $i++){
			$param = $param . mysql_real_escape_string($vo[$i]["messageId"]) . "','";
		}
		$param = "('" . substr($param,0,-3) ."')";
	
		//sql構築
		$sql = "select message_id, count(message_id) as good_count from comment_tbl where message_id in "
				. $param
				. " group by message_id";
	
		//
		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$messageId = $row[0];
				$count = $row[1];
				$ret[$messageId] = $count;
			}
		}else{
			$ret = null;
		}
	
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $ret;
	
	}

	function getCommentList($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$messageId = mysql_real_escape_string($vo["messageId"]);
			
		//ユニークキー照会
		$sql = "select usr.user_name,msg.comment,msg.timestamp from comment_tbl as msg "
				. "left join user_tbl as usr "
				. "on msg.user_id = usr.user_id "
				. "where message_id = '" . $messageId . "' "
				. "order by msg.timestamp asc;";

		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$ret[] = Array(
						"userName"  => $row[0],
						"comment"   => $row[1],
						"timestamp" => $row[2]
				);
			}
		}else{
			$ret = null;
		}
		
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $ret;
	}
	
	function addComment($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$messageId = mysql_real_escape_string($vo["messageId"]);
		$comment = mysql_real_escape_string($vo["comment"]);
	
		//insert実行
		$sql = "insert into comment_tbl ("
				. "message_id,user_id,comment) values ( '"
				. $messageId . "', '"
				. $userId . "', '"
				. $comment . "');";
		$result = mysql_query($sql);
		
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
}