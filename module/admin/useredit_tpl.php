
<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo furl(RM.'useredit/?id='.$id)?>" method="post"
	autocomplete="off" onsubmit="ajaxp(this.id);return false;">
	<div class="win_w">
		<div class="form-group">
			<label class="col-sm-2 control-label">用户名</label>
			<div class="col-sm-5">
				<p class="form-control-static"><?php echo html($u['name'])?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">登陆密码</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="pass" name="pass"
					placeholder="留空表示不变更" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="email" name="email"
					placeholder="必填" value="<?php echo html($u['email'])?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">性别</label>
			<div class="col-md-5">
				<select class="form-control" name="sex">
					<option value="0" <?php echo $u['sex']?'':'selected="selected"'?>>男</option>
					<option value="1" <?php echo !$u['sex']?'':'selected="selected"'?>>女</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">身份</label>
			<div class="col-md-5">
				<select class="form-control" name="team">
          <?php
										
										foreach ( $C ['sys_teams'] as $k => $v ) {
											?>
          <option value="<?php echo $k?>"
						<?php echo $k==$u['team']?'selected="selected"':''?>>
          <?php echo html($v['name'])?>
          </option>
          <?php
										}
										?>
        </select>
			</div>
		</div>
		
		<?php echo tab::tpls ( $C ['user_tabs']['diss'],'form_edit.php',$u);?>
		
	</div>
	<div class="form-group">
		<div class="col-md-offset-2 col-md-10">
			<button type="reset" class="btn default">重置</button>
			<button type="submit" class="btn blue">提交</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	yun_onfocus("pass");
</script>
