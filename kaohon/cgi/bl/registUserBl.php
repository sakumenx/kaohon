<?php
require_once("../dao/userTblDao.php");
require_once("../dao/friendTblDao.php");

class registUserBl {
	function validRegistrationData($vo){
		$userName = $vo["userName"];
		$mailAddress = $vo["mailAddress"];
		$familyName = $vo["familyName"];
		$firstName = $vo["firstName"];
		$description = $vo["description"];
		$password1 = $vo["password1"];
		$password2 = $vo["password2"];
		
		//入力チェック
		if (trim($mailAddress)==""){
			return Array(
					"result"=>false,
					"reason"=>"メールアドレスを入力してください。"
			);
		}
		if (!preg_match("/^[a-zA-Z0-9\_\!\#\*\+\/\=\?\-\.]+@[a-zA-Z0-9\_\!\#\*\+\/\=\?\-\.]+$/", $mailAddress)) {
			return Array(
					"result"=>false,
					"reason"=>"メールアドレス形式が不正です。"
			);
		}
		if (50<mb_strlen($mailAddress,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"50文字以上のメールアドレスは登録できません。"
			);
		}
		
		//入力チェック
		if (trim($userName)==""){
			return Array(
					"result"=>false,
					"reason"=>"ユーザー名を入力してください。"
			);
		}
		if (!preg_match("/^[a-zA-Z0-9]+$/", $userName)) {
			return Array(
					"result"=>false,
					"reason"=>"ユーザー名は半角英数字のみです。"
			);
		}
		if (20<mb_strlen($userName,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"ユーザー名は20文字以内です。"
			);
		}
		
		if (20<mb_strlen($familyName,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"ファミリーネームは20文字以内です。"
			);
		}
		
		if (20<mb_strlen($firstName,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"ファーストネームは20文字以内です。"
			);
		}

		if (200<mb_strlen($description,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"自己紹介は200文字以内です。"
			);
		}
		
		//入力チェック
		if ($password1=="" || $password2==""){
			return Array(
					"result"=>false,
					"reason"=>"パスワードを入力してください。"
			);
		}
		//パスワードチェック
		if ($password1 != $password2){
			return Array(
					"result"=>false,
					"reason"=>"パスワードが一致しません。"
			);
		}
		if (50<mb_strlen($password1,"UTF-8") || 50<mb_strlen($password2,"UTF-8")){
			return Array(
					"result"=>false,
					"reason"=>"パスワードは50文字以内です。"
			);
		}
		
		//パスワード範囲チェック
		if (!preg_match("/^[a-zA-Z0-9\_\!\#\*\+\/\=\?\-\.]+$/", $password1)){
			return Array(
					"result"=>false,
					"reason"=>"パスワードに使用できる文字は、半角英数字と、記号　_!#*+/=?-. のいずれかです。"
			);
		}
		
		//ユーザー名チェック
		$dao = new userTblDao();
		$count = $dao->getUserNameCount($vo);
		if($count["count"]!="0"){
			return Array(
					"result"=>false,
					"reason"=>"ユーザー名 " . $vo["userName"] . " はすでに使われています。"
					);
		}
		
		//
		return Array("result"=>true);
	}
	
	function registUser($vo){
		$dao = new userTblDao();
		if(!$dao->registUser($vo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
					);
		}
		
		$userIdVo = $dao->getUserId($vo);
		$userId = $userIdVo["userId"];
		
		$dao = new friendTblDao();
		if(!$dao->addUser($userIdVo)){
			return Array(
					"result"=>false,
					"reason"=>"予期せぬ登録エラー"
			);
		}
		
		return Array("result"=>true,"userId"=>$userId);
	}
}

?>