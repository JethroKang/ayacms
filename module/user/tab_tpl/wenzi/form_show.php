<?php
if (! empty ( $first )) {
	?>
<hr />
<?php
}
?>
<div class="control-group">
			<label class="control-label"><?php  echo $tab['title']?></label>
			<div class="controls">
				<p class="form-control-static"><?php echo html($data)?></p>
			</div>
		</div>
  
<?php
if (! empty ( $last )) {
	?>
<?php
}