
<form class="form-horizontal" name="form" id="<?php echo strrand()?>" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="ajaxp(this.id);return false;">
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
   <th style="width: 100px">排序</th>                           
<th>ID</th>                           
<th>模型名称</th>
			<th>说明</th>
			<th>版本号</th>
			<th>作者</th>
			<th style="width: 150px"></th>
                              </tr>
                           </thead>
                           <tbody>
                           

<?php
	
	$m=count($allmods);
	$i=0;
	foreach($allmods as $id=>$v){
		?>
		<tr>
        <td><input style="width: 60px" <?php echo $m<=$i?'disabled':''?> type="text"
				name="order[<?php echo $id?>]" value="<?php echo $m<=$i?'-':++$i?>" size="3"
				maxlength="3" /> </td>
        
        <td><?php echo $id?> </td>
        
			<td> <?php echo html($v['name'])?></td>

			<td><?php echo html($v['doc'])?></td>
			<td><?php echo html($v['ver'])?><span
				style="color: #878787; font-size: 11px;"> <?php echo empty($v['build'])?'':date('(Y-m-d)',strtotime($v['build']))?></span></td>
			<td><?php echo html($v['author'])?></td>

			<td><?php echo module_exists($id)?'<a role="button" class="btn btn-default btn-xs green"> <span class="glyphicon glyphicon-ok"></span> 正在使用 </a>':''?>
			<?php
		
		if($v['is_install']){
			?>  <a href="<?php echo url(RM.'admin/?mod='.$id.'&act=install')?>" onclick="if(confirm('要安装该模型吗?')) ajaxget(this.href);doane(event);" class="btn btn-default btn-xs yellow"><i class="icon-wrench"></i> 安装</a>
			
			<?php
		
		}
		?> <?php
		
		if($v['is_uninstall']){
			?> <a href="<?php echo url(RM.'admin/?mod='.$id.'&act=uninstall')?>"
				onclick="if(confirm('确定要卸载吗?')) ajaxget(this.href);doane(event);
" class="btn btn-default btn-xs "><i class="icon-trash"></i> 卸载</a> <?php
		
		}
		?></td>
		</tr>
		<?php
	
	}
	?>
                              
                           </tbody>
                        </table>
						
						<?php echo $page?>
                     </div>
                  </div> 
  
  <div class="form-group">
                           <div class="col-md-offset-1 col-md-11">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  </form>

