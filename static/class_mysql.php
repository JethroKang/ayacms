<?php

if(!defined('ABSPATH'))
	exit('Access Denied');
class mysql{
	public $version='';
	public $querynum=0;
	public $link;
	private static $_instance=null;
	public function __construct($dbhost,$dbuser,$dbpw,$dbname){
		$this->connect($dbhost,$dbuser,$dbpw,$dbname);
	}
	public static function getinstance(){
		if(!self::$_instance){
			self::$_instance=new self();
		}
		return self::$_instance;
	}
	private function connect($dbhost,$dbuser,$dbpw,$dbname='',$pconnect=0,$halt=true,$dbcharset2=''){
		$func=empty($pconnect)?'mysql_connect':'mysql_pconnect';
		if(!$this->link=@$func($dbhost,$dbuser,$dbpw,1)){
			$halt&&$this->halt('Can not connect to MySQL server');
		}else{
			if($this->version()>'4.1'){
				$serverset='character_set_connection=utf8, character_set_results=utf8, character_set_client=binary';
				$serverset.=$this->version()>'5.0.1'?((empty($serverset)?'':',').'sql_mode=\'\''):'';
				mysql_query("SET $serverset",$this->link);
			}
			$dbname&&@mysql_select_db($dbname,$this->link);
		}
	}
	public function query($sql){
		if(!($query=@mysql_query($sql,$this->link))&&DEBUG){
			$this->halt(mysql_error(),$sql);
		}
		$this->querynum++;
		return $query;
	}
	public function fetch_array($query,$result_type=MYSQL_ASSOC){
		return mysql_fetch_array($query,$result_type);
	}
	public function fetch_first($sql){
		return $this->fetch_array($this->query($sql));
	}
	public function num_rows($query){
		return mysql_num_rows($query);
	}
	public function num_fields($query){
		return mysql_num_fields($query);
	}
	public function insert_id(){
		return ($id=mysql_insert_id($this->link))>=0?$id:$this->result($this->query("SELECT last_insert_id()"),0);
	}
	public function result($query,$row=0){
		$query=@mysql_result($query,$row);
		return $query;
	}
	public function fetch_row($query){
		$query=mysql_fetch_row($query);
		return $query;
	}
	public function close(){
		return mysql_close($this->link);
	}
	public function select_db($dbname){
		return mysql_select_db($dbname,$this->link);
	}
	public function data_seek($query,$offset){
		return mysql_data_seek($query,$offset);
	}
	public function version(){
		if(empty($this->version)){
			$this->version=mysql_get_server_info($this->link);
		}
		return $this->version;
	}
	public function halt($message='',$sql=''){
		echo '<b>Database Error.</b><h2>'.htmlspecialchars($sql).'</h2>
          <p>'.htmlspecialchars($message).'</p>';
		exit();
	}
}
?>