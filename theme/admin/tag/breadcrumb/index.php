<?php

$mod=get_val('mod');
$id=get_val('id');

$mx=do_apply('mainmenu_list','array');
$menus=array();
foreach($mx as $k=>$v){
	$menus[$v[0]]=$v;
}

$tx=do_apply('mainmenu_title','array');
$titles=array();
foreach($tx as $k=>$v){
	$titles[$v[0]]=$v;
}


if(ACTION=='index' ){
	echo '
<li> <i class="icon-home"></i> <a href="'.url(RM).'">首页</a></li>';
	return;
}

if(ACTION=='admin'){
	
	echo '
<li> <i class="icon-home"></i> <a href="'.url(RM).'">首页</a> <i class="icon-angle-right"></i> </li>';
	echo '<li> <span>栏目管理</span> <i class="icon-angle-right"></i> </li>
<li><a href="',url(RMA.'?mod='.$mod.'&id='.$id),'">',html($G['channels'][$id]['name']),'</a></li>';	
	
	return;
}


if(isset($titles[ACTION]) ){
	echo '
<li> <i class="icon-home"></i> <a href="'.url(RM).'">首页</a> <i class="icon-angle-right"></i> </li>';
	echo '<li><a href="',$titles[ACTION][3],'">',html($titles[ACTION][1]),'</a></li>';
	
	return;
}



if(!isset($menus[ACTION]) ){
	echo '
<li> <i class="icon-home"></i> <a href="'.url(RM).'">首页</a></li>';
	return;
}




echo '
<li> <i class="icon-home"></i> <a href="'.url(RM).'">首页</a> <i class="icon-angle-right"></i> </li>';
echo '<li> <span>',html($titles[$menus[ACTION][2]][1]),'</span> <i class="icon-angle-right"></i> </li>
<li><a href="',url(RM.ACTION.'/'),'">',html($menus[ACTION][1]),'</a></li>';




