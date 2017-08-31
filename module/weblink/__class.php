<?php
class weblink {
	function channel_new($arr) {
		global $DB, $G;
		
		$arr ['link'] = '-null-';
		
		$str = sql_insert ( $arr );
		$DB->query ( "insert into " . PF . "channel $str" );
	}
	function channel_del($id) {
	}
	function channel_edit($id, $arr) {
		global $DB, $G;
		
		$str = sql_update ( $arr );
		$DB->query ( "update " . PF . "channel set $str where id='$id'" );
	}
}