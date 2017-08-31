<div class="control-group">
	<label class="control-label">图片</label>
	<div class="controls">
		<?php echo init_upload('img_1','jpg,jpge,gif,png',$img_1)?>

	</div>
</div>

<div class="control-group">
	<label class="control-label">链接</label>
	<div class="controls">
		<input type="text" class="span8" name="link" placeholder="选填"
			value="<?php echo html($link)?>" />
	</div>
</div>

<div class="control-group">
	<label class="control-label">宽/高</label>
	<div class="controls">
  <input type="text" class="span3" name="width" placeholder="选填"
			value="<?php echo html($width)?>" />
 /
   <input type="text" class="span3" name="height" placeholder="选填"
			value="<?php echo html($height)?>" />    
  </div>
</div>

<div class="control-group">
	<label class="control-label">方向</label>
	<div class="controls">


			<label class="radio inline">
				<input name="align" type="radio" value=""
					<?php echo empty($align)?'checked':''?> />
				默认
			</label>
			<label class="radio inline">
				<input name="align" type="radio" value="pull-left"
					<?php echo $align=='pull-left'?'checked':''?> />
				左
			</label>
			<label class="radio inline">
				<input name="align" type="radio" value="pull-right"
					<?php echo $align=='pull-right'?'checked':''?> />
				右
			</label>
	</div>
</div>

<div class="control-group">
	<label class="control-label">效果</label>
	<div class="controls">

			<label class="radio inline">
				<input name="class" type="radio" value=""
					<?php echo empty($class)?'checked':''?> />
				无
			</label>
			<label class="radio inline">
				<input name="class" type="radio" value="img-rounded"
					<?php echo $class=='img-rounded'?'checked':''?> />
				img-rounded
			</label>
			<label class="radio inline">
				<input name="class" type="radio" value="img-circle"
					<?php echo $class=='img-circle'?'checked':''?> />
				img-circle
			</label>
			<label class="radio inline">
				<input name="class" type="radio" value="img-thumbnail"
					<?php echo $class=='img-thumbnail'?'checked':''?> />
				img-thumbnail
			</label>


	</div>
</div>