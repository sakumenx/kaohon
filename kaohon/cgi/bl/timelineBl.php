<?php
require_once("../dao/timelineDao.php");
require_once("../dao/commentTblDao.php");
require_once("../dao/goodTblDao.php");

class timelineBl {
	
	/** 一発目. */
	function getTimelineInitial($vo) {
		$dao = new timelineDao();
		$tl = $dao->getTimeline($vo,false);

		return $this->getTimelineSub($tl);
	}

	/** 二発目以降. */
	function getTimelineNext($vo) {
		$dao = new timelineDao();
		$tl = $dao->getTimeline($vo,false);
		
		return $this->getTimelineSub($tl);
	}

	/** . */
	function getTimelinePrevious($vo) {
		$dao = new timelineDao();
		$tl = $dao->getTimeline($vo,true);
	
		return $this->getTimelineSub($tl);
	}
	
	/** 共通サブルーチン. */
	private function getTimelineSub($tl) {
		$dao = new commentTblDao();
		$comments = $dao->getCommentCountList($tl);
		
		$dao = new goodTblDao();
		$goods = $dao->getGoodCountList($tl);
		
		$ret = Array();
		$timeline = Array();
		for($i=0;$i<count($tl);$i++){
			$messageId = $tl[$i]["messageId"];
			$tl[$i]["commentCount"] = isset($comments[$messageId]) ? $comments[$messageId] : "0";
			$tl[$i]["goodCount"]= isset($goods[$messageId]) ? $goods[$messageId] : "0";
			$timeline[] = $tl[$i];
		}
		$ret["timeline"] = $timeline;
		
		return $ret;
	}
}
?>