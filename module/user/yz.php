<?php
if (! isset ( $_GET ['tokey'] ))
	yun_error ( '激活码为空' );
$tokey = decrypt ( $_GET ['tokey'] );
@$arr = unserialize ( $tokey );
if (! is_array ( $arr ))
	yun_error ( '无效的激活码' );
$uarr = $C ['sys_email_regs'];
foreach ( $uarr as $k => $v ) {
	if ((TIME - $v ['reg_time']) > 24 * 3600) {
		unset ( $uarr [$k] );
		continue;
	}
}
$key = array_search ( $arr, $uarr );
if ($key === false)
	yun_error ( '该激活码已失效' );
unset ( $uarr [$key] );
$sql = sql_insert ( $arr );
if ($DB->query ( "insert into " . PF . "user $sql" )) {
	setcookie ( PF . 'yun_user', encrypt ( $DB->insert_id () . "\t" . $arr ['name'] ), TIME + 30 * 24 * 3600, ROOTPATH );
	set_conf ( 'sys_email_regs', $uarr );
	yun_succeed ( '激活成功', url ( R . 'user/' ) );
} else {
	yun_error ( '激活失败' );
}
?>