<form class="form-horizontal">

	<div class="win_w">
	<legend>查看用户</legend>
		<div class="control-group">
			<label class="control-label">用户名</label>
			<div class="controls">
			<p class="form-control-static"><?php echo html($u['name'])?></p>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">头像</label>
			<div class="controls">
				<p class="form-control-static">
    <?php
				
if ($u ['face'] != '') {
					?>
    <img src="<?php echo R.$u['face']?>?<?php echo strrand()?>" />
    
	<?php
				
} else {
					?> 还没有上传头像 <?php
				}
				?>
    </p>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">身份</label>
			<div class="controls">
				<p class="form-control-static"><?php echo html($C['sys_teams'][$u['team']]['name'])?></p>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">性别</label>
			<div class="controls">
				<p class="form-control-static"><?php echo html($u['sex']?'女':'男')?></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">注册时间</label>
			<div class="controls">
				<p class="form-control-static"><?php echo date('Y-m-d H:i:s',$u['reg_time'])?></p>
			</div>
		</div>
		<?php echo tab::tpls($C['user_tabs']['diss'],$C['user_tabs']['tpls'],'form_show.php',$u);?>

	</div>
</form>
