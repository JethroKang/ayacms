<?php
$softname='AyaCMS';
$ver='2.0.0';
$dirs=array (
		'cache',
		'config',
		'backup',
		'upload' 
);
$tabs=array (
		'val',
		'page',
		'user',
		'tag',
		'tab',
		'channel' 
);
header('Content-Type: text/html; charset=utf-8');
define('ROOT','./');
define('ABSPATH',dirname(__file__).'/');
define('SYSTIME',time());
if(isset($_GET['post'])){
	
	if(!function_exists('gd_info')){
		e('服务器未安装GD库');
	}
	if(!ini_get('short_open_tag')){
		e('服务器未启用短标记');
	}
	if(PHP_VERSION<'5.0.0'){
		e('服务器PHP版本太低');
	}
	
	$v=$_POST['v'];
	if(file_exists('./config/config.php')){
		e('如果要重装系统,请先删除./config/config.php');
	}
	while(list($key,$val)=@each($dirs)){
		write_file('./'.$val.'/index.html','0') or e('目录:'.$val.'不可写入');
	}
	@mysql_connect($v[0],$v[2],$v[3]) or e('无法链接数据库');
	mysql_get_server_info()<'5.0'&&e('数据库版本过低');
	@mysql_query("CREATE DATABASE `$v[1]` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
	@mysql_select_db($v[1]) or e('无法链接数据库');
	@mysql_query("SET NAMES 'utf8'");
	$s_pf='dodo_';
	foreach($tabs as $key=>$tab){
		$tabs[$key]=$v[4].$tab;
	}
	if(empty($v[7])){
		$result=mysql_query('show tables');
		while($row=mysql_fetch_row($result)){
			in_array($row[0],$tabs)&&e('数据表已存在');
		}
	}
	// @mysql_query('DROP TABLE IF EXISTS `'.implode('`,`',$tabs).'`');
	if(!$fp=fopen('static/mysql_'.(empty($v[8])?'empty':'data').'.sql','rb')){
		e('无法打开文件');
	}
	isset($v[5][2]) or e('管理员名称不能少于3位');
	str_is_int($v[5])&&e('管理员名称不能全字数字');
	isset($v[6][4]) or e('管理员密码不能少于5位');
	$buffe='';
	while(!feof($fp)){
		$linestr=fgets($fp,1024);
		if(substr($linestr,0,2)=='--'||strlen(trim($linestr))<1)
			continue;
		if(strlen($buffe)<1){
			$buffe.=$linestr;
			if(substr($buffe,-2)==";\n"){
				$buffe=str_replace($s_pf,$v[4],$buffe);
				@mysql_query(trim($buffe)) or e('创建数据表出错:'.$buffe);
				$buffe='';
				continue;
			}
		}else{
			$buffe.=$linestr;
			if(substr($buffe,-2)==";\n"){
				$buffe=str_replace($s_pf,$v[4],$buffe);
				@mysql_query(trim($buffe)) or e('创建数据表出错:'.$buffe);
				$buffe='';
				continue;
			}
		}
	}
	fclose($fp);
	$v[6]=md5(md5($v[6]));
	mysql_query("INSERT INTO `".$v[4]."user` (`id`, `name`,`pass`, `reg_time`,`team`) VALUES
(1, '".addslashes($v[5])."', '".$v[6]."','".SYSTIME."',4)");
	if(!write_file('./config/config.php','<?php
if (!defined(\'ABSPATH\'))
    exit(\'Access Denied\');
    //本文件由安装程序生成,请勿随意更改;
return array(
\'ver\' => \''.$ver.'\',			 
\'dbhost\' => \''.$v[0].'\',
\'dbname\' => \''.$v[1].'\',
\'dbuser\' => \''.$v[2].'\',
\'dbpw\' => \''.$v[3].'\',
\'dbprefix\' => \''.$v[4].'\',
\'rootpath\'=>\''.substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],'/')+1).'\',
\'timezone\'=>\'Asia/Shanghai\',
\'abspath\'=>\''.md5(ABSPATH).'\',			
\'webkey\'=>\''.strrand().'\',
);

?>')){
		e('无法生成配置文件');
	}
	upcache();
	y();
}
function y(){
	echo '<html><body>';
	echo '<script language="javascript">';
	echo 'parent.pp();';
	echo '</script>';
	echo '</body></html>';
	exit();
}
function e($str){
	echo '<html><body>';
	echo '<script language="javascript">';
	echo 'parent.msg("<span style=\\"color:red\\">警告!</span> '.$str.'");';
	echo '</script>';
	echo '</body></html>';
	exit();
}
function write_file($root,$data,$mode='wb'){
	if(!$fp=@fopen($root,$mode)){
		return false;
	}
	flock($fp,LOCK_EX);
	fwrite($fp,$data);
	flock($fp,LOCK_UN);
	fclose($fp);
	return true;
}
function strrand($length=20){
	$hash='';
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max=strlen($chars)-1;
	for($i=0;$i<$length;$i++){
		$hash.=$chars[mt_rand(0,$max)];
	}
	return $hash;
}
function upcache(){
	setcookie(PF.'yun_theme','',0,ROOT);
	$dirName=ABSPATH.'cache';
	if($handle=@opendir($dirName)){
		while(false!==($item=readdir($handle))){
			if($item!='.'&&$item!='..'){
				@unlink($dirName.'/'.$item);
			}
		}
		closedir($handle);
		write_file($dirName.'/index.html','0');
		return true;
	}
}
function str_is_int($str){
	return preg_match("/^[0-9]+$/",$str);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>AyaCMS 安装</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="static/bootstrap/3.1.0/css/bootstrap.min.css"
	rel="stylesheet">
<script type="text/javascript" src="static/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript"
	src="static/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<style>
body {
	text-align: center;
	background-color: #FFF;
	background-image: none;
}

#container {
	width: 700px;
	margin-right: auto;
	margin-left: auto;
	text-align: left;
	padding: 20px;
	border: 10px solid #eee;
	margin-top: 20px;
	margin-bottom: 20px;
}

#header {
	line-height: 30px;
	height: 80px;
}

#footer {
	text-align: right;
	line-height: 20px;
	margin-top: 30px;
}
</style>
</head>
<body>
	<div id="container">
		<div id="header">
			<span
				style="font-size: 18px; font-weight: bold; font-family: Comic Sans MS;">
    <?php echo $softname?>
    </span>
			<span style="font-size: 12px;">
    <?php echo $ver?>
    
    </span>
			的安装
			<br />
			<span style="font-size: 14px">感谢您使用.请您正确设置以下参数.</span>
		</div>
		<div style="margin: 0 0 20px; text-align: right">
<?php
$s_str='<span style="color:#0C0">√</span>';
$e_str='<span style="color:#090">×</span>';
?>
PHP版本: <?php echo PHP_VERSION<'5.0.0'?$e_str:$s_str?> GD库: <?php echo function_exists('gd_info')?$s_str:$e_str?> 短标记: <?php echo ini_get('short_open_tag')?$s_str:$e_str?>
</div>
		<form class="form-horizontal" id="form" action="?post" method="post"
			enctype="multipart/form-data" target="ajax">
			<div class="in">

				<div class="form-group">
					<label class="col-sm-2 control-label">Mysql地址</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[0]"
							placeholder="必填" value="localhost" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Mysql名称</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[1]"
							placeholder="必填" value="ayacms" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Mysql用户</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[2]"
							placeholder="必填" value="root" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Mysql用户密码</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[3]" placeholder=""
							value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">表名前缀</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[4]"
							placeholder="必填" value="dodo_" />
					</div>
				</div>

				<hr />


				<div class="form-group">
					<label class="col-sm-2 control-label">管理员</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[5]"
							placeholder="字母或数字,3-12位" value="admin" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">登陆密码</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="v[6]"
							placeholder="必填" value="admin" />
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-2 control-label">使用协议</label>
					<div class="col-sm-9">
						<textarea name="textarea" style="width: 90%; height: 120px"
							readonly="readonly">
    不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。 
    禁止在 AyaCMS 的整体或任何部分基础上发展任何派生版本、修改版本或第三方版本用于重新分发。
    使用 AyaCMS 建立的站点,页面尾部必须标注开发者名称及其链接,除官方授权外,不可删除。
    如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。 </textarea>
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-5">
						<span id="msg">
							<span style="color: #090">等待安装...</span>
						</span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary"
							onclick="msg('请等待');">遵守协议,并安装</button>
						<button type="reset" class="btn btn-default">重置</button>
					</div>
				</div>

<div class="form-group">
					<div class="col-sm-offset-2 col-sm5">
						<div class="checkbox">
							<label>
								<input id="n8" name="v[8]" value="1" class="checkbox"
									type="checkbox" />
								安装测试数据(管理员账号: admin 密码: admin)
							</label>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm5">
						<div class="checkbox">
							<label>
								<input id="n7" name="v[7]" value="1" class="checkbox"
									type="checkbox" />
								如果数据表存在,就覆盖它
							</label>
						</div>
					</div>
				</div>





			</div>

		</form>
		<div id="footer">

			本软件归
			<a style="font-weight: bold;" href="http://www.ayacms.com/">AyaCMS</a>
			所有
			<br />
AyaCMS <?php echo $ver?> 于 06/01/2014 发布
		</div>
	</div>
	<iframe id="ajax" name="ajax" style="display: none;"></iframe>
	<script type="text/javascript">
function pp(){
	document.getElementById("msg").innerHTML='<span style="color: #090;">安装结束,准备跳转...</span>';
	setTimeout("location.href='./?admin/login/'",500);
	
}
function msg(str){
	document.getElementById("msg").innerHTML=str;
	
}
</script>
</body>
</html>
