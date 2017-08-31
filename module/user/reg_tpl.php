<?php

if(!isset($_GET['agree'])){
	?>


<form class="form-horizontal">

<div class="win_w">
<legend>注册协议</legend>
<div style="padding: 0 40px 20px">

<?php if(empty($C['sys_regc'])){?>

  <p>用户在使用本网站服务过程中，禁止以下行为:</p>
  <p>(1)违反宪法确定的基本原则的；<br />
    (2)危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的；<br />
    (3)损害国家荣誉和利益的；<br />
    (4)煽动民族仇恨、民族歧视，破坏民族团结的；<br />
    (5)破坏国家宗教政策，宣扬邪教和封建迷信的；<br />
    (6)散布谣言，扰乱社会秩序，破坏社会稳定的；<br />
    (7)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；<br />
    (8)侮辱或者诽谤他人,侵害他人合法权益的；<br />
    (9)煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的；<br />
    (10)以非法民间组织名义活动的；<br />
    (11)含有虚假、有害、胁迫、侵害他人隐私、骚扰、侵害、中伤、粗俗、或 其它道德上令人反感的内容；<br />
    (12)含有法律、法规、规章、条例以及任何具有法律效力之规范所限制或禁止的其他内容的。 <br />
  </p>
  <?php }else{?>
  <?php echo $C['sys_regc']?>  
  <?php }?>
  <div class="clearfix"></div>
</div>
</div>

		<div class="control-group">
			<div class="control-label">
				<button type="button" class="btn btn-primary" onclick="showwin('<?php echo url(RM.'reg/?agree')?>')">同意</button>
				<button type="button" class="btn btn-default" onclick="hidewin()">不同意</button>
			</div>
		</div>


</form>

<?php

}else{
	?>
<form class="form-horizontal" id="<?php echo $formID=strrand()?>" action="<?php echo furl(RM.'reg/')?>"
	method="post" autocomplete="off"
	onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">

<div class="win_w">
<legend>注册</legend>
<div class="control-group">
			<label class="control-label">用户名</label>
			<div class="controls">
				<input type="text"  id="name" name="name"
					placeholder="3-12位,不能全为数字,必填" />
			</div>
		</div>

<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls">
				<input type="text"  id="email" name="email"
					placeholder="必填" />
			</div>
		</div>

<div class="control-group">
			<label class="control-label">密码</label>
			<div class="controls">
				<input type="password"  id="pass" name="pass"
					placeholder="必填" />
			</div>
		</div>

<div class="control-group">
			<label class="control-label">再次输入密码</label>
			<div class="controls">
				<input type="password"  id="pass2" name="pass2"
					placeholder="必填" />
			</div>
		</div>

	<div class="control-group">
		<label class="control-label">性别</label>
		<div class="controls">
			<select  name="sex">
				<option value="0">男</option>
				<option value="1">女</option>
			</select>
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
				<input type="text"  id="captcha" name="captcha"
					placeholder="" />
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

apply('jscode','yun_onfocus("name");');
}
?>
