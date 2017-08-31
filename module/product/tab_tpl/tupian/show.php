<?php
if (! empty ( $first )) {
	?>
<?php
}
?>	

<?php
$v=strlen($data)>0?unserialize($data):array();
foreach($v as $vv){
?>
        <div class="span3">
		<a href="<?php echo R.$vv?>" class="thumbnail">
			<img data-src="holder.js/100%x180"
				src="<?php echo R.$vv?>"
				style="width: 100%; display: block;">
		</a>
	</div>
        
<?php
}
if (! empty ( $last )) {
	?>

<div class="clearfix"></div>
<div style="margin-bottom: 20px"></div>
<?php
}
?>
