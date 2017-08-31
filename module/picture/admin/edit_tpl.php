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
	<li class="active">
		<a href="###" onclick="location=this.href">编辑</a>
	</li>
</ul>





<div class="clr margin-bottom-20"></div>

<div class="col-md-12">
	<form class="form-horizontal" role="form"
		id="<?php echo $formid=strrand()?>"
		action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id.'&pid='.$pid)?>"
		method="post"
		onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
		enctype="multipart/form-data">

		<div class="form-group">
			<label class="col-sm-2 control-label">标题</label>
			<div class="col-sm-5">

				<input type="text" class="form-control" id="title" name="title"
					placeholder="必填" value="<?php echo html($post['title'])?>">
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label">链接标志</label>
			<div class="col-sm-5">

				<input type="text" class="form-control" id="sign" name="sign"
					placeholder="字母或数字" value="<?php echo html($post['sign'])?>">
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label">描述</label>
			<div class="col-sm-5">
				<textarea class="form-control" id="description" cols="" rows=""
					name="description" placeholder=""><?php echo html($post['description'])?></textarea>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-2 control-label">关键字</label>
			<div class="col-sm-5">

				<input type="text" class="form-control" id="keywords"
					name="keywords" placeholder="多关键字用,分隔"
					value="<?php echo html($post['keywords'])?>">
			</div>
		</div>

		<?php
		
		$cats=$channel['cats'];
		foreach($cats as $k=>$v){
			if(empty($v['name'])||empty($v['subnames']))
				continue;
			?>
<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo html($v['name'])?></label>
			<div class="col-sm-5">

				<select class="form-control" name="cat_<?php echo $k?>">
					<option value="0"></option>
				<?php
			foreach($v['subnames'] as $k2=>$v2){
				if(empty($v2))
					continue;
				?>			
							
		<option value="<?php echo $k2+1?>"
						<?php echo ($k2+1)==$post['cat_'.$k]?'selected="selected"':''?>><?php echo html($v2)?></option>
							
							
              <?php
			}
			?>  </select>

			</div>
		</div>

<?php
		}
		?>
				<div class="form-group">
			<label class="col-sm-2 control-label">缩略图</label>
			<div class="col-sm-5">
				<?php echo init_upload('thumb','jpg,jpge,gif,png',$post['thumb'])?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">图片</label>
			<div class="col-sm-5">
<?php echo init_uploads('pics','jpg,jpge,gif,png',$post['pics'])?>	
				
				<p class="help-block"></p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">内容</label>
			<div class="col-sm-8">

				<textarea name="content" class="" id="content"><?php echo html($post['content'])?>
</textarea>
				<p class="help-block"></p>
			</div>
		</div>
  
<?php echo ini_editor('content',$formid,'150')?>  
	
		<div class="form-group">
			<label class="col-sm-2 control-label">分页标题</label>
			<div class="col-sm-5">
				<textarea class="form-control" id="pagetitles" cols="" rows=""
					name="pagetitles" placeholder="每行一个分标题"><?php echo html($post['pagetitles'])?></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">推荐</label>
			<div class="col-sm-5">

				<div class="checkbox">
					<label>
						<input type="checkbox" value="1"
							<?php echo empty($post['tuijian'])?'':'checked="checked"'?>
							name="tuijian" />
					</label>
				</div>

			</div>
		</div>


<?php echo tab::tpls ( $channel['tabs']['diss'],'form_edit.php',$post);?>

		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>


	</form>
</div>







