<?php

$url='http://www.ayacms.com/forum/aya_file.php?aya_sid='.urlencode($_GET['sid']);

$data=read_file($url);

@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
@header("Pragma: no-cache");

if($data===false){
	exit('$$("view").innerHTML = "无法连接服务器";');
}

switch($data){
	
	case 0: //等待挑选
		exit('$$("view").innerHTML = "等待挑选...";');
		break;
	
	case 1: //发现应用
		$fileurl='http://www.ayacms.com/forum/aya_file.php?aya_sid='.urlencode($_GET['sid']).'&type=2';
		$fdata=read_file($fileurl);
		exit('$$("view").innerHTML = "发现通知";');
		break;
	
	case 2: //通知下载
		$fileurl='http://www.ayacms.com/forum/aya_file.php?aya_sid='.urlencode($_GET['sid']).'&type=3';
		$fdata=read_file($fileurl);
		exit('$$("view").innerHTML = "正在下载"');
		break;
	
	case 3: //保存
		

		$file=ABSPATH.'upload/temp/~app.zip';
		$fileurl='http://www.ayacms.com/forum/aya_file.php?aya_sid='.urlencode($_GET['sid']).'&type=4';
		if(!$fdata=read_file($fileurl))
			exit('stop');
		if(!write_file($file,$fdata))
			exit('$$("view").innerHTML = "upload/temp/ 不可写入"');
		
		exit('$$("view").innerHTML = "选择安装路径-> 1, <a onclick=\"mod_app_open(\''.url(RM.'app/?path=root&sid='.urlencode($_GET['sid'])).'\')\" href=\"javascript:void(0)\">根目录</a> 2, <a onclick=\"mod_app_open(\''.url(RM.'app/?path='.$C['sys_theme']).'&sid='.urlencode($_GET['sid']).'\')\" href=\"javascript:void(0)\">\"'.R.'theme/'.$C['sys_theme'].'\"目录</a> ";');
		
		break;
	case 4: //下载中
	case 100: //停止
		

		break;
	case 5:
		$fileurl='http://www.ayacms.com/forum/aya_file.php?aya_sid='.urlencode($_GET['sid']).'&type=0';
		$fdata=read_file($fileurl);
		exit('$$("view").innerHTML = "安装结束"');
		
		admin::upcache();
		break;
	
	default:
		exit();
}

exit();
