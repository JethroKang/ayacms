<?php

$arr=array_merge(do_apply('tag_description','array'),array($C['sys_description']));
foreach($arr as $k=>$v){
	if($v=='')
		unset($arr[$k]);
}
echo count($arr)>0?htmlspecialchars(implode('. ',$arr)):'';
?>