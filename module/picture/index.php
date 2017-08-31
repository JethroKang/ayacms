<?php
$pg_d=intval($channel['configs']['t_num']);

$pg_c=P1<1?1:P1;

$pg_s=$pg_d*($pg_c-1);
$arr=array ();
$where=array ();

if(P2>0)
	$where[]="picture.cat_0='".P2."'";
if(P3>0)
	$where[]="picture.cat_1='".P3."'";
if(P4>0)
	$where[]="picture.cat_2='".P4."'";

$where[]="picture.channel_id='".CID."'";
$wherestr=implode(' && ',$where);

$sql_by='picture.post_time desc';

$rs=$DB->query("select *,picture.id as id from ".PF."picture as picture  left join ".PF."user as user on picture.authorid=user.id where ".$wherestr." order by $sql_by LIMIT ".$pg_s.",".$pg_d);
$posts=array ();
while($row=$DB->fetch_array($rs)){
	$id=$row['id'];
	$posts[$id]=$row;
	$posts[$id]['url']=url(R.CLINK.$row['link']);
	$posts[$id]['thumb']=$row['thumb']?(R.$row['thumb']):NONEIMG;
}
$rs=$DB->query("select id from ".PF."picture as picture where ".$wherestr);
$num=$DB->num_rows($rs);
$page=page(R.CLINK.'(*)/'.((P2.'/'.P3.'/'.P4.'/')=='0/0/0/'?'':(P2.'/'.P3.'/'.P4.'/')),$pg_c,$num,$pg_d);

?>