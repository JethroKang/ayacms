<?php

$q=(string)$_GET['q'];

$pg_d=20;
$pg_c=A<1?1:A;
$pg_s=$pg_d*($pg_c-1);

$posts=array();
$where=array();

$where[]='tag="'.addslashes($q).'"';
$wherestr=implode(' && ',$where);
$rs=$DB->query("select * from ".PF."tag where ".$wherestr." order by post_time desc LIMIT ".$pg_s.",".$pg_d);

while($row=$DB->fetch_array($rs)){
	$id=$row['id'];
	$posts[$id]=$row;
	$posts[$id]['url']=url(R.$G['channels'][$row['channel_id']]['link'].$row['link']);
}

$rs = $DB->query ( "select id from " . PF . "tag where " . $wherestr );
$num = $DB->num_rows ( $rs );

$page=page(RM.'(*)/?q='.urlencode($q),$pg_c,$num,$pg_d);

apply('title',$q);
apply('current',array($q));