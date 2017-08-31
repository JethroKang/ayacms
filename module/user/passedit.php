<?php
if (IS_POST) {
	$arr = array ();
	strlen ( $_POST ['pass'] ) < 5 && yun_error ( '密码不能少于5位', 'yun_onfocus("pass");' );
	strlen ( $_POST ['pass2'] ) < 5 && yun_error ( '密码不能少于5位', 'yun_onfocus("pass2");' );
	$_POST ['pass2'] == $_POST ['rpass2'] or yun_error ( '两次密码不相同', 'yun_onfocus("rpass2");' );
	$U ['pass'] == md5 ( md5 ( $_POST ['pass'] ) ) or yun_error ( '旧密码不正确', 'yun_onfocus("pass");' );
	$arr ['pass'] = md5 ( md5 ( $_POST ['pass2'] ) );
	$sql = sql_update ( $arr );
	if ($DB->query ( "update " . PF . "user set $sql where id='$U[id]'" )) {
		yun_succeed ( '修改成功', url ( RM . 'show/' ) );
	} else {
		yun_error ( '修改失败' );
	}
}
apply ( 'current', array (
		'修改密码' 
) );
apply ( 'title', '修改密码' );
