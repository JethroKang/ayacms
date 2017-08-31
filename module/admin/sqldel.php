<?php

if(isset($_GET['id'])){
	$ids=array($_GET['id']);
}else{
	$ids=$_POST['ids'];
}
empty($ids)&&yun_error('至少选择一项');
foreach($ids as $v){
	empty($v)&&yun_succeed('异常');
	deldir(ABSPATH.'backup/'.$v);
}
yun_succeed('成功删除','refresh');
?>