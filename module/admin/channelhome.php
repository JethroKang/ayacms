<?php

$id=intval($_GET['id']);

isset($G['channels'][$id]) or yun_error('栏目不存在');
$G['channels'][$id]['pid']>0 && yun_error('子栏目无法设置');
$channel=$G['channels'][$id];

$arr=array (
		'home'=>$channel['home']?0:1
);

$str=sql_update($arr);

$DB->query("update ".PF."channel set home=0");
$DB->query("update ".PF."channel set $str where id='$id'");

yun_succeed('设置成功','f');
