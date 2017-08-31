<?php
if ($U ['id'] < 1) {
	?>
	<div class="<?php echo $align?>">
<a class="btn btn-primary btn-mini" onclick="showwin(this.href)"
	href="<?php echo url(R.'user/login/')?>">登陆</a>
<a class="btn btn-default btn-mini" onclick="showwin(this.href)"
	href="<?php echo url(R.'user/reg/')?>">注册</a>
<a class="btn btn-default btn-mini" onclick="showwin(this.href)"
	href="<?php echo url(R.'user/pass/')?>">忘记密码?</a>
	</div>
<?php }else{?>

<div class="dropdown <?php echo $align?>">
	欢迎您:
	<a href="###" class="dropdown-toggle" data-toggle="dropdown"><?php echo html($U['name'])?>
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="<?php echo url(R.'user/show/')?>">
				<i class="icon-user"></i>
				查看资料
			</a>
		</li>
		<li>
			<a href="<?php echo url(R.'user/edit/')?>">
				<i class="icon-edit"></i>
				编辑资料
			</a>
		</li>
		<li>
			<a href="<?php echo url(R.'user/passedit/')?>">
				<i class=" icon-star-empty"></i>
				修改密码
			</a>
		</li>
		<li>
			<a href="<?php echo url(R.'user/')?>">
				<i class="icon-th"></i>
				更多...
			</a>
		</li>
<?php
	if (! empty ( $BPV [2] )) {
		?>
		<li class="divider"></li>
		<li>
			<a href="<?php echo url(R.'admin/')?>">
				<i class="icon-wrench"></i>
				后台
			</a>
		</li>
		<?php
	}
	?>
		<li class="divider"></li>
		<li>
			<a href="<?php echo url(R.'user/logout/')?>"
				onclick="ajaxget(this.href);doane(event);">
				<i class="icon-share"></i>
				退出
			</a>
		</li>
	</ul>
</div>

<?php }
?>
<div class="clearfix"></div>