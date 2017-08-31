
<form class="form-horizontal">

	<div class="win_w">


		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">用户名</label>
			<div class="col-sm-5">
				<p class="form-control-static"><?php echo html($u['name'])?></p>

			</div>
		</div>


		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-5">

				<p class="form-control-static"><?php echo html($u['email'])?></p>

			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">注册时间</label>
			<div class="col-sm-5">

				<p class="form-control-static"><?php echo date('Y-m-d H:i:s',$u['reg_time'])?></p>

			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">性别</label>
			<div class="col-md-5">
				<p class="form-control-static"><?php echo html($u['sex']?'女':'男')?></p>

			</div>
		</div>


		<div class="form-group">
			<label class="col-md-2 control-label">身份</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo html($C['sys_teams'][$u['team']]['name'])?></p>


			</div>
		</div>

		<?php echo tab::tpls($C['user_tabs']['diss'],'form_show.php',$u);?>
		
	</div>


</form>

