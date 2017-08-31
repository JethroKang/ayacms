

 <a class="btn btn-default pull-right" href="<?php echo url(RM.'channelnew/')?>"
	onclick="showwin(this.href)" role="button">新建栏目</a>
 <div class="clr margin-bottom-10"></div>
 
 
 <form class="form-horizontal" id="form" action="<?php echo url(RMA)?>"
	method="post" onsubmit="ajaxp(this.id);return false;"
	autocomplete="off">
 <div class="portlet-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th style="width: 60px">ID</th>
                                 <th>排序 | 栏目名称</th>
                                 <th>链接标识</th>
                                 <th>所属模型</th>
                                 <th>首页</th>
                                 <th>隐藏</th>
                                 <th style="width: 150px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody>
                           

	<?php
	echo admin::channel_list();
	?>
                              
                           </tbody>
                        </table>
                     </div>
                  </div> 
  
  <div class="form-group">
                           <div class="col-md-offset-1 col-md-11">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  </form>
  