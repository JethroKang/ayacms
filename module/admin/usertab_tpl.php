<a class="btn btn-default pull-right"
	href="<?php echo url(RM.'usernew/')?>" onclick="showwin(this.href)"
	role="button">新建用户</a>


<ul class="nav nav-tabs">
	<li>
		<a href="<?php echo url(RM.'user/')?>" onclick="location=this.href">用户</a>
	</li>
	<li class="active">
		<a href="<?php echo url(RM.'usertab/')?>" onclick="location=this.href">表单</a>
	</li>

</ul>


<div class="clr margin-bottom-10"></div>

<form class="form-horizontal" role="form" id="form"
	action="<?php echo furl(RMA)?>" method="post"
	onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;"
	enctype="multipart/form-data">

	<div class="portlet-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="width: 80px">序号</th>
						<th>ID</th>
						<th>标题</th>
						<th>类型</th>
						<th>信息</th>
						<th>警告</th>
						<th style="width: 200px">模板</th>
						<th style="width: 80px">使用</th>
					</tr>
				</thead>
				<tbody>
<?php

$i=0;
foreach($diss as $k){
	$v=$tabs[$k];
	?>                        

<tr>
						<td>
							<input style="width: 60px" type="text" name="o[<?php echo $k?>]"
								value="<?php echo ++$i?>" size="3" maxlength="3">
						</td>
						<td><?php echo $k?></td>
						<td><?php echo html($v['title'])?></td>
						<td><?php echo html($C['tabtypes'][$v['type']])?>(<?php echo html($v['type'])?>)</td>

						<td><?php echo $v['info']?></td>
						<td><?php echo $v['warning']?></td>
						<td>

							<select name="tpls[<?php echo $k?>]" class="form-control">
								<option value="">默认</option>
            <?php
            
	foreach((array)$tabfiles[$v['type']] as $vv){
		?>
            <option value="<?php echo $vv?>"
									<?php echo $vv==$tpls[$k]?'selected="selected"':''?>>
            <?php echo html($vv)?>
            </option>
            <?php
	}
	?>
          </select>

						</td>
						<td>

							<label>
								<input type="checkbox" value="<?php echo $k?>"
									<?php echo in_array($k,$diss)?'checked="checked"':''?>
									name="diss[]" />
							</label>


						</td>
					</tr>
  <?php
}
?>   
<?php

foreach($tabs as $k=>$v){
	if(in_array($k,$diss))
		continue;
	?>                        

<tr>
						<td>
							<input style="width: 60px" type="text" name="o[<?php echo $k?>]"
								value="<?php echo ++$i?>" size="3" maxlength="3">
						</td>
						<td><?php echo $k?></td>
						<td><?php echo html($v['title'])?></td>
						<td><?php echo html($C['tabtypes'][$v['type']])?>(<?php echo html($v['type'])?>)</td>

						<td><?php echo $v['info']?></td>
						<td><?php echo $v['warning']?></td>
						<td>

							<select name="tpls[<?php echo $k?>]" class="form-control">
								<option value="">默认</option>
            <?php
	foreach((array)$tabfiles[$v['type']] as $vv){

		?>
            <option value="<?php echo $vv?>"
									<?php echo $vv==$tpls[$k]?'selected="selected"':''?>>
            <?php echo html($vv)?>
            </option>
            <?php
	}
	?>
          </select>

						</td>
						<td>

							<label>
								<input type="checkbox" value="<?php echo $k?>"
									<?php echo in_array($k,$diss)?'checked="checked"':''?>
									name="diss[]" />
							</label>


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
