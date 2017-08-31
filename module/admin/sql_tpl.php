<form class="form-horizontal" name="form" id="<?php echo strrand()?>" action="<?php echo furl(RM.'sqlbackup/')?>"
	method="post" onsubmit="if(confirm('确定要备份吗?'))  ajaxp(this.id);return false;">
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                              <th style="width: 60px"> </th>
			<th>表名</th>
			<th>大小</th>
			<th>记录数</th>
			<th>整理</th>
                              </tr>
                           </thead>
                           <tbody>
                           

<?php
												
												foreach($tabs as $k=>$v){
													?>
            <tr>
			<td class="a-center"><input name="tabs[]" type="checkbox"
				value="<?php echo $v[0]?>" checked="checked" /></td>
			<td><?php echo $v[0]?></td>
			<td><?php echo $v[8]?>
                字节</td>
			<td><?php echo $v[4]?></td>
			<td><?php echo $v[14]?></td>
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
                              <button type="submit" class="btn blue">备份所选</button>
                               分卷大小: <input name="size" value="1024"
	style="width: 100px" /> K 
                           </div>
                        </div>
  
  </form>

<div class="margin-top-20"></div>

<form class="form-horizontal" name="form" id="<?php echo strrand()?>" action="<?php echo furl(RM.'sqldel/')?>"
	method="post" onsubmit="if(confirm('确定要删除选中的备份吗?'))  ajaxp(this.id);return false;">
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
    <th style="width: 60px"></th>                          
<th>备份名称</th>
			<th>分卷数量</th>
			<th>备份时间</th>
			<th style="width: 150px"></th>
                              </tr>
                           </thead>
                           <tbody>
                           
 <?php
								
								foreach($dirs as $v){
									?>
        <tr>
        <td><input name="ids[]" type="checkbox"
				value="<?php echo $v[0]?>" /></td>
			<td>SQL_
            <?php echo $v[0]?></td>
			<td><?php echo $v[1]?></td>
			<td><?php echo $v[2]?></td>
			<td>
            <a href="<?php echo url(RM.'sqlimport/?id='.$v[0])?>"
				onclick="if(confirm('确定要导入该备份吗?'))ajaxget(this.href);doane(event);" class="btn default btn-xs purple"><i class="icon-edit"></i> 导入</a>
                                 <a href="<?php echo url(RM.'sqldel/?id='.$v[0])?>"
				onclick="if(confirm('确定要删除该备份吗?'))ajaxget(this.href);doane(event);" class="btn default btn-xs black"><i class="icon-trash"></i> 删除</a>
            
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
                              <button type="submit" class="btn blue">删除所选</button> 
                               
                           </div>
                        </div>
  </form>



<script type="text/javascript">
</script>
