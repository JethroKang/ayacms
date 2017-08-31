<?php

$arr=array($C['sys_webname']);
$arr2=do_apply('title','array');
if($arr2!=array(array()))
	$arr=array_merge($arr,$arr2);
echo html(implode(' - ',array_reverse($arr)));
?>