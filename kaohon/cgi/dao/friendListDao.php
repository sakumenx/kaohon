<?php
require_once("baseDao.php");

/**
*/
class friendListDao extends baseDao {
	
	function searchFriend($vo){

		//DB接続開始
		$conn = $this->getConnection();
		
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
		$friendNameList = $vo["friendNameList"];
		
		$param = "";
		for($i=0;$i<count($friendNameList);$i++){
			$friendName = mysql_real_escape_string($friendNameList[$i]);
			$param = $param
					. "(usr.user_name like '" . $friendName . "%' or "
					. "usr.first_name like '" . $friendName . "%' or "
					. "usr.family_name like '" . $friendName . "%') and ";
		}
		$param = $param . "usr.user_id != '" . $userId . "'";
		
		//
		$sql = "select usr.user_id,usr.user_name,usr.family_name,usr.first_name,usr.description,"
				. "frd.user_id as is_friend,is_req.user_id as is_requested,has_req.user_id as has_requested "
				. "from user_tbl as usr "
				. "left join friend_tbl as frd "
				. "on usr.user_id = frd.friend_id and '" . $userId . "' = frd.user_id "
				. "left join friend_request_tbl as is_req "
				. "on usr.user_id = is_req.user_id and '" . $userId . "' = is_req.friend_id "
				. "left join friend_request_tbl as has_req "
				. "on usr.user_id = has_req.friend_id and '" . $userId . "' = has_req.user_id "
				. "where " . $param . ";";
		
		//
		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$ret[] = Array(
						"userId"=>$row[0],
						"userName"=>$row[1],
						"familyName"=>$row[2],
						"firstName"=>$row[3],
						"description"=>$row[4],
						"isFriend"=>(null!=$row[5]),
						"isRequested"=>(null!=$row[6]),
						"hasRequested"=>(null!=$row[7])
				);
			}
		}else{
			$ret = null;
		}
		
		//DB接続終了
		$this->closeConnection();
		
		return $ret;
	}
	
	
	function getFriendRequest($vo){
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
	
		//
		$sql = "select usr.user_id,usr.user_name,usr.family_name,usr.first_name,usr.description "
				. "from friend_request_tbl as req "
				. "left join user_tbl as usr "
				. "on req.user_id = usr.user_id "
				. "where req.friend_id = '" . $userId . "';";
		
		//
		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$ret[] = Array(
						"userId"=>$row[0],
						"userName"=>$row[1],
						"familyName"=>$row[2],
						"firstName"=>$row[3],
						"description"=>$row[4]
				);
			}
		}else{
			$ret = null;
		}
			
		//DB接続終了
		$this->closeConnection();
	
		return $ret;	
	}
	
	function getFriendList($vo){
		//DB接続開始
		$conn = $this->getConnection();
	
		//条件取得
		$userId = mysql_real_escape_string($vo["userId"]);
	
		//
		$sql = "select usr.user_id,usr.user_name,usr.family_name,usr.first_name,usr.description "
				. "from friend_tbl as frd "
				. "left join user_tbl as usr "
				. "on frd.friend_id = usr.user_id "
				. "where frd.user_id = '" . $userId . "' and frd.friend_id != '" . $userId . "';";
	
		//
		if($result = mysql_query($sql)){
			$ret = Array();
			while($row = mysql_fetch_row($result)){
				$ret[] = Array(
						"userId"=>$row[0],
						"userName"=>$row[1],
						"familyName"=>$row[2],
						"firstName"=>$row[3],
						"description"=>$row[4]
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