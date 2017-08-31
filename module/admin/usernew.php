<?php

if(IS_POST){
	$team=intval($_POST['team']);
	
	
	$name=trim((string)$_POST['name']);
	$pass=trim((string)$_POST['pass']);
	$email=trim((string)$_POST['email']);
	
	if(empty($bpv[2])){
		$C['sys_teams'][$team]['pvs'][2]&&yun_error('权限不足,无法赋予该用户组');
	}
	
	str_is_int($name)&&yun_error('用户名不能全为数字');
	strlen($name)<3&&yun_error('用户名不能少于3位','yun_onfocus("name");');
	if($DB->fetch_first("select * from ".PF."user where name='".addslashes($name).'\'')){
		yun_error('用户已存在','yun_onfocus("name");');
	};
	
	strlen($pass)<5&&yun_error('密码不能少于5位','yun_onfocus("pass");');
	$pass=md5(md5($pass));
	
	
	preg_match("/^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,3}$/",$email) or yun_error('邮箱格式不正确','yun_onfocus("email");');
	
	if($DB->fetch_first("select * from ".PF."user where email='".addslashes($email)."'")){
		yun_error('邮箱已存在','yun_onfocus("email");');
	};

$arr=array(
'name'=>$name,
'pass'=>$pass,
'email'=>$email,
'team'=>$team,
'posts'=>0,
'sex'=>$_POST['sex']?1:0,
'reg_time'=>TIME,

);

$str=sql_insert($arr);

	if($DB->query("insert into ".PF."user $str")){
		yun_succeed('创建成功',url(RM.'user/'));
	}else{
		yun_error('创建失败');
	}
}
?>