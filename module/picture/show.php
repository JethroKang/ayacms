<?php
$pid=P1;
$eid=P2;

$eid<1&&$eid=1;

if(!$post=$DB->fetch_first("select *,picture.id as id from ".PF."picture as picture left join ".PF."user as user on user.id=picture.authorid where picture.channel_id=".CID." && picture.id=".$pid)){
	yun_error('主题不存在');
}

$post['contents']=picture::get_content($post['content']);

isset($post['contents'][$eid]) or yun_error('该页不存在');

$post['pagetitles']=picture::get_pagetitle($post['pagetitles']);
$post['pics']=unserialize($post['pics']);

$page_urls=array ();
foreach($post['pagetitles'] as $k=>$v){
	$page_urls[$k]=url(RM.$post['link'].$k.'/');
}
$DB->query("update ".PF."picture set hits=hits+1 where id='$pid'");
$post['hits']++;

apply('title',$post['title']);
apply('tag_keywords',$post['keywords']);
apply('tag_description',$post['description']);
apply('current',array (
		$post['title'],
		ACTION=='show'?'':RM.$post['link'] 
));
$tup=$tdown=array ();
$rs=$DB->query("select *,picture.id as id from ".PF."picture as picture left join ".PF."user as user on user.id=picture.authorid where picture.channel_id=".CID." && picture.id<'".$post['id']."' order by picture.id desc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tup['title']=$row['title'];
	$tup['url']=url(RM.$row['link']);
}
$rs=$DB->query("select *,picture.id as id from ".PF."picture as picture left join ".PF."user as user on user.id=picture.authorid where picture.channel_id=".CID." && picture.id>'".$post['id']."' order by picture.id asc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tdown['title']=$row['title'];
	$tdown['url']=url(R.CLINK.$row['link']);
}

