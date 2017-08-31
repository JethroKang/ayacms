<?php
$act = ( string ) $_GET ['act'];
$mod = ( string ) $_GET ['mod'];
$id = ( int ) $_GET ['id'];

set_val('mod',$mod);
set_val('id',$id);

$act == '' && $act = 'index';

if ($act != 'install' && $act != 'uninstall') {
	module_exists($mod) or yun_error ( '模型不存在' );
	$G ['channels'] [$id] ['formod'] == $mod or yun_error ( '参数错误' );
} else if (empty ( $BPV [2] ))
	yun_error ( '权限不足,禁止进入' );


if (! file_exists ( $file = ABSPATH . 'module/' . $mod . '/admin/' . $act . '.php' ))
	yun_error ( '应用不存在' );

include $file;