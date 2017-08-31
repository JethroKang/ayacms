<?php

empty($BPV[1])&&yun_error('权限不足,禁止使用搜索');
if(IS_POST){
	$q=(string)$_POST['q'];
}else{
	$q=(string)$_GET['q'];
}




$_t=mb_strlen($q,'UTF-8');
$_t<1&&yun_error('请填写关键字');
$_t>10&&yun_error('关键字最多10位');

if(IS_POST){
	yun_msg('loading','稍候',url(RM.'?q='.urlencode($q)));
}

$pg_d=20;
$pg_c=A<1?1:A;
$pg_s=$pg_d*($pg_c-1);

$posts=array();
$where=array();

$where[]='title like \'%'.addslashes($q).'%\'';
$wherestr=implode(' && ',$where);
$rs=$DB->query("select * from ".PF."yun where ".$wherestr." order by post_time desc LIMIT ".$pg_s.",".$pg_d);

while($row=$DB->fetch_array($rs)){
	$id=$row['id'];
	$posts[$id]=$row;
	$posts[$id]['url']=url(R.$G['channels'][$row['channel_id']]['link'].$row['link']);
}

$rs = $DB->query ( "select id from " . PF . "yun where " . $wherestr );
$num = $DB->num_rows ( $rs );

$page=page(RM.'(*)/?q='.urlencode($q),$pg_c,$num,$pg_d);

?>