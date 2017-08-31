<div class="control-group">
	<label class="control-label">文字方向</label>
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