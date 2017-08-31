<?php
if (IS_POST) {
	session_start ();
	
	$name=trim((string)$_POST['name']);
	$pass=trim((string)$_POST['pass']);
	$captcha=strtolower(trim((string)$_POST['captcha']));
	
	
	
	
	$name == '' && yun_msg ( '', '请填写用户名', 'yun_onfocus("name");' );
	$pass == '' && yun_msg ( '', '请填写密码', 'yun_onfocus("pass");' );
	
	
	strlen ( $captcha ) < 1 && yun_msg ( '', '请填写验证码', 'yun_onfocus("captcha");' );
	if ($_SESSION ['code'] != $captcha) {
		$_SESSION ['code'] = strrand ( 10 );
		yun_msg ( '', '验证码不符', 'yun_onfocus("captcha");recaptcha();' );
	}
	str_is_int ( $name) && yun_msg ( '', '错误的用户名', 'yun_onfocus("name");' );
	$u = get_user ( $name );
	if ($u ['id'] < 1) {
		yun_msg ( '', '用户不存在', 'yun_onfocus("name");' );
	}
	$u ['pass'] != md5 ( md5 ( $pass ) ) && yun_msg ( '', '密码错误', 'yun_onfocus("pass");recaptcha();' );
	setcookie ( PF . 'yun_user', encrypt ( $u ['id'] . "\t" . $u ['name'] ), $_POST ['ltime'] ? (TIME + 14 * 86400) : 0, ROOTPATH );
	$_SESSION ['code'] = strrand ( 10 );
	yun_msg ( 'success', '登录成功', 'refresh' );
}
?>