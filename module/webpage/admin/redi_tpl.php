<ul class="nav nav-tabs">
	<li>
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=index&id='.$id)?>"
			onclick="location=this.href">编辑</a>
	</li>
	<li class="active">
		<a href="<?php echo url(RMA.'?mod='.$mod.'&act=redi&id='.$id)?>"
			 onclick="location=this.href">模板</a>
	</li>
</ul>


<div class="clr margin-bottom-20"></div>

<div class="col-md-12">
	<form class="form-horizontal" role="form" id="form"
		action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id)?>"
		method="post"
		onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
		enctype="multipart/form-data">

		<div class="form-group">
			<label for="" class="col-sm-2 control-label">缺省主题</label>
			<div class="col-sm-2">

				<select class="form-control" name="theme_tpl">
					<option value="default.php">default.php</option>
		<?php
		
		foreach($theme_files as $file){
			if($file=='default.php')
				continue;
			
			?>
                <option value="<?php echo $file?>"
						<?php echo $file==$channel['theme_tpl']?'selected="selected"':''?>><?php echo $file?></option>
              <?php
		}
		?>  
			
              </select>

			</div>
		</div>


		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>


	</form>
</div>

