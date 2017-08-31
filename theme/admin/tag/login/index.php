<li class="dropdown user">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"
		data-hover="dropdown" data-close-others="true">
		<?php echo $C['sys_debug']?'<span style="color:red">[开发模式已启用]</span> ':''?>欢迎您:
		<span class="username hidden-480"><?php echo html($U['name'])?></span>
		<i class="icon-angle-down"></i>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="<?php echo url(RM.'useredit/?id='.$U['id'])?>"
				onclick="showwin(this.href);">
				<i class="glyphicon glyphicon-pencil"></i>
				更改资料
			</a>
		</li>

		<li class="divider"></li>
		<li>
			<a onclick="ajaxget(this.href);doane(event);"
				href="<?php echo url(RM.'upcache/')?>">
				<i class="glyphicon glyphicon-repeat"></i>
				更新缓存
			</a>
		</li>
		<li>
			<a href="<?php echo url(RM.'logout/')?>"
				onclick="ajaxget(this.href);doane(event);">
				<i class="glyphicon glyphicon-log-out"></i>
				退出
			</a>
		</li>
	</ul>
</li>
