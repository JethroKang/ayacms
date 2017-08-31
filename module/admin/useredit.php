<?php

$id=(int)$_GET['id'];

$u=get_user($id);

if($u['id']<1){
	yun_error('用户不存在');
}



if(IS_POST){
	$team=intval($_POST['team']);
	$name=trim((string)$_POST['name']);
	$pass=trim((string)$_POST['pass']);
	$email=trim((string)$_POST['email']);
	
	
	
	
	if(empty($BPV[2])){
		$C['sys_teams'][$team]['pvs'][2]&&yun_error('权限不足,无法编辑该用户组成员');
		$C['sys_teams'][$u['team']]['pvs'][2]&&yun_error('权限不足,无法编辑该用户');
	}
	if(strlen($pass)>0){
		strlen($pass)<5&&yun_error('密码不能少于5位','yun_onfocus("pass");');
		$pass=md5(md5($pass));
	}
	preg_match("/^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,3}$/",$email) or yun_error('邮箱格式不正确','yun_onfocus("email");');
	
	
	if($DB->fetch_first("select * from ".PF."user where email='".addslashes($email)."' && id<>'$id'")){
		yun_error('邮箱已存在','yun_onfocus("email");');
	};
	
	$tabdata=tab::post ($C ['user_tabs']['diss']);
	
	$arr=array();
	$arr['team']=$team;
	$arr['email']=$email;
	$arr['sex']=$_POST['sex']?1:0;
	
	if($pass){
		$arr['pass']=$pass;
	}
	
	$arr=array_merge($arr,$tabdata);
	
	$str=sql_update($arr);
	
	if($DB->query("update ".PF."user set $str where id='$id'")){
		yun_succeed('修改成功','f');
	}else{
		yun_error('修改失败');
	}
}
?>