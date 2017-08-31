 <a class="btn btn-default pull-right" href="<?php echo url(RM.'teamnew/')?>"
	onclick="showwin(this.href)" role="button">新建用户组</a>
 <div class="clr margin-bottom-10"></div>



<form class="form-horizontal" name="form" id="<?php echo strrand()?>" action="<?php echo furl(RM.'teamdel/')?>"
	method="post" onsubmit="if(confirm('要删除用户组吗?'))  ajaxp(this.id);return false;">
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                              <th style="width: 60px"> </th>
                                 <th style="width:100px">ID</th>
			<th>用户组名</th>
			<th>人数</th>
                                 <th style="width: 150px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                           

	<?php
	
	foreach($arr as $k=>$v){
		?>
		<tr>
			<td><input name="ids[]" type="checkbox"
				<?php echo $k<5?'disabled':''?> value="<?php echo $k?>" /></td>
			<td ><?php echo $k?></td>
			<td><?php echo html($C['sys_teams'][$k]['name'])?></td>
			<td><?php echo $v?></td>
			<td>
            
             <a href="<?php echo url(RM.'teamedit/?id='.$k)?>" onclick="showwin(this.href);"class="btn default btn-xs purple"><i class="icon-edit"></i> 编辑</a>
                
                <a href="<?php echo url(RM.'teamdel/?id='.$k)?>" onclick="if(confirm('要删除用户组吗?'))ajaxget(this.href);doane(event);" class="btn default btn-xs black"><i class="icon-trash"></i> 删除</a>
            
			</td>
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
                              <button type="submit" class="btn blue">删除所选</button> 
                           </div>
                        </div>
  
  </form>

 


<script type="text/javascript">
</script>

