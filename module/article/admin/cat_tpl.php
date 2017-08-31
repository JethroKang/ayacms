<?php
if(isset($_GET['new'])){
	?>

<form class="form-horizontal" role="form" id="form"
	action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&new')?>"
	method="post"
	onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
	enctype="multipart/form-data">

	<div class="win_w">

		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">分类名称</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="name" name="name"
					placeholder="必填" value="">
			</div>
		</div>
		<div class="form-group">
			<label for="subname" class="col-sm-2 control-label">小分类</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="subname" name="subname"
					placeholder="多个小分类用,分隔" value="">
			</div>
		</div>

	</div>

	<div class="form-group">
		<div class="col-md-offset-2 col-md-10">
			<button type="reset" class="btn default">重置</button>
			<button type="submit" class="btn blue">提交</button>
		</div>
	</div>



</form>


<?php
	return;
}
?>



<?php
if(isset($_GET['edit'])){
	?>

<form class="form-horizontal" role="form" id="form"
	action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&oid='.$oid.'&edit')?>"
	method="post"
	onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
	enctype="multipart/form-data">

	<div class="win_w">

		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">分类名称</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="name" name="name"
					placeholder="必填" value="<?php echo html($cats[$oid]['name'])?>">
			</div>
		</div>
		<div class="form-group">
			<label for="subname" class="col-sm-2 control-label">小分类</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="subname" name="subname"
					placeholder="多个小分类用,分隔"
					value="<?php echo html(implode(',',$cats[$oid]['subnames']))?>">
			</div>
		</div>

	</div>

	<div class="form-group">
		<div class="col-md-offset-2 col-md-10">
			<button type="reset" class="btn default">重置</button>
			<button type="submit" class="btn blue">提交</button>
		</div>
	</div>



</form>


<?php
	return;
}
?>


<ul class="nav nav-tabs">
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=&id='.$id)?>"
			onclick="location=this.href">信息</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=config&id='.$id)?>"
			onclick="location=this.href">配置</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=pv&id='.$id)?>"
			onclick="location=this.href">权限</a>
	</li>
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=tab&id='.$id)?>"
			onclick="location=this.href">表单</a>
	</li>

	<li class="active">
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


<a class="btn btn-default pull-right"
	href="<?php echo url(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&new')?>"
	onclick="showwin(this.href)" role="button">新建分类</a>
<div class="clr margin-bottom-10"></div>




<form class="form-horizontal" role="form" id="form"
	action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'')?>"
	method="post"
	onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
	enctype="multipart/form-data">

	<div class="portlet-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="width: 80px">序号</th>
						<th>分类名称</th>
						<th>子分类</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
   
<?php

$cats=$G['channels'][$id]['cats'];

foreach($cats as $k=>$v){
	?>                        

<tr>
						<td>
							<input style="width: 60px" type="text" name="order[]"
								value="<?php echo $k?>" size="3" maxlength="3">
						</td>
						<td><?php echo html($v['name'])?></td>
						<td><?php echo @html(implode(',', $v['subnames']))?></td>
						<td>
							<a
								href="<?php echo url(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&oid='.$k.'&edit')?>"
								onclick="showwin(this.href);"
								class="btn btn-default btn-xs purple">
								<i class="icon-edit"></i>
								编辑
							</a>

							<a
								href="<?php echo url(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&oid='.$k.'&del')?>"
								onclick="if(confirm('要删除分类吗?'))ajaxget(this.href);doane(event);"
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
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-offset-1 col-md-11">
			<button type="reset" class="btn default">重置</button>
			<button type="submit" class="btn blue ">提交</button>
		</div>
	</div>

</form>










