<?php
$channel=$G['channels'][$id];

if(IS_POST){
	$ids=$_POST['ids'];
	is_array($ids) or yun_error('至少选择一项');
	foreach($ids as $pid){
		
		if(!$post=$DB->fetch_first("select *,article.id as id from ".PF."article as article left join ".PF."user as user on user.id=article.authorid where article.id=".$pid))
			continue;
		
		article::topic_del($pid,$post);
	}
	yun_succeed('删除成功','f');
}

$pid=(int)$_GET['pid'];
if(!$post=$DB->fetch_first("select *,article.id as id from ".PF."article as article left join ".PF."user as user on user.id=article.authorid where article.id=".$pid))
	yun_error('主题不存在');
article::topic_del($pid,$post);

yun_succeed('已删除','f');
