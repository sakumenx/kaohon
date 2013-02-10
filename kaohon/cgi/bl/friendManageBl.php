<?php
require_once("../dao/friendListDao.php");
require_once("../dao/friendRequestTblDao.php");
require_once("../dao/friendTblDao.php");

class friendManageBl {
	function searchFriend($vo) {
		$friendName = $vo["friendName"];
		$friendNameList = mb_split(" +", trim(mb_ereg_replace("　", " ", $friendName)));
		//条件チェック
		if(3<count($friendNameList)) {
			return Array("friendRequestList"=>null,"reason"=>"指定可能な条件は3個までです。");
		}
		if($friendNameList[0]=="") {
			return Array("friendRequestList"=>null,"reason"=>"条件が指定されていません。");
		}
		
		$vo["friendNameList"] = $friendNameList;
		
		$dao = new friendListDao();
		$result = $dao->searchFriend($vo);
		
		return Array("friendRequestList"=>$result);
	}
	
	function requestFriend($vo) {
		$dao = new friendRequestTblDao();
		$count =$dao->getFriendRequestCount($vo); 
		if($count["count"]!="0"){
			return Array(
					"result"=>false,
					"reason"=>"申請済みです"
					);
		}
		
		if(!$dao->addFriendRequest($vo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
			);
		}
		
		return Array(
				"result"=>true,
				"reason"=>"友達申請しました"
				);
	}
	
	function getFriendRequet($vo) {
		$dao = new friendListDao();
		$result = $dao->getFriendRequest($vo);
		
		return Array("friendRequestList"=>$result);
	}
	
	function confirmFriendRequest($vo){
		$dao = new friendRequestTblDao();
		if(!$dao->removeFriendRequest($vo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
			);
		}

		$dao = new friendTblDao();
		if(!$dao->addFriend($vo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
			);
		}

		$dao = new friendTblDao();
		if(!$dao->addFriendReverse($vo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
			);
		}
		
		return Array("result"=>true);
	}
	
	function getFriendList($vo) {
		$dao = new friendListDao();
		$result = $dao->getFriendList($vo);
	
		return Array("friendList"=>$result);
	}
}
?>