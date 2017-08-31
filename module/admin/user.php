<?php
set_val ( 'current_mainmenu_title', 'weihu' );
set_val ( 'current_mainmenu_list', 'weihu_' . ACTION );

$pg_d = 20;
$pg_c = $P[1] < 1 ? 1 : $P[1];
$pg_s = $pg_d * ($pg_c - 1);
$s = $_GET ['s'];
$e = $_GET ['e'];
$skey = $_GET ['skey'];
$teamid = $_GET ['teamid'] != '' ? intval ( $_GET ['teamid'] ) : '';
$arr = array ();
$where = array ();
if (! empty ( $skey )) {
	$where [] = 'name like \'%' . addslashes ( $skey ) . '%\'';
}
if ($teamid !== '') {
	$where [] = 'team=' . $teamid;
}
if (! empty ( $s ) or ! empty ( $e )) {
	if (empty ( $s )) {
		$s = date ( 'Y-m-d', TIME );
	}
	if (empty ( $e )) {
		$e = date ( 'Y-m-d', TIME );
	}
	$stime = strtotime ( $s );
	$etime = strtotime ( $e ) + 24 * 3600;
	$where [] = 'reg_time>=\'' . $stime . '\' && reg_time<\'' . $etime . '\'';
}
$where [] = '1=1';
$wherestr = implode ( ' && ', $where );
$result = $DB->query ( "select * from " . PF . "user where $wherestr order by reg_time desc LIMIT $pg_s,$pg_d" );
while ( $row = $DB->fetch_array ( $result ) ) {
	$id = $row ['id'];
	$arr [$id] = $row;
	$arr [$id] ['reg_time'] = showtime ( $row ['reg_time'] );
	$arr [$id] ['sex'] = $row ['sex'] ? '女' : '男';
	$arr [$id] ['team'] = html ( $C ['sys_teams'] [$row ['team']] ['name'] );
}
$rs = $DB->query ( "select id from " . PF . "user where " . $wherestr );
$num = $DB->num_rows ( $rs );

$page = page ( RMA . '(*)/', $pg_c, $num, $pg_d );
