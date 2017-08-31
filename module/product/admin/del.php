<?php
$channel=$G['channels'][$id];

if(IS_POST){
	$ids=$_POST['ids'];
	is_array($ids) or yun_error('至少选择一项');
	foreach($ids as $pid){
		
		if(!$post=$DB->fetch_first("select *,product.id as id from ".PF."product as product left join ".PF."user as user on user.id=product.authorid where product.id=".$pid))
			continue;
		
		product::topic_del($pid,$post);
	}
	yun_succeed('删除成功','f');
}

$pid=(int)$_GET['pid'];
if(!$post=$DB->fetch_first("select *,product.id as id from ".PF."product as product left join ".PF."user as user on user.id=product.authorid where product.id=".$pid))
	yun_error('主题不存在');
product::topic_del($pid,$post);

yun_succeed('已删除','f');
