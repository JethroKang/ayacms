<?php
class webnull {
	function channel_new($arr) {
		global $DB, $G;
		
		$arr ['link'] = '';
		
		foreach ( $G ['channels'] as $v ) {
			if ($v ['link'] == $arr ['link'])
				yun_error ( '无法创建,栏目链接已占用' );
		}
		
		$str = sql_insert ( $arr );
		$DB->query ( "insert into " . PF . "channel $str" );
	}
	function channel_del($id) {
	}
	function channel_edit($id, $arr) {
		global $DB, $G;
		$arr ['link'] = '';
		
		foreach ( $G ['channels'] as $k => $v ) {
			if ($k != $id && $v ['link'] == $arr ['link'])
				yun_error ( '无法修改,栏目链接已占用' );
		}
		
		$str = sql_update ( $arr );
		$DB->query ( "update " . PF . "channel set $str where id='$id'" );
	}
}
