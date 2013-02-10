<?php
require_once("baseDao.php");

/**
 * GOOD_TBLのDAOクラス.
 * @author saku
*/
class goodTblDao extends baseDao {


	function getGoodCountList($vo) {
		//DB接続開始
		$conn = $this->getConnection();

		$param = "";
		for($i=0; $i<count($vo); $i++){
			$param = $param . mysql_real_escape_string($vo[$i]["messageId"]) . "','";
		}
		$param = "('" . substr($param,0,-3) ."')";
		
		//sql構築
		$sql = "select message_id, count(message_id) as good_count from good_tbl where message_id in "
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
	
	function addGood($vo) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$messageId = mysql_real_escape_string($vo["messageId"]);
	
		//insert実行
		$sql = "insert into good_tbl ("
				. "message_id,user_id) values ( '"
				. $messageId . "', '"
				. $userId . "');";
		$result = mysql_query($sql);
	
		//DB接続終了
		$this->closeConnection();
	
		//insertの成否を返却
		return $result;
	}
	
	function getGoodCount($vo){
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$messageId = mysql_real_escape_string($vo["messageId"]);
			
		//ユニークキー照会
		$sql = "select count(message_id) from good_tbl where message_id = '"
				. $messageId . "';";
		$result = mysql_query($sql);
		$ret = mysql_fetch_row($result);
	
		//DB接続終了
		$this->closeConnection();
	
		//件数を返却
		return Array("count"=>$ret[0]);
	}
	
}