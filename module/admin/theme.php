<?php
set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);

$theme=array();
if($_d=@opendir(ABSPATH.'theme/')){
	while($entry=readdir($_d)){
		if(substr($entry,0,1)=='_')
			continue;
		if(is_dir(ABSPATH.'theme/'.$entry)&&$entry!='.'&&$entry!='..'&&file_exists($file=ABSPATH.'theme/'.$entry.'/__conf.php')){
			$theme[$entry]=include $file;
		}
	}
	closedir($_d);
}

$tarr=&$theme;

foreach($tarr as $k=>$v){
	$tarr[$k]['image']=isset($v['image'])?(R.'theme/'.$k.'/'.$v['image']):NONEIMG;
	$tarr[$k]['date']=strtotime($v['date']);
}



if(isset($_GET['theme'])){
	$themes=array_keys($tarr);
	in_array($_GET['theme'],$themes) or yun_error('请选择默认主题');
	set_conf('sys_theme',$_GET['theme']);
		
	admin::upcache();
	yun_succeed('主题已更换',url(RM.'theme/'));
}


if(isset($_GET['insttheme'])){}
if(isset($_GET['deltheme'])){}
if(IS_POST){}

