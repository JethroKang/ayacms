<?php

$channel=$G['channels'][$id];

$pid=(int)$_GET['pid'];
if(!$post=$DB->fetch_first('select *,product.* from '.PF.'product as product left join '.PF.'user as user on user.id=product.authorid where product.id='.$pid)){
	yun_error('主题不存在');
}

$post['pics']=unserialize($post['pics']);

if (IS_POST) {
	
	$title = trim ( ( string ) $_POST ['title'] );
	$sign = trim ( ( string ) $_POST ['sign'] );
	$pics=is_array($_POST['pics'])?$_POST['pics']:array();
	
	if (strlen($sign)>0) {
		product::sign ( $sign,$pid) or yun_error ( '非法的链接标志', 'yun_onfocus("sign");' );
	}
	
	
	$description = trim ( ( string ) $_POST ['description'] );
	$keywords = trim ( ( string ) $_POST ['keywords'] );
	
	$content = trim ( ( string ) $_POST ['content'] );
	$tuijian = empty ( $_POST ['tuijian'] ) ? 0 : 1;
	
	$pagetitles = trim ( ( string ) $_POST ['pagetitles'] );
	
	$thumb = trim ( ( string ) $_POST ['thumb'] );
	
	$cat_0=(int)$_POST['cat_0'];
	$cat_1=(int)$_POST['cat_1'];
	$cat_2=(int)$_POST['cat_2'];
	
	
	
	fstrlen ( $title, 2, 100 ) or yun_error ( '标题范围1-100字', 'yun_onfocus("title");' );
	
	fstrlen ( $description, 0, 150 ) or yun_error ( '描述范围0-150字', 'yun_onfocus("description");' );
	fstrlen ( $keywords, 0, 150 ) or yun_error ( '关键字太长', 'yun_onfocus("keywords");' );
	
	fstrlen ( $content, 0, 65535 ) or yun_error ( '内容范围0-65535字', 'yun_onfocus("content");' );
	fstrlen ( $pagetitles, 0, 500 ) or yun_error ( '分页导航范围0-500字', 'yun_onfocus("pagetitles");' );
	fstrlen ( $thumb, 0, 200 ) or yun_error ( '缩略图地址异常', 'yun_onfocus("thumb");' );
	
	$new_pics=array();
	foreach ($pics as $k=>$pic){
		if($val=upload_move($pic,$mod))
			$new_pics[]=$val;
	}
	
	$tabdata=tab::post ($channel['tabs']['diss']);
	$thumb=upload_move($thumb,$mod,true);
	
	
	$arr=array(
		'channel_id'=>$id,
			'title'=>$title,
			'sign'=>$sign,
			'description'=>$description,
			'keywords'=>ftag ($keywords),
			'content'=>$content,
			'pagetitles'=>$pagetitles,
			'pics'=>serialize($new_pics),
			'thumb'=>$thumb,
			'authorid'=>$U[id],
			'tuijian'=>$tuijian,
			'cat_0'=>$cat_0,
			'cat_1'=>$cat_1,
			'cat_2'=>$cat_2
	);
	$arr=array_merge($arr,$tabdata);
	
	$str=sql_update($arr);
	$DB->query("update " . PF . "product set $str  where id='$pid'");
	
	
	product::topic_edit ( $pid, $arr );
	
	
	yun_succeed ( '编辑成功','f' );
}



