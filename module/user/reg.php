<?php

$U['id']>0&&yun_error('您已经登陆,不允许注册');
$C['sys_reg']=='off'&&yun_error('注册已关闭');
if(IS_POST){
	$arr2=array();
	session_start();
	str_is_int($_POST['name'])&&yun_error('用户名不能全为数字','yun_onfocus("name");');
	($t=strlen($_POST['name']))<3&&yun_error('用户名不能少于3位','yun_onfocus("name");');
	$k_regword=array_map('strtolower',$C['sys_kregword']);
	$k_name=strtolower($_POST['name']);
	$k_name!=str_replace($k_regword,'',$k_name)&&yun_error('用户名包含非法字符','yun_onfocus("name");');
	$t>12&&yun_error('用户名不能大于12位或4个汉字','yun_onfocus("name");');
	strlen($_POST['pass'])<5&&yun_error('密码不能少于5位','yun_onfocus("pass");');
	$_POST['pass']==$_POST['pass2'] or yun_error('密码不相同','yun_onfocus("pass2");');
	$pass=$arr2['pass']=md5(md5($_POST['pass']));
	preg_match("/^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,3}$/",$_POST['email']) or yun_error('邮箱格式不正确','yun_onfocus("email");');
	if($_SESSION['code']!=$_POST['captcha']){
		$_SESSION['code']=strrand(10);
		yun_error('验证码不符','yun_onfocus("captcha");recaptcha();');
	}
	$arr2['team']=$C['sys_regteam'];
	$result=$DB->query("select * from ".PF."user where name='".addslashes($_POST['name']).'\'');
	$DB->num_rows($result)&&yun_error('用户已存在','yun_onfocus("name");');
	$arr2['name']=$_POST['name'];
	$result=$DB->query("select * from ".PF."user where email='".addslashes($_POST['email'])."'");
	$DB->num_rows($result)&&yun_error('邮箱已存在','yun_onfocus("email");');
	$arr2['email']=$_POST['email'];
	$arr2['posts']=0;
	$arr2['sex']=$_POST['sex']?1:0;
	$arr2['reg_time']=TIME;
	if($C['sys_reg']=='email'){
		$uarr=$C['sys_email_regs'];
		foreach($uarr as $k=>$v){
			if((TIME-$v['reg_time'])>24*3600){
				unset($uarr[$k]);
				continue;
			}
			if($v['name']==$arr2['name'])
				yun_error('用户已存在','yun_onfocus("name");');
			if($v['email']==$arr2['email'])
				yun_error('邮箱已存在','yun_onfocus("email");');
		}
		$key=encrypt(serialize($arr2));
		$link=$C['sys_host'].url(R.'user/yz/?tokey='.urlencode($key));
		$title=str_replace(array('[webname]','[name]'),array($C['sys_webname'],$arr2['name']),$C['sys_reg_t']);
		$_url='<a href="http://'.$link.'" target="_blank">'.html('http://'.$link).'</a>';
		$body=str_replace(array('[webname]','[name]','[url]'),array($C['sys_webname'],$arr2['name'],$_url),$C['sys_reg_c']);
		ob_start();
		$msg=yun_mail($arr2['email'],$title,$body,$arr2['name']);
		ob_end_clean();
		if($msg!==true)
			yun_error($msg);
		$_SESSION['code']=strrand(10);
		$uarr[]=$arr2;
		set_conf('sys_email_regs',$uarr);
		yun_succeed('邮件已发送,请查收邮件,完成注册','refresh');
	}
	$sql=sql_insert($arr2);
	$_SESSION['code']=strrand(10);
	if($DB->query("insert into ".PF."user $sql")){
		setcookie(PF.'yun_user',encrypt($DB->insert_id()."\t".$_POST['name']),$_POST['temp']?0:(TIME+14*24*3600),ROOTPATH);
		yun_succeed('注册成功','f');
	}else{
		yun_error('注册失败');
	}
}
?>