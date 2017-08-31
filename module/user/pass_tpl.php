<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo url(RM.'pass/')?>" method="post" autocomplete="off"
	onsubmit="ajaxp(this.id);return false;">
	<div class="win_w">
	<legend>找回密码</legend>
		<div class="control-group">
			<label class="control-label">用户名</label>
			<div class="controls">
				<input name="name" type="text" id="name"
					value="" placeholder="必填" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">新密码</label>
			<div class="controls">
				<input name="pass" type="password" id="pass"
					value="" placeholder="必填" />
			</div>
		</div>

		<div class="control-group">
			<label for="name" class="control-label">验证码</label>
			<div class="controls">
				<p>
					<img style="margin-top: 4px" id="captchaimg"
						src="<?php echo R?>static/captcha.php" border="0" />
					<a href="javascript:void(0)" onclick="recaptcha();return false;">看不清?</a>
				</p>
				<input type="text" id="captcha" name="captcha"
					placeholder="" />
			</div>
		</div>
	</div>

			<div class="control-group">
				<div class="controls">
				<button type="submit" class="btn btn-primary">提交</button>
				<button type="reset" class="btn btn-default">重置</button>
				<p class="help-block"> 提交成功后,请登陆您注册时填写的邮箱,查阅邮件.</p>
				</div>
			</div>

</form>


<script type="text/javascript">
	yun_onfocus("name");
</script>
