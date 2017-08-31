<?php
$themename = ( string ) $_POST ['themename'];
$save_as = ( string ) $_POST ['save_as'];

if (strlen ( $save_as ) < 1)
	yun_msg ( '', '请输入模板名称' );
if (! preg_match ( '/^\w+$/is', $save_as ))
	yun_msg ( '', '非法的模板名称' );

if (is_file ( $file = ABSPATH . 'theme/' . $themename . '/' . $save_as . '.php' ))
	yun_msg ( '', '模板已存在' );

yun_msg ( 'loading', '正在保存', 'document.getElementById(\'diy_save_name\').value=\'' . $save_as . '.php\';setTimeout(function(){javascript:spaceDiy.save();}, 200);' );