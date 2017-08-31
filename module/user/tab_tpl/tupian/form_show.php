<hr />

<div class="control-group">
			<label class="control-label"><?php  echo $tab['title']?></label>
			<div class="controls">
			<ul class="thumbnails">
<?php
$v=strlen($data)>0?unserialize($data):array();
foreach($v as $vv){
?>
        <li class="span3">
		<a href="<?php echo R.$vv?>" class="thumbnail">
			<img data-src="holder.js/100%x180" alt=""
				src="<?php echo R.$vv?>"
				style=" width: 100%;">
		</a>
	</li>
        
<?php
}
?>
</ul>
</div>
</div>
