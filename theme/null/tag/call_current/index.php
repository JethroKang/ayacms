<ul class="breadcrumb">
<?php
$arr=array (
		array (
				'首页',
				R 
		) 
);
$arr=array_merge($arr,do_apply('current'));

$len=count($arr);
foreach($arr as $k=>$v){
	$class=$len==($k+1)?'active':'';
	$divider=$len==($k+1)?'':'<span class="divider">/</span>';
	if(!empty($v[1])){
		?><li class="<?php echo $class?>">
		<a href="<?php echo url($v[1])?>"><?php echo html($v[0])?></a><?php echo $divider?></li><?php
	}else{
		?>
	<li class="<?php echo $class?>"><?php
		echo html($v[0])?><?php

		
echo $divider?></li><?php
	}
}
?>
</ul>
