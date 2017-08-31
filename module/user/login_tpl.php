<form class="form-horizontal" id="loginform"
	action="<?php echo furl(RM.'login/')?>" method="post"
	autocomplete="off" onsubmit="ajaxp(this.id);return false;">

	<div class="win_w">

		<legend>登陆</legend>
		<div class="control-group">
			<label class="control-label">用户名</label>
			<div class="controls">
				<input type="text" class="form-control" id="name" name="name" tabindex="1"
					placeholder="3-12位,不能全为数字,必填" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">密码</label>
			<div class="controls">
				<input type="password" class="form-control" id="pass" name="pass" tabindex="2"
					placeholder="必填" />
			</div>
		</div>


		<div class="control-group">
			<label class="control-label">验证码</label>
			<div class="controls">
				<p>
					<img style="margin-top: 4px" id="captchaimg"
						src="<?php echo R?>static/captcha.php" border="0" />
					<a href="javascript:void(0)" onclick="recaptcha();return false;">看不清?</a>
				</p>
				<input type="text" class="form-control" id="captcha" name="captcha" tabindex="3"
					placeholder="" />
			</div>
		</div>


		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="ltime" value="1" checked="checked" />
					两周内不用再登陆
				</label>
				<button type="submit" class="btn btn-primary" tabindex="4">提交</button>
				<button type="reset" class="btn btn-default">重置</button>
			</div>
		</div>


	</div>
</form>
<?php
apply('jscode','yun_onfocus("name");');

