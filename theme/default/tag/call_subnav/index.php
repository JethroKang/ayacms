<?php
$channels=&$G['channels'];

$p=array ();
foreach($channels as $k=>$v){
	empty($v['hide'])&&$p[$v['pid']][]=$k;
}

// 如果当前做为父栏目,则显示子栏目列表
if(isset($p[CID])){
	$pid=CID;
}else{
	$pid=$channels[CID]['pid'];
	// 如果父级为一级栏目,则不显示导航;
	if(isset($channels[$pid])&&$channels[$channels[$pid]['pid']]==0)
		return;
		// 如果父数组不存在,或父级栏目只一个子栏目,则不显示导航;
	if(empty($p[$pid])||count($p[$pid])==1)
		return;
}

?>

<div class="list-group">
<?php foreach($p[$pid] as $v){?>
	<a href="<?php echo curl($channels[$v]['link'])?>"
		class="list-group-item <?php echo CID==$v?' active':''?>"> <?php echo html($channels[$v]['name'])?> </a>
	<?php }?>
</div>