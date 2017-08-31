<?php
if (IS_POST) {
	session_start ();
	$_POST ['name'] == '' && yun_error ( '请填写用户名', 'yun_onfocus("name");' );
	$_POST ['pass'] == '' && yun_error ( '请填写密码', 'yun_onfocus("pass");' );
	$captcha = strtolower ( $_POST ['captcha'] );
	strlen ( $captcha ) < 1 && yun_error ( '请填写验证码', 'yun_onfocus("captcha");' );
	$_SESSION ['code'] != $captcha && yun_error ( '验证码不符', 'yun_onfocus("captcha");recaptcha();' );
	str_is_int ( $_POST ['name'] ) && yun_error ( '错误的用户名', 'yun_onfocus("name");' );
	$u = get_user ( $_POST ['name'] );
	if ($u ['id'] < 1)
		yun_error ( '用户不存在', 'yun_onfocus("name");' );
	strlen ( $_POST ['pass'] ) < 5 && yun_error ( '密码不能少于5位', 'yun_onfocus("pass");' );
	$pass = md5 ( md5 ( $_POST ['pass'] ) );
	$key = encrypt ( $u ['id'] . "\t" . TIME . "\t" . $pass . "\t" . $u ['id'] );
	$link = $C ['sys_host'] . url ( R . 'user/pass/?tokey=' . urlencode ( $key ) );
	$title = str_replace ( array (
			'[webname]',
			'[name]' 
	), array (
			$C ['sys_webname'],
			$u ['name'] 
	), $C ['sys_pass_t'] );
	$_url = '<a href="http://' . $link . '" target="_blank">' . html ( 'http://' . $link ) . '</a>';
	$body = str_replace ( array (
			'[webname]',
			'[name]',
			'[url]' 
	), array (
			$C ['sys_webname'],
			$u ['name'],
			$_url 
	), $C ['sys_pass_c'] );
	ob_start ();
	$msg = yun_mail ( $u ['email'], $title, $body, $u ['name'] );
	ob_end_clean ();
	if ($msg !== true)
		yun_error ( $msg );
	$_SESSION ['code'] = strrand ( 10 );
	yun_succeed ( '发送成功,请查收邮件' );
}
if (isset ( $_GET ['tokey'] )) {
	$k = explode ( "\t", decrypt ( $_GET ['tokey'] ) );
	$k [0] = intval ( $k [0] );
	$k [1] = intval ( $k [1] );
	$k [3] = intval ( $k [3] );
	$pass = $k [2];
	$k [0] == $k [3] or yun_error ( '无效的激活码', url(R) );
	(TIME - 24 * 3600) > $k [1] && yun_error ( '该链接已过期', url(R) );
	$u = get_user ( $k [0] );
	if ($u ['id'] < 1)
		yun_error ( '用户不存在', url(R) );
	if ($DB->query ( "update " . PF . "user set pass='" . addslashes ( $pass ) . "' where id='$u[id]'" )) {
		yun_succeed ( '密码修改成功', url(R.'user/login/') );
	} else {
		yun_error ( '密码修改失败', url(R) );
	}
}
?>