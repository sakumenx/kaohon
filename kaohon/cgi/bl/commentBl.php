<?php
require_once("../dao/commentTblDao.php");

class commentBl {

	function getCommentList($vo) {
		$dao = new commentTblDao();
		$ret = $dao->getCommentList($vo);
		
		return $ret;
	}
	
	function addComment($vo) {
		//入力チェック
		$comment = $vo["comment"];
		if(100<mb_strlen($comment,"UTF-8")){
			return Array("result"=>false,"reason"=>"コメントは100文字以内です。");
		}else if(mb_strlen(trim($comment,"UTF-8"))==0){
			return Array("result"=>false,"reason"=>"コメントが空です。");
		}
		
		$dao = new commentTblDao();
		$result = $dao->addComment($vo);
		
		$ret = Array("result"=>$result);
		
		return $ret;
	}
	
}
?>