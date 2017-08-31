<?php

if(!defined('ABSPATH'))
	exit('Access Denied');

if(isset($_SERVER['HTTP_X_REWRITE_URL'])){
	$_SERVER['REQUEST_URI']=$_SERVER['HTTP_X_REWRITE_URL'];
}
@error_reporting(E_ALL^E_NOTICE);
require_once (ABSPATH.'static/lib.php');
@set_magic_quotes_runtime(0);
@ini_set('magic_quotes_sybase',0);
mb_internal_encoding('UTF-8');
if(get_magic_quotes_gpc()){
	$_POST=stripslashe($_POST);
	$_GET=stripslashe($_GET);
	$_COOKIE=stripslashe($_COOKIE);
}
header('Content-Type: text/html; charset=utf-8');
if(version_compare('5.0',phpversion(),'>')){
	die('当前服务器php版本过低.当前'.phpversion().',需要5.0+');
}

if(file_exists(ABSPATH.'config/config.php')){
	$_ini=require (ABSPATH.'config/config.php');
}else{
	
	if(is_file(ABSPATH.'install.php'))
		header('Location: ./install.php');
	else
		die('程序未安装');
	exit();
}
timer_start();
$DB=new mysql($_ini['dbhost'],$_ini['dbuser'],$_ini['dbpw'],$_ini['dbname']);
define('PF',$_ini['dbprefix']);
define('ROOTPATH',$_ini['rootpath']);
define('R',ROOTPATH);
define('TIMEZONE',$_ini['timezone']);
define('WEBKEY',$_ini['webkey']);
define('NONEIMG',R.'static/image/none.gif');
define('NONEIMG_SEX0',R.'static/image/sex0.jpg');
define('NONEIMG_SEX1',R.'static/image/sex1.jpg');
define('DOCROOT',docroot());
define('VER',$_ini['ver']);
$file=ABSPATH.'cache/update.lock';
if($_ini['abspath']!=md5(ABSPATH)){
	if(upconfig($_ini['abspath'],md5(ABSPATH))){
		@unlink($file);
	}else
		die('更新./cache/config.php出错');
}
unset($_ini);
function_exists('date_default_timezone_set')&&date_default_timezone_set(TIMEZONE);
define('TIME',time());
$G=array ();

$C=require (ABSPATH.'static/config.php');

get_conf();
$G['tabs']=get_tab();
$G['channels']=get_channel();

define('DOADMIN','http://'.$_SERVER['HTTP_HOST']);

define('IS_REWRITE',!empty($C['sys_rewrite']));

define('UPDATE',!is_file(ABSPATH.'cache/update.lock'));

if(UPDATE){
	write_file($file,'0');
}

define('DEBUG',!empty($C['sys_debug']));

$yun_hooks=array ();
$__G=array ();
define('IS_POST',strtoupper($_SERVER['REQUEST_METHOD'])=='POST');
define('IS_AJAX',isset($_GET['inajax'])||isset($_POST['inajax']));
IS_AJAX&&XMLheader();
yun_load_module();
yun_load_field();

$P=router();

define('CURL','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

define('MODPATH',ABSPATH.'module/'.MOD.'/');

yun_load_theme();
if(MOD=='admin'){
	define('THEMENAME','admin');
}elseif(isset($_COOKIE[PF.'yun_theme'])&&isset($theme_conf[(string)$_COOKIE[PF.'yun_theme']])){
	define('THEMENAME',(string)$_COOKIE[PF.'yun_theme']);
}else if(isset($theme_conf[$C['sys_theme']])){
	define('THEMENAME',$C['sys_theme']);
}else
	define('THEMENAME','default');
define('THEMEDIR',ABSPATH.'theme/'.THEMENAME.'/');
define('THEMEPATH',ROOTPATH.'theme/'.THEMENAME.'/');
define('TP',THEMEPATH);

$tag_diy=$tag_layer=array ();
if(file_exists($file=THEMEDIR.'cache/diy')){
	$tag_diy=unserialize(read_file($file));
}

if(file_exists($file=THEMEDIR.'cache/layer')){
	$tag_layer=unserialize(read_file($file));
}

if(file_exists($file=THEMEDIR.'__init.php'))
	require_once ($file);
$U=currentuser();
$BPV=basepv();

if(file_exists($file=MODPATH.'__class.php'))
	require_once ($file);

require_once (MODPATH.'__init.php');
init_module();

defined('ACTION') or die('ACTION在__init未赋值');

yun_load_part();

yun_load_tag();

define('ACTIONDIR',ABSPATH.'module/'.MOD.'/');
define('ACTIONPATH',R.'module/'.MOD.'/');
define('AP',ACTIONPATH);

$file=get_action();

is_file($file) or yun_msg('danger','非法应用!');

include_once $file;

$file=get_action_tpl();

if(is_file($file)){
	
	ob_start();
	include_once $file;
	$_tpl=ob_get_contents();
	ob_end_clean();
	apply('content',"\n\n".$_tpl."\n\n");
}

$_tpl_file=get_template();
$_tag_update=false;
$_tag_html=array ();
if(file_exists($file=ABSPATH.'cache/tag_data_'.THEMENAME.'_'.THEMEFILE)){
	$_tag_html=unserialize(read_file($file));
}
if(MOD!='admin'&&!empty($C['sys_count']))
	apply('footer','timer_end()',10000,true);
include_once $_tpl_file;
if($_tag_update)
	yun_tag_update();
exit();
