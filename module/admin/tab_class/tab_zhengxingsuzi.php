<?php
class tab_zhengxingsuzi {
	function tpl($type, $id=0) {
		global $G;
		
		if($id>0){
		$tab=$G['tabs'][$id];
		}
		
		ob_start ();
		if (is_file ( $file = ABSPATH . 'module/admin/tab_class/tpl/zhengxingsuzi.php' ))
			include $file;
		
		$tpl = ob_get_contents ();
		ob_end_clean ();
		
		return $tpl;
	}
	function tab_new($tabname) {
		global $DB, $G;
		
		$title = ( string ) $_POST ['title'];
		$info = ( string ) $_POST ['info'];
		$warning = ( string ) $_POST ['warning'];
		$conf = $_POST ['conf'];
		
		fstrlen ( $title, 1, 255 ) or yun_error ( '标题文字不在范围内', 'yun_onfocus("title");' );
		
		$conf [0] = intval ( $conf [0] );
		$conf [1] = intval ( $conf [1] );
		
		$conf [1] <= $conf [0] && yun_error ( '最大数不得小于最小数', 'yun_onfocus("conf[1]");' );
		
		fstrlen ( $info, 0, 255 ) or yun_error ( '提示文字不在范围内', 'yun_onfocus("info");' );
		fstrlen ( $warning, 1, 255 ) or yun_error ( '警告文字不在范围内', 'yun_onfocus("warning");' );
		
		//
		$DB->query ( "insert into " . PF . "tab() values()" );
		$tabid = $DB->insert_id ();
		
		$fieldname = 'tab_' . $tabid;
		
		$sql = 'ALTER TABLE  `' . PF . $tabname . '` ADD  `' . $fieldname . '` VARCHAR(' . $conf [1] . ') NOT NULL';
		
		if (! $DB->query ( $sql )) {
			$DB->query ( 'delete from ' . PF . 'tab where id=' . $tabid );
			yun_error ( '创建表失败' );
		}
		
		$arr = array (
				'fortab' => $tabname,
				'type' => 'zhengxingsuzi',
				'title' => $title,
				'info' => $info,
				'warning' => $warning,
				'conf' => serialize ( $conf ) 
		);
		
		$str = sql_update ( $arr );
		$DB->query ( "update " . PF . "tab set $str where id='$tabid'" );
		
		return true;
	}
	function tab_edit($id) {
		global $G, $DB;
		$tab = $G ['tabs'] [$id];
		$tabname = $tab ['fortab'];
		
		$title = ( string ) $_POST ['title'];
		$info = ( string ) $_POST ['info'];
		$warning = ( string ) $_POST ['warning'];
		
		$conf = $_POST ['conf'];
		
		fstrlen ( $title, 1, 255 ) or yun_error ( '标题文字不在范围内', 'yun_onfocus("title");' );
		
		$conf [0] = intval ( $conf [0] );
		$conf [1] = intval ( $conf [1] );
		
		$conf [1] <= $conf [0] && yun_error ( '最大数不得小于最小数', 'yun_onfocus("conf[1]");' );
		
		fstrlen ( $info, 0, 255 ) or yun_error ( '提示文字不在范围内', 'yun_onfocus("info");' );
		fstrlen ( $warning, 1, 255 ) or yun_error ( '警告文字不在范围内', 'yun_onfocus("warning");' );
		
		$sql = '';
		if ($conf [1] != $tab ['conf'] [1])
			$sql = 'ALTER TABLE  `' . PF . $tabname . '` CHANGE  `tab_' . $id . '`  `tab_' . $id . '` VARCHAR( ' . $c [1] . ' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL';
		
		if (strlen ( $sql ) > 0 && ! $DB->query ( $sql )) {
			yun_error ( '修改表时失败' );
		}
		
		$arr = array (
				'title' => $title,
				'info' => $info,
				'warning' => $warning,
				'conf' => serialize ( $conf ) 
		);
		
		$str = sql_update ( $arr );
		$DB->query ( "update " . PF . "tab set $str where id='$id'" );
		return true;
	}
	function tab_del($id) {
		global $G, $DB;
		$tab = $G ['tabs'] [$id];
		$tabname = $tab ['fortab'];
		

	$rs=$DB->query('DESC '.PF.$tabname);
		while($row=$DB->fetch_array($rs)){
			
			if($row['Field']=='tab_'.$id){
				$DB->query ( 'ALTER TABLE  `' . PF . $tabname . '` DROP  `tab_' . $id . '`' );
				break;
			}
			
		}
		$DB->query ( 'delete from ' . PF . 'tab where id=' . $id );
		
		
		foreach ($G['channels'] as $k=>$v){
			if(in_array($id,$v['tabs']['diss'])){
				$key = array_search ( $id, $v['tabs']['diss'] );
				unset ( $v['tabs']['diss'][$key] );
				$DB->query("update " . PF . "channel set tabs='".serialize($v['tabs'])."' where id='$k'");
			}
		}
		
		
		
		return true;
	}
}