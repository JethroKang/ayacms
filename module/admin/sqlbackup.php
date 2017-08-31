<?php
session_start();



if(IS_POST){
	//初次提交;
	$tabs=is_array($_POST['tabs'])?$_POST['tabs']:array();
    $size=abs(intval($_POST['size']));

empty($tabs) && yun_error('至少选择一个表');
$size<100&&yun_error('不能少于100K');
$dir=date("Ymd_".TIME,TIME);

$_SESSION['tabs']=$tabs;
$_SESSION['dir']=$dir;
$_SESSION['size']=$size;


$url=url(RM.'sqlbackup/?sumfile=1&rid=0&c_tabid=0');
yun_loading('正在备份(1)...','ajaxget("'.$url.'");');			

}

$tabs=$_SESSION['tabs'];
$dir=$_SESSION['dir'];
$size=(int)$_SESSION['size'];
$sumfile=$_GET['sumfile'];
$rid=$_GET['rid'];
$c_tabid=(int)$_GET['c_tabid'];


$bakdir=ABSPATH.'backup/'.$dir.'/';
if(!mkdirs($bakdir))
	yun_error('无法创建存储目录!');
write_file($bakdir.'index.html','0');
$filesize=$size*1024;
$bak='';
if($c_tabid==0&&$sumfile==1){
	$bak='-- '.htmlspecialchars($C['sys_webname']).' 系统数据备份 '."\n";
	$bak.='-- 生成日期:'.date('Y/m/d H:i',TIME)."\n";
	$bak.='-- ----------------------------------------'."\n";
	$bak.='-- 警告!修改本文件的任何部分,将有可能导致恢复失败!'."\n";
	$bak.='-- ----------------------------------------'."\n\n";
	$bak.="DROP TABLE IF EXISTS `".$tabs[$c_tabid]."`;\n\n";
	$result=$DB->query("SHOW CREATE TABLE `".$tabs[$c_tabid].'`');
	$row=$DB->fetch_row($result);
	$bak.=$row[1].";\n\n";
}

do{
	
	$result=$DB->query("select * from `".$tabs[$c_tabid].'`');
	$listnum=$DB->num_fields($result);
	$rownum=$DB->num_rows($result);
	while($rid<$rownum){
		$DB->data_seek($result,$rid);
		$row=$DB->fetch_row($result);
		$bak.='INSERT INTO '.$tabs[$c_tabid].' VALUES(';
		$arr=array();
		for($i=0;$i<$listnum;$i++){
			$arr[]="'".mysql_escape_string($row[$i])."'";
		}
		$bak.=implode(',',$arr).");\n\n";
		$rid++;
		if(strlen($bak)>=$filesize){
			write_file($bakdir.$sumfile++.'.php',$bak);
			
			$url=url(RM.'sqlbackup/?sumfile='.$sumfile.'&rid='.$rid.'&c_tabid='.$c_tabid);
			yun_loading('正在备份('.$sumfile.')...','ajaxget("'.$url.'");');
		}
	}
	if(!isset($tabs[++$c_tabid])){
		write_file($bakdir.$sumfile.'.php',$bak);
		yun_succeed('成功备份','refresh');
	}
	$bak.="DROP TABLE IF EXISTS `".$tabs[$c_tabid]."`;\n\n";
	$result=$DB->query("SHOW CREATE TABLE `".$tabs[$c_tabid]."`");
	$row=$DB->fetch_row($result);
	$bak.=$row[1].";\n\n";
	$rid=0;
}while(true);
?>