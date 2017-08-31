<?php
$pid=P1;
$eid=P2;

$eid<1&&$eid=1;

if(!$post=$DB->fetch_first("select *,product.id as id from ".PF."product as product left join ".PF."user as user on user.id=product.authorid where product.channel_id=".CID." && product.id=".$pid)){
	yun_error('主题不存在');
}

$post['contents']=product::get_content($post['content']);

isset($post['contents'][$eid]) or yun_error('该页不存在');

$post['pagetitles']=product::get_pagetitle($post['pagetitles']);
$post['pics']=unserialize($post['pics']);

$page_urls=array ();
foreach($post['pagetitles'] as $k=>$v){
	$page_urls[$k]=url(RM.$post['link'].$k.'/');
}
$DB->query("update ".PF."product set hits=hits+1 where id='$pid'");
$post['hits']++;

apply('title',$post['title']);
apply('tag_keywords',$post['keywords']);
apply('tag_description',$post['description']);
apply('current',array (
		$post['title'],
		ACTION=='show'?'':RM.$post['link'] 
));
$tup=$tdown=array ();
$rs=$DB->query("select *,product.id as id from ".PF."product as product left join ".PF."user as user on user.id=product.authorid where product.channel_id=".CID." && product.id<'".$post['id']."' order by product.id desc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tup['title']=$row['title'];
	$tup['url']=url(RM.$row['link']);
}
$rs=$DB->query("select *,product.id as id from ".PF."product as product left join ".PF."user as user on user.id=product.authorid where product.channel_id=".CID." && product.id>'".$post['id']."' order by product.id asc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tdown['title']=$row['title'];
	$tdown['url']=url(R.CLINK.$row['link']);
}

