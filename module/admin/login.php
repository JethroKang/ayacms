<?php

if(IS_POST){
	session_start();
	$_POST['name']==''&&yun_error('请填写用户名','yun_onfocus("name");');
	$_POST['pass']==''&&yun_error('请填写密码','yun_onfocus("pass");');
	$captcha=strtolower($_POST['captcha']);
	strlen($captcha)<1&&yun_error('请填写验证码','yun_onfocus("captcha");');
	if($_SESSION['code']!=$captcha){
		$_SESSION['code']=strrand(10);
		yun_error('验证码不符','yun_onfocus("captcha");recaptcha();');
	}
	str_is_int($_POST['name'])&&yun_error('错误的用户名','yun_onfocus("name");');
	$u=get_user($_POST['name']);
	if($u['id']<1){
		yun_error('用户不存在','yun_onfocus("name");');
	}
	$u['pass']!=md5(md5($_POST['pass']))&&yun_error('密码错误','yun_onfocus("pass");recaptcha();');
	setcookie(PF.'yun_user',encrypt($u['id']."\t".$u['name']),0,ROOTPATH);
	$_SESSION['code']=strrand(10);
	yun_succeed('登录成功',url(R.'admin/'));
}
?>