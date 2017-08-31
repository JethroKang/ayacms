<a class="btn btn-default pull-right"
	href="<?php echo url(RM.'usernew/')?>" onclick="showwin(this.href)"
	role="button">新建用户</a>


<ul class="nav nav-tabs">
	<li class="active">
		<a href="<?php echo url(RM.'user/')?>" onclick="location=this.href">用户</a>
	</li>
	<li>
		<a href="<?php echo url(RM.'usertab/')?>" onclick="location=this.href">表单</a>
	</li>

</ul>


<div class="clr margin-bottom-10"></div>

<form class="form-inline" action="<?php echo url(RMA)?>" method="get">
<?php

if (!IS_REWRITE) {
	?> <input name="admin/user/" type="hidden" value="" />
		<?php
}
?>

  <div class="form-group">
		<input type="text" class="form-control" name="skey"
			placeholder="键入用户名" value="<?php echo $skey?>" />
	</div>
	<button type="submit" class="btn btn-default">搜</button>
</form>


<div class="clr margin-bottom-10"></div>

<form class="form-horizontal" name="form" id="<?php echo strrand()?>"
	action="<?php echo furl(RM.'userdel/')?>" method="post"
	onsubmit="if(confirm('要删除用户吗?'))  ajaxp(this.id);return false;">
	<div class="portlet-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="width: 60px"></th>
						<th style="width: 100px">ID</th>
						<th>名称</th>
						<th>邮箱</th>
						<th>注册时间</th>
						<th>身份</th>
						<th style="width: 225px">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
                           

	<?php
	
	foreach ( $arr as $id => $v ) {
		?>
		<tr>
						<td>
							<input name="ids[]" type="checkbox" value="<?php echo $id?>" />
						</td>
						<td><?php echo $id?></td>
						<td><?php echo html($v['name'])?></td>
						<td><?php echo html($v['email'])?></td>
						<td><?php echo $v['reg_time']?></td>
						<td><?php echo html($v['team'])?></td>
						<td>
							<a href="<?php echo url(RM.'usershow/?id='.$id)?>"
								onclick="showwin(this.href);"
								class="btn btn-default btn-xs green">
								<i class="icon-user"></i>
								详情
							</a>

							<a href="<?php echo url(RM.'useredit/?id='.$id)?>"
								onclick="showwin(this.href);"
								class="btn btn-default btn-xs purple">
								<i class="icon-edit"></i>
								编辑
							</a>

							<a href="<?php echo url(RM.'userdel/?id='.$id)?>"
								onclick="if(confirm('要删除用户吗?'))ajaxget(this.href);doane(event);"
								class="btn btn-default btn-xs black">
								<i class="icon-trash"></i>
								删除
							</a>

						</td>
					</tr>
		<?php
	}
	?>
                              
                           </tbody>
			</table>
						
						<?php echo $page?>
                     </div>
	</div>

	<div class="form-group">
		<div class="col-md-offset-1 col-md-11">
			<button type="reset" class="btn default">重置</button>
			<button type="submit" class="btn blue">删除所选</button>
		</div>
	</div>

</form>




<script type="text/javascript">
</script>
