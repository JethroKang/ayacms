<?php

set_val('current_mainmenu_title','tab');
set_val('current_mainmenu_list','tab_'.ACTION);



//所有表
$tabs=array();
$result=$DB->query("SHOW TABLES");

while($row=$DB->fetch_array($result)){
$_name=array_shift($row);
$arr=explode('_',$_name);
if(count($arr)<3 && ($arr[0].'_')==PF && strlen($arr[1])>1){
	$tabs[]=$arr[1];
}

}

//print_r($tabs);


$type=(string)$_GET['type'];
isset($C['tabtypes'][$type]) or exit();

include_once ABSPATH.'module/admin/tab_class/tab_'.$type.'.php';



if(IS_POST){



$tabname=$_POST['tabname'];
in_array($tabname,$tabs)===false && exit();



eval('tab_'.$type.'::tab_new($tabname);');


yun_succeed('提交成功',url(RM.'tab/'));
}

eval('$tpl=tab_'.$type.'::tpl(\'new\');');

?>