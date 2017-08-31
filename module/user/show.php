<?php
$id = ( int ) $_GET ['id'];
if (empty ( $id )) {
	$u = $U;
	$u ['id'] < 1 && yun_error ( '请先登陆', url ( R . 'user/login/' ) );
	apply ( 'current', array (
			'我的资料' 
	) );
	apply ( 'tag_title', '我的资料' );
} else {
	empty ( $bpv [3] ) && yun_error ( '权限不足,无法查看用户信息' );
	$u = get_user ( $id );
	$u ['id'] < 1 && yun_error ( '用户不存在' );
	apply ( 'current', array (
			'用户资料' 
	) );
	apply ( 'tag_title', '用户资料' );
}
