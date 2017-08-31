<?php

$arr=array_merge(do_apply('tag_keywords'),array($C['sys_keywords']));

foreach($arr as $k=>$v){
	if($v=='')
		unset($arr[$k]);
}
echo count($arr)>0?htmlspecialchars(implode('. ',$arr)):'';
?>