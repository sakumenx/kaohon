<?php
require_once("baseDao.php");

/**
 * TIMELINEを表示するためのDAOクラス.
 * @author saku
*/
class timelineDao extends baseDao {
	
	function getTimeline($vo,$freshFlag) {
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		
		//WHERE句を設定
		$where = "where frd.user_id = '" . $userId;
		//LIMIT句を設定
		$limit = "limit 0,10";
		
		//timestampを指定されている場合にのみ条件追加
		if(isset($vo["timestamp"])){
			$timestamp = $vo["timestamp"];
			
			//$fleshFlagがある場合は最近のメッセージを取得
			if($freshFlag){
				$where = $where . "' and msg.timestamp > '" . $timestamp;
				//最近のメッセージをすべて取得するためLIMIT句解除
				$limit = "";
			}else {
				$where = $where . "' and msg.timestamp < '" . $timestamp;
			}
		}
		$where = $where . "' ";
		
		//
		$sql = "select msg.message_id,msg.user_id,usr.user_name,msg.message,msg.timestamp,god.user_id as good_user "
				. "from message_tbl as msg "
				. "left join user_tbl as usr on msg.user_id = usr.user_id "
				. "left join friend_tbl as frd on msg.user_id = frd.friend_id "
				. "left join good_tbl as god on msg.message_id = god.message_id and '" . $userId . "' = god.user_id "
				. $where
				. "order by msg.timestamp desc "
				. $limit;
		
		//
		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$ret[] = Array(
						"messageId"=>$row[0],
						"userId"=>$row[1],
						"userName"=>$row[2],
						"message"=>$row[3],
						"timestamp"=>$row[4],
						"good"=>(null!=$row[5])
				);
			}
		}else{
			$ret = null;
		}

		//DB接続終了
		$this->closeConnection();
		
		return $ret;
	}

}
?>