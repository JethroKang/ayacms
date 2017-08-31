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
	<li class="active">
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
		method="post"
		onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
		enctype="multipart/form-data">





<?php for($i=1;$i<4;$i++){?>
		<div class="form-group">
			<label for="sys_lv_a_2" class="col-sm-2 control-label">应用重定向(<?php echo $i?>)</label>
			<div class="col-sm-5">
				<div class="row">

					<div class="col-xs-5">


						<select class="form-control" name="action_<?php echo $i?>">
							<option value=""></option>
		<?php
	foreach($act_files as $file){
		
		?>
                
							<option value="<?php echo $file?>"
								<?php echo $file==$channel['action_'.$i]?'selected="selected"':''?>><?php echo $file?></option>
							
							
              <?php
	}
	?>  </select>


					</div>
					<div class="col-xs-1">
						<p class="form-control-static">></p>
					</div>
					<div class="col-xs-5">

						<select class="form-control" name="action_<?php echo $i?>_to">
							<option value=""></option>
		<?php
	
	foreach($act_files as $file){
		
		?>
                <option value="<?php echo $file?>"
								<?php echo $file==$channel['action_'.$i.'_to']?'selected="selected"':''?>><?php echo $file?></option>
              <?php
	}
	?>  
			
              </select>

					</div>
				</div>
			</div>
		</div>
<?php }?>


<hr>

<?php for($i=1;$i<4;$i++){?>
		<div class="form-group">
			<label for="sys_lv_a_2" class="col-sm-2 control-label">模板重定向(<?php echo $i?>)</label>
			<div class="col-sm-5">
				<div class="row">

					<div class="col-xs-5">


						<select class="form-control" name="action_tpl_<?php echo $i?>">
							<option value=""></option>
		<?php
	foreach($tpl_files as $file){
		
		?>
                
							<option value="<?php echo $file?>"
								<?php echo $file==$channel['action_tpl_'.$i]?'selected="selected"':''?>><?php echo $file?></option>
							
							
              <?php
	}
	?>  </select>


					</div>
					<div class="col-xs-1">
						<p class="form-control-static">></p>
					</div>
					<div class="col-xs-5">

						<select class="form-control" name="action_tpl_<?php echo $i?>_to">
							<option value=""></option>
		<?php
	
	foreach($tpl_files as $file){
		
		?>
                <option value="<?php echo $file?>"
								<?php echo $file==$channel['action_tpl_'.$i.'_to']?'selected="selected"':''?>><?php echo $file?></option>
              <?php
	}
	?>  
			
              </select>

					</div>
				</div>
			</div>
		</div>
<?php }?>

<hr>

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

<?php for($i=1;$i<4;$i++){?>
		<div class="form-group">
			<label for="sys_lv_a_2" class="col-sm-2 control-label">主题重定向(<?php echo $i?>)</label>
			<div class="col-sm-5">
				<div class="row">

					<div class="col-xs-5">


						<select class="form-control" name="theme_tpl_<?php echo $i?>">
							<option value=""></option>
		<?php
	foreach($act_files as $file){
		
		?>
                
							<option value="<?php echo $file?>"
								<?php echo $file==$channel['theme_tpl_'.$i]?'selected="selected"':''?>><?php echo $file?></option>
							
							
              <?php
	}
	?>  </select>


					</div>
					<div class="col-xs-1">
						<p class="form-control-static">></p>
					</div>
					<div class="col-xs-5">

						<select class="form-control" name="theme_tpl_<?php echo $i?>_to">
							<option value=""></option>
		<?php
	
	foreach($theme_files as $file){
		
		?>
                <option value="<?php echo $file?>"
								<?php echo $file==$channel['theme_tpl_'.$i.'_to']?'selected="selected"':''?>><?php echo $file?></option>
              <?php
	}
	?>  
			
              </select>

					</div>
				</div>
			</div>
		</div>
<?php }?>




		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>


	</form>
</div>

