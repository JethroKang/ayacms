<?php
class webpage {
	function channel_new($arr) {
		global $DB, $G;
		
		$arr ['link'] = $arr ['sign'] . '/';
		
		foreach ( $G ['channels'] as $v ) {
			if ($v ['link'] == $arr ['link'])
				yun_error ( '无法创建,栏目链接已占用' );
		}
		
		$str = sql_insert ( $arr );
		$DB->query ( "insert into " . PF . "channel $str" );
		
		$id = $DB->insert_id ();
		$DB->query ( "insert into " . PF . "page (id,post_time) values('" . $id . "','" . TIME . "')" );
	}
	function channel_del($id) {
		global $DB, $G;
		$DB->query ( "delete from " . PF . "page where id='$id'" );
	}
	function channel_edit($id, $arr) {
		global $DB, $G;
		$arr ['link'] = $arr ['sign'] . '/';
		
		foreach ( $G ['channels'] as $k => $v ) {
			if ($k != $id && $v ['link'] == $arr ['link'])
				yun_error ( '无法修改,栏目链接已占用' );
		}
		
		$str = sql_update ( $arr );
		$DB->query ( "update " . PF . "channel set $str where id='$id'" );
	}
}