<?php
global $G;
$tpl=get_val('tpl');
ob_start();
?>
<script type="text/javascript">
function open_diy_box(){
	$('#diy_list').modal('show').css({
    width: '90%',
    'margin-left': function () {
       return -($(this).width() / 2);
   }
});
	
}
</script>
<style>
.tooltip {
	position: absolute;
	z-index: 1030;
	display: block;
	font-size: 12px;
	line-height: 1.4;
	opacity: 0;
	filter: alpha(opacity = 0);
	visibility: visible;
}

.tooltip.in {
	opacity: 1;
	filter: alpha(opacity = 100);
}

.tooltip-inner {
	max-width: 300px;
	width: 300px;
	padding: 8px;
	color: #000;
	text-align: left;
	text-decoration: none;
	background-color: #f0f0f0;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	border: 1px solid #ddd;
}
</style>

<div class="navbar navbar-fixed-top" onclick="open_diy_box()">
	<div class="navbar-inner" style="min-height: 15px !important;font-size: 10px;">DIY</div>
</div>


<!-- /.modal -->
<div class="modal hide fade" id="diy_list">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>

		<h4 class="modal-title">
			<div class="btn-group">
				<button class="btn">当前: <?php echo html($tpl)?></button>
				<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
  <?php
		$tpls=get_val('tpls');
		foreach($tpls as $file){
			
			?>
    <li>
						<a href="<?php echo url(R.'template/?tpl='.$file)?>"><?php echo html($file)?></a>
					</li>
  <?php
		}
		?>
  </ul>
			</div>
		</h4>


	</div>
	<div class="modal-body">


		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_5_1" data-toggle="tab">布局</a>
				</li>
				<li class="">
					<a href="#tab_5_2" data-toggle="tab">装饰</a>
				</li>
				<li>
					<a href="#tab_5_3" data-toggle="tab">调用</a>
				</li>
			</ul>
			<div class="tab-content"
				style="overflow-y: scroll; overflow-x: hidden;">
				<div class="tab-pane active" id="tab_5_1">
					<p>
					
					
					<div class="row-fluid">
						<div class="span2">

							<ul class="list-group">
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','12:0:0');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									12
								</li>
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','6:6:0');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									6:6 (1:1)
								</li>
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','8:4:0');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									8:4 (2:1)
								</li>
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','4:8:0');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									4:8 (1:2)
								</li>


								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','4:4:4');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									4:4:4 (1:1:1)
								</li>
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','3:6:3');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									3:6:3 (1:2:1)
								</li>
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','3:3:6');"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									3:3:6 (1:1:2)
								</li>

							</ul>
						</div>
						<div class="span2">
							<li class="list-group-item">
								<a class="badge" onfocus=this.blur();
									onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','6:3:3');"
									href="javascript:;" data="">
									<span class="glyphicon glyphicon-fullscreen"></span>
									拖动
								</a>
								6:3:3 (2:1:1)
							</li>

							<li class="list-group-item">
								<a class="badge" onfocus=this.blur();
									onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','2:6:4');"
									href="javascript:;" data="">
									<span class="glyphicon glyphicon-fullscreen"></span>
									拖动
								</a>
								2:6:4 (1:3:2)
							</li>
							<li class="list-group-item">
								<a class="badge" onfocus=this.blur();
									onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame','4:6:2');"
									href="javascript:;" data="">
									<span class="glyphicon glyphicon-fullscreen"></span>
									拖动
								</a>
								4:6:2 (2:3:1)
							</li>

						</div>
						<div class="span2">
							<ul class="list-group">

								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj(event,'frame',$('#frame_code').val());"
										href="javascript:;" data="">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
									<select class="span7" id="frame_code">
											<?php
											for($i=1;$i<12;$i++){
												$val=$i.":".(12-$i);
												?>
  <option value="<?php echo $val?>"><?php echo $val?></option>
  <?php }?>
											
		<?php
		for($n=1;$n<11;$n++){
			for($i=1;$i<(12-$n);$i++){
				$val=$n.":".$i.':'.(12-$n-$i);
				?>
  <option value="<?php echo $val?>"><?php echo $val?></option>
  <?php }}?>							</select>
								</li>

							</ul>
						</div>
						<div class="span2"></div>
					</div>
					</p>



				</div>
				<div class="tab-pane" id="tab_5_2">
					<p>
					
					
					<div class="row-fluid">

						<div class="span2">
							<ul class="list-group">		
							<?php
							$n=0;
							reset($G['tags']);
							while(list($k,$v)=@each($G['tags'])){
								if($v['type']!='css')
									continue;
								
								?>
								
								<?php
								$n++;
								if($n>1&&$n%7==1){
									?>
																
									</ul>
						</div>
						<div class="span2">
							<ul class="list-group">
								<?php
								}
								?>	
								
								
	<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj (event,'block','<?php echo $k?>');"
										href="javascript:;" data="" data-toggle="tooltip"
										data-placement="right" title=""
										data-original-title="<?php echo html($v['code'][0].$v['code'][1].$v['code'][2])?>">
										<span
											class="
										
										glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
											<?php echo html($v['name'])?>
										
							
							</li>
										
									
										
										
		<?php
							}
							?>
													
									</ul>
						</div>
					</div>
					</p>
				</div>

				<div class="tab-pane" id="tab_5_3">
					<p>
					
					
					<div class="row-fluid">
						<div class="span2">
							<ul class="list-group">
									
							<?php
							$n=0;
							reset($G['tags']);
							while(list($k,$v)=@each($G['tags'])){
								if($v['type']!='call')
									continue;
								
								?>
								
								<?php
								$n++;
								if($n>1&&$n%7==1){
									?>
																
									</ul>
						</div>
						<div class="span2">
							<ul class="list-group">
								<?php
								}
								?>	
								
								
								<li class="list-group-item">
									<a class="badge" onfocus=this.blur();
										onmousedown="$('#diy_list').modal('hide');drag.createObj (event,'block','<?php echo $k?>');"
										href="javascript:;" data="" data-toggle="tooltip"
										data-placement="right" title=""
										data-original-title="<?php echo html($v['code'][0].$v['code'][1].$v['code'][2])?>">
										<span class="glyphicon glyphicon-fullscreen"></span>
										拖动
									</a>
											<?php echo html($v['name'])?>
										</li>
		<?php
							}
							?>
									</ul>
						</div>



					</div>


					</p>
				</div>
			</div>
		</div>


	</div>
	<div class="modal-footer">


		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		<div class="btn-group">

			<button type="button" class="btn btn-primary"
				onclick="document.getElementById('diy_save_name').value='';javascript:spaceDiy.save();return false;">立即保存</button>
			<button class="btn dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="#" data-toggle="modal" data-target="#diyas">另存为</a>
				</li>
				<li>
					<a href="<?php echo url(RM.'del/?tpl='.$tpl)?>"
						onclick="if(confirm('确定要删除吗?'))ajaxget(this.href);doane(event);">删除</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?php echo url(RM.'re/')?>"
						onclick="if(confirm('确定还原到上次吗?'))ajaxget(this.href);doane(event);">还原</a>
				</li>
			</ul>
		</div>

	</div>
</div>



<div class="modal hide fade" id="diyas" tabindex="-1" role="dialog"
	aria-labelledby="diyasLabel" aria-hidden="true">

	<form class="form-horizontal" role="form" id="<?php echo strrand()?>"
		action="<?php echo furl(RM.'as/')?>" method="post"
		onsubmit="ajaxp(this.id);return false;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="diyasLabel">模板名称</h4>
		</div>
		<div class="modal-body">

			<div class="control-group">
				<label class="control-label">模板名称</label>
				<div class="controls">
					<input type="text" id="save_as" name="save_as" placeholder="字母或数字"
						value="">
						<span class="help-block">*保存为"user",用户模型会优先使用.</span>
				</div>
			</div>
			<INPUT type=hidden name=themename value="<?php echo THEMENAME?>" />
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			<button type="submit" class="btn btn-primary">确定</button>
		</div>


	</form>
</div>


<form id="diyform" method="post" name="diyform"
	action="<?php echo furl(R.'template/diysave/')?>">
	<INPUT type=hidden name=themefile value="<?php echo THEMEFILE?>" />
	<INPUT type=hidden name=themename value="<?php echo THEMENAME?>" />
	<INPUT type=hidden name=curl value=<?php echo CURL?> />
	<INPUT type=hidden id="diy_save_name" name=save_as value="" />
	<INPUT type=hidden name=layoutdata>
</form>
<script type="text/javascript">
$('.badge').tooltip({'html':true});
</script>

<?php
$html=ob_get_contents();
ob_end_clean();
return $html;
