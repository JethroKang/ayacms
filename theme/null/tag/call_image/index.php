<?php
$style='width:'.$width.';height:'.$height.';';
$class=$align;
if(strlen($link)<1){
	?>

<img src="<?php echo R.$img_1?>" class="<?php echo $class?>" style="<?php echo $style?>" />
<?php
}else{
	?>
<a href="<?php echo $link?>">
	<img src="<?php echo R.$img_1?>" class="<?php echo $class?>" style="<?php echo $style?>" />
</a>

<?php
}
?>
<div class="clearfix"></div>