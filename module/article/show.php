<?php
$pid=P1;
$eid=P2;

$eid<1&&$eid=1;

if(!$post=$DB->fetch_first("select *,article.id as id from ".PF."article as article left join ".PF."user as user on user.id=article.authorid where article.channel_id=".CID." && article.id=".$pid)){
	yun_error('主题不存在');
}

$post['contents']=article::get_content($post['content']);

isset($post['contents'][$eid]) or yun_error('该页不存在');

$post['pagetitles']=article::get_pagetitle($post['pagetitles']);

$page_urls=array ();
foreach($post['pagetitles'] as $k=>$v){
	$page_urls[$k]=url(RM.$post['link'].$k.'/');
}
$DB->query("update ".PF."article set hits=hits+1 where id='$pid'");
$post['hits']++;

apply('title',$post['title']);
apply('tag_keywords',$post['keywords']);
apply('tag_description',$post['description']);
apply('current',array (
		$post['title'],
		ACTION=='show'?'':RM.$post['link'] 
));
$tup=$tdown=array ();
$rs=$DB->query("select *,article.id as id from ".PF."article as article left join ".PF."user as user on user.id=article.authorid where article.channel_id=".CID." && article.id<'".$post['id']."' order by article.id desc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tup['title']=$row['title'];
	$tup['url']=url(RM.$row['link']);
}
$rs=$DB->query("select *,article.id as id from ".PF."article as article left join ".PF."user as user on user.id=article.authorid where article.channel_id=".CID." && article.id>'".$post['id']."' order by article.id asc limit 0,1");
if($row=$DB->fetch_array($rs)){
	$tdown['title']=$row['title'];
	$tdown['url']=url(R.CLINK.$row['link']);
}

