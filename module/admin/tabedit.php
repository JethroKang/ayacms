<?php

set_val('current_mainmenu_title','tab');
set_val('current_mainmenu_list','tab_'.ACTION);

$id=$_GET['id'];

isset($G['tabs'][$id]) or yun_error('表单不存在');

$tab=$G['tabs'][$id];
$type=$tab['type'];
$tabname=$tab['fortab'];

include_once ABSPATH.'module/admin/tab_class/tab_'.$type.'.php';

if(IS_POST){
	
	eval('tab_'.$type.'::tab_edit($id);');
	
yun_succeed('修改成功','f');
	
	
}


eval('$tpl=tab_'.$type.'::tpl(\'edit\',$id);');

?>