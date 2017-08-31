<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo furl(RM.'edit/')?>" method="post" autocomplete="off"
	onsubmit="ajaxp(this.id);return false;">
	<div class="win_w">
	<legend>编辑</legend>
		<div class="control-group">
			<label class="control-label">用户名</label>
			<div class="controls">
				<p class="form-control-static"><?php echo html($u['name'])?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">头像</label>
			<div class="controls">
				<?php echo init_upload('face','jpg,jpge,gif,png',$u['face'],'500')?>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label">性别</label>
			<div class="controls">
				<select class="form-control" name="sex">
					<option value="0" <?php echo $u['sex']?'':'selected="selected"'?>>男</option>
					<option value="1" <?php echo !$u['sex']?'':'selected="selected"'?>>女</option>
				</select>
			</div>
		</div>

		<?php echo tab::tpls($C['user_tabs']['diss'],'form_edit.php',$u);?>
		
		
	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset" class="btn btn-default">重置</button>
		</div>
	</div>
</form>

