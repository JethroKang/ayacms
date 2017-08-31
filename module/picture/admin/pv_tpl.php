<ul class="nav nav-tabs">
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=&id='.$id)?>" 
			onclick="location=this.href">信息</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=config&id='.$id)?>"
			 onclick="location=this.href">配置</a>
	</li>
	<li class="active">
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=pv&id='.$id)?>"
			 onclick="location=this.href">权限</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=tab&id='.$id)?>"
			 onclick="location=this.href">表单</a>
	</li>

	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=cat&id='.$id)?>"
			 onclick="location=this.href">分类</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=redi&id='.$id)?>"
			 onclick="location=this.href">重定向</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=new&id='.$id)?>"
			 onclick="location=this.href">发表</a>
	</li>
</ul>



<div class="col-md-12">
	<form class="form-horizontal" role="form" id="form"
		action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id)?>"
		method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
		enctype="multipart/form-data">



<?php

$pvs =  $G ['channels'] [$id] ['pvs'];

$pv_names = $G ['mods'] [$mod] ['pv_names'];
foreach ( $C ['sys_teams'] as $k => $v ) {
	?>
	
<div class="form-group">
			<label class="col-md-2 control-label"><?php echo html($v['name'])?></label>
			<div class="col-md-5">
				<div class="radio-list">
                                 <?php
	
	foreach ( $pv_names as $k2 => $v2 ) {
		?>
		<label class="radio-inline">
						<input type="checkbox" value="1"
							<?php echo (empty($pvs[$k][$k2])?'':'checked="checked"')?>
							name="pvs[<?php echo $k?>][<?php echo $k2?>]" /> <?php echo html($v2)?></label>
			<?php
	}
	?>
                                 
                                    
                               <p class="help-block"></p>


				</div>
			</div>
		</div>	
	

    
		<?php
}
?>

  <div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>



	</form>

</div>






