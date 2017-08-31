<?php

$id=intval($_GET['id']);

isset($G['channels'][$id]) or yun_error('栏目不存在');
$channel=$G['channels'][$id];

$arr=array(
'hide'=>$channel['hide']?0:1,
);
$str=sql_update($arr);
$DB->query("update ".PF."channel set $str where id='$id'");

yun_succeed('设置成功','f');

?>