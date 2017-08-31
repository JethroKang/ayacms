<?php

$arr=explode("\n", $con);

$all=array();

foreach($arr as $k=>$v){
	$ltem=trim($v);
	if(strlen($ltem)>0){
		$all[]=explode("|", $ltem);
	}
}

if(($count=count($all))<1) return;
echo '<div class="',$tag['class'],' ',$class,'">';
foreach ($all as $k=>$v){
	?>
	<a href="<?php echo html($v[1])?>"><?php echo html($v[0])?></a>
<?php 
if(($k+1)<$count) echo '<span>|</span>';	
}
echo "</div>";
?>
