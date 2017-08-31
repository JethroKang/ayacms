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
			<input type="text"  id="tab_<?php echo $tab['id']?>" name="tab_<?php echo $tab['id']?>"
					placeholder="<?php echo $tab['info']?>" value="<?php echo $data?>"/>
				<p class="help-block"></p>
			</div>
		</div>
  
<?php
if (! empty ( $last )) {
	?>
<?php
}