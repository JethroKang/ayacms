<ul class="nav nav-tabs">
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=&id='.$id)?>" 
			onclick="location=this.href">信息</a>
	</li>
	<li class="active">
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


<div class="clr margin-bottom-20"></div>

<div class="col-md-12">
	<form class="form-horizontal" role="form" id="form"
		action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id)?>"
		method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
		enctype="multipart/form-data">




		<div class="form-group">
			<label for="keywords" class="col-sm-2 control-label">关键字</label>
			<div class="col-sm-5">

				<input type="text" class="form-control" id="keywords"
					name="keywords" placeholder=""
					value="<?php echo $channel['keywords']?>">
			</div>
		</div>


		<div class="form-group">
			<label for="description" class="col-sm-2 control-label">描述</label>
			<div class="col-sm-5">

				<input type="text" class="form-control" id="description"
					name="description" placeholder=""
					value="<?php echo $channel['description']?>">
			</div>
		</div>

<?php if(0){?>
		<HR>

		<div class="form-group">
			<label for="t_num" class="col-sm-2 control-label">启用评论</label>
			<div class="col-sm-5">

				<div class="checkbox">
					<label>
						<input type="checkbox" value="1"
							<?php echo empty($channel['comment'])?'':'checked="checked"'?>
							name="comment" />
					</label>
				</div>

			</div>
		</div>
		<?php }?>
		<HR>

		<div class="form-group">
			<label for="t_num" class="col-sm-2 control-label">每页主题数</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="t_num" name="t_num"
					placeholder="" value="<?php echo html($t_num)?>">
			</div>
		</div>


		<div class="form-group">
			<label for="c_num" class="col-sm-2 control-label">每页评论数</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="c_num" name="c_num"
					placeholder="" value="<?php echo html($c_num)?>">
			</div>
		</div>

		<div class="form-group">
			<label for="tc_num" class="col-sm-2 control-label">主题页评论数</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="tc_num" name="tc_num"
					placeholder="" value="<?php echo html($tc_num)?>">
			</div>
		</div


		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>


	</form>
</div>

