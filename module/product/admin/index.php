<?php
$channel=$G['channels'][$id];

$pg_c=(int)$P[1];
$pg_c<1&&$pg_c=1;
$cat_0=(int)$P[2];
$cat_1=(int)$P[3];
$cat_2=(int)$P[4];

$pg_d=20;

$pg_s=$pg_d*($pg_c-1);
$arr=array ();
$where=array ();

if($cat_0>0){
	$where[]="product.cat_0='".$cat_0."'";
}
if($cat_1>0){
	$where[]="product.cat_1='".$cat_1."'";
}
if($cat_2>0){
	$where[]="product.cat_2='".$cat_2."'";
}

$where[]="product.channel_id='".$id."'";
$wherestr=implode(' && ',$where);

$sql_by='product.post_time desc';

$rs=$DB->query("select *,product.id as id from ".PF."product as product  left join ".PF."user as user on product.authorid=user.id where ".$wherestr." order by $sql_by LIMIT ".$pg_s.",".$pg_d);
$posts=array ();
while($row=$DB->fetch_array($rs)){
	$pid=$row['id'];
	$posts[$pid]=$row;
	$posts[$pid]['url']=url(R.$channel['link'].$row['link']);
	$posts[$pid]['post_time']=showtime($row['post_time']);
}
$rs=$DB->query("select id from ".PF."product as product where ".$wherestr);
$num=$DB->num_rows($rs);

$page=page(R.$channel['url'].'(*)/'.$cat_0.'/'.$cat_1.'/'.$cat_2.'/',$pg_c,$num,$pg_d);


