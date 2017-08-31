<?php


$id=$_GET['id'];

isset($G['tabs'][$id]) or yun_error('表单不存在');
$tab=$G['tabs'][$id];
$type=$tab['type'];
include_once ABSPATH.'module/admin/tab_class/tab_'.$type.'.php';

eval('tab_'.$type.'::tab_del($id);');

yun_succeed('删除成功','f');
	
