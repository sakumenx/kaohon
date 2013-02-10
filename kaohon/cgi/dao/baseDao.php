<?php
class baseDao {
	private $url = "localhost";
	private $user = "kaohon";
	private $pass = "kaohon";
	private $db = "kaohon";
	private $conn = null;
	
	/** DBへの接続を取得する. */
	function getConnection(){
		mb_language("uni");
		mb_internal_encoding("utf-8");
		mb_http_input("auto");
		mb_http_output("utf-8");
		
		if($this->conn==null){
			$this->conn = mysql_connect($this->url, $this->user, $this->pass);
			mysql_query("SET NAMES utf8",$this->conn);
			mysql_select_db($this->db, $this->conn);
		}
		return $this->conn;
	}
	
	/** DBへの接続を解除する. */
	function closeConnection(){
		if($this->conn!=null) {
			mysql_close($this->conn);
			$this->conn = null;
		}
		return null;
	}
}
?>