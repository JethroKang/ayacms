<div class="control-group">
	<label class="control-label">标题1</label>
	<div class="controls">
		<input type="text" class="form-control" name="title1" placeholder=""
			value="<?php echo html($title1)?>" />
	</div>
</div>
<div class="control-group">
	<label class="control-label">标题2</label>
	<div class="controls">
		<input type="text" class="form-control" name="title2" placeholder=""
			value="<?php echo html($title2)?>" />
	</div>
</div>
<div class="control-group">
	<label class="control-label">标题3</label>
	<div class="controls">
		<input type="text" class="form-control" name="title3" placeholder=""
			value="<?php echo html($title3)?>" />
	</div>
</div>


<div class="control-group">
	<label class="control-label">内容1</label>
	<div class="controls">
		<textarea name="con1" cols="" rows="3" class="form-control"><?php echo html($con1)?></textarea>

	</div>
</div>
<div class="control-group">
	<label class="control-label">内容2</label>
	<div class="controls">
		<textarea name="con2" cols="" rows="3" class="form-control"><?php echo html($con2)?></textarea>

	</div>
</div>
<div class="control-group">
	<label class="control-label">内容3</label>
	<div class="controls">
		<textarea name="con3" cols="" rows="3" class="form-control"><?php echo html($con3)?></textarea>

	</div>
</div>
<div class="control-group">
	<label class="control-label">图1</label>
	<div class="controls">
				<?php echo init_upload('img_1','jpg,jpge,gif,png',$img_1)?>
			</div>
</div>
<div class="control-group">
	<label class="control-label">图2</label>
	<div class="controls">
				<?php echo init_upload('img_2','jpg,jpge,gif,png',$img_2)?>
			</div>
</div>
<div class="control-group">
	<label class="control-label">图3</label>
	<div class="controls">
				<?php echo init_upload('img_3','jpg,jpge,gif,png',$img_3)?>
			</div>
</div>
