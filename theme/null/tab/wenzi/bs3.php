<?php
if (! empty ( $first )) {
	?>
<hr />
<?php
}
?>
<div class="form-group">
			<label for="name" class="col-sm-2 control-label"><?php  echo $tab['title']?></label>
			<div class="col-sm-5">
				<p class="form-control-static"><?php echo html($data)?></p>

			</div>
		</div>
  
<?php
if (! empty ( $last )) {
	?>
<?php
}