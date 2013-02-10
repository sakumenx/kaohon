<?php
require_once("../dao/goodTblDao.php");

class goodBl {

	function addGood($vo) {
		$dao = new goodTblDao();
		$result = $dao->addGood($vo);
	
		$ret = Array("result"=>$result);
	
		return $ret;
	}
	
	function getGoodCount($vo) {
		$dao = new goodTblDao();
		$ret = $dao->getGoodCount($vo);
		
		return $ret;
	}
	
}
?>