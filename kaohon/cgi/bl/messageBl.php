<?php
require_once("../dao/messageTblDao.php");


class messageBl {
	function addMessage($vo) {
		$message = $vo["message"];
		if(100<mb_strlen($message,"UTF-8")){
			return Array("result"=>false,"reason"=>"メッセージは100文字以内です。");
		}else if(mb_strlen(trim($message,"UTF-8"))==0){
			return Array("result"=>false,"reason"=>"メッセージが空です。");
		}
		
		$dao = new messageTblDao();
		$result = $dao->addMessage($vo);
		
		$ret = Array("result"=>$result);
		
		return $ret;
	}
}
?>