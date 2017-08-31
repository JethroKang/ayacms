<?php


$tpl=(string)$_GET['tpl'];
if(!preg_match('/^\w+$/is',$tpl)) yun_msg('','非法的tpl参数');
if(!is_file(THEMEDIR.$tpl.'.php')) yun_msg('warning','模板文件不存在');

set_val('tpl',$tpl);
set_val('theme_file',$tpl.'.php');


$tpls=array();

@$d = opendir ( THEMEDIR );
while ( $file = readdir ( $d ) ) {
	if(substr($file,-4)=='.php' && !in_array($file,array('header.php','footer.php','__conf.php','__init.php'))) 
		$tpls[]=preg_replace("/\.php$/", '',$file);;
}
set_val('tpls',$tpls);



apply('header','<link rel="stylesheet" type="text/css" href="'.AP.'index.css" charset="utf-8" />');

apply('header','code:return include(\''.ACTIONDIR.'html.php\');');
apply('footer','<script type=text/javascript src="'.AP.'common.js"></script><script type=text/javascript src="'.AP.'portal.js"></script>');
