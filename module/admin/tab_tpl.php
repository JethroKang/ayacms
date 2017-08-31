
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    新建 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
   <?php
  foreach($C['tabtypes'] as $k=>$v){
	  ?>
    <li><a href="<?php echo url(RM.'tabnew/?type='.$k)?>" onclick="showwin(this.href)"><?php echo html($v)?></a></li>
   <?php
  }
  ?>
  
    <li class="divider"></li>
    
    <li><a href="<?php echo url(RM.'tab/')?>">返回到 列表页</a></li>
  </ul>
</div>
  
 <div class="clr margin-bottom-10"></div>
 
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>所在位置</th>
                                 <th>标题</th>
                                 <th>类型</th>
                                 <th>信息</th>
                                 <th>警告</th>
                                 <th style="width: 150px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                           
                           <?php
						   foreach($tabs as $v){
							   ?>
                              <tr>
                                 <td><?php echo $v['id']?></td>
                                 <td><?php echo PF.$v['fortab']?></td>
                                 <td><?php echo $v['title']?></td>
                                 <td><?php echo $C['tabtypes'][$v['type']]?>(<?php echo $v['type']?>)</td>
                                 <td><?php echo $v['info']?></td>
                                 <td><?php echo $v['warning']?></td>
                                 <td><a href="<?php echo url(RM.'tabedit/?id='.$v['id'])?>" class="btn default btn-xs purple" onclick="showwin(this.href)"><i class="icon-edit"></i> 编辑</a>
                                 <a href="<?php echo url(RM.'tabdel/?id='.$v['id'])?>" class="btn default btn-xs black" onclick="if(confirm('确定要删除该表吗?'))ajaxget(this.href);doane(event);"><i class="icon-trash"></i> 删除</a>
                                 </td>
                              </tr>
                            <?php
						   }
						   ?>
                              
                           </tbody>
                        </table>
                     </div>
                  </div> 
  
  