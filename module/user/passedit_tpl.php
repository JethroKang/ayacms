<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo url(RM.'passedit/')?>" method="post"
	autocomplete="off" onsubmit="ajaxp(this.id);return false;">

	<div class="win_w">
<legend>修改密码</legend>
		<div class="control-group">
			<label class="control-label">旧密码</label>
			<div class="controls">
				<input class="form-control" name="pass" type="password" id="pass"
					value="" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">新密码</label>
			<div class="controls">
				<input class="form-control" name="pass2" type="password" id="pass2"
					value="" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">再次输入密码</label>
			<div class="controls">
				<input class="form-control" name="rpass2" type="password"
					id="rpass2" value="" />
			</div>
		</div>

	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset" class="btn btn-default">重置</button>
		</div>
	</div>

</form>
<?php
apply('jscode','yun_onfocus("pass");');

