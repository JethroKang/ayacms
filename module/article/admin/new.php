<?php
$channel=$G['channels'][$id];

if(IS_POST){
	
	$title=trim((string)$_POST['title']);
	$sign=trim((string)$_POST['sign']);
	
	if(strlen($sign)>0){
		article::sign($sign) or yun_error('非法的链接标志','yun_onfocus("sign");');
	}
	
	$description=trim((string)$_POST['description']);
	$keywords=trim((string)$_POST['keywords']);
	
	$content=trim((string)$_POST['content']);
	$tuijian=empty($_POST['tuijian'])?0:1;
	
	$pagetitles=trim((string)$_POST['pagetitles']);
	
	$thumb=trim((string)$_POST['thumb']);
	
	$cat_0=(int)$_POST['cat_0'];
	$cat_1=(int)$_POST['cat_1'];
	$cat_2=(int)$_POST['cat_2'];
	
	fstrlen($title,2,100) or yun_error('标题范围1-100字','yun_onfocus("title");');
	
	fstrlen($description,0,150) or yun_error('描述范围0-150字','yun_onfocus("description");');
	fstrlen($keywords,0,150) or yun_error('关键字太长','yun_onfocus("keywords");');
	
	fstrlen($content,2,65535) or yun_error('内容范围2-65535字','yun_onfocus("content");');
	fstrlen($pagetitles,0,500) or yun_error('分页导航范围0-500字','yun_onfocus("pagetitles");');
	fstrlen($thumb,0,200) or yun_error('缩略图地址异常','yun_onfocus("thumb");');
	
	$tabdata=tab::post($channel['tabs']['diss']);
	
	$thumb=upload_move($thumb,$mod,true);
	
	$arr=array (
			'channel_id'=>$id,
			'title'=>$title,
			'sign'=>$sign,
			'description'=>$description,
			'keywords'=>ftag($keywords),
			'content'=>$content,
			'pagetitles'=>$pagetitles,
			'thumb'=>$thumb,
			'authorid'=>$U[id],
			'post_time'=>TIME,
			'tuijian'=>$tuijian,
			'cat_0'=>$cat_0,
			'cat_1'=>$cat_1,
			'cat_2'=>$cat_2 
	);
	$arr=array_merge($arr,$tabdata);
	
	$str=sql_insert($arr);
	$DB->query("insert into ".PF.'article '.$str);
	
	$pid=$DB->insert_id();
	
	article::topic_new($pid,$arr);
	
	$arr=array (
			'a'=>$user['a']+intval($C['sys_t_a']),
			'b'=>$user['b']+intval($C['sys_t_b']),
			'c'=>$user['c']+intval($C['sys_t_c']),
			'last_post'=>TIME,
			'posts'=>$user['posts']+1 
	);
	$str=sql_update($arr);
	$DB->query("update ".PF."user set $str where id='$user[id]'");
	yun_succeed('发表成功','f');
}
