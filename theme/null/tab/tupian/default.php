<?php
if (! empty ( $first )) {
	?>

<hr />
<div class="form-group">
			<label for="name" class="col-sm-2 control-label"><?php  echo $tab['title']?></label>
			<div class="col-sm-5">
<div class="row">
<?php
}
?>	

<?php
$v=strlen($data)>0?unserialize($data):array();
foreach($v as $vv){
?>
        <div class="col-xs-6 col-md-3">
		<a href="<?php echo R.$vv?>" class="thumbnail">
			<img data-src="holder.js/100%x180" alt="100%x180"
				src="<?php echo R.$vv?>"
				style="height: 180px; width: 100%; display: block;">
		</a>
	</div>
        
<?php
}
if (! empty ( $last )) {
	?>
</div>
</div>
</div>
<?php
}