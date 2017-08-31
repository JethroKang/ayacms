<ul class="nav nav-tabs">
	<li class="active">
		<a href="javascript:void(0)" 
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



</ul>


<div class="clr margin-bottom-20"></div>




<form class="form-horizontal" role="form" id="form"
	action=""
	method="post" onsubmit="if(_submit()) ajaxp(this.id);return false;"
	enctype="multipart/form-data">

	<div class="portlet-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<TH style="width:60px"></TH>
						<th style="width:80px">ID</th>
						<th>标题</th>
						<th style="width:150px">发布时间</th>
						<th style="width:150px">作者</th>
						<th style="width:150px"></th>
					</tr>
				</thead>
				<tbody>
   
<?php

$i = 0;
foreach ( $posts as $k => $v ) {
	?>                        

<tr>

						<td>
							<label>
								<input type="checkbox" value="<?php echo $k?>" name="ids[]" />
							</label>
						</td>
						<td><?php echo $k?></td>
						<td>
							<a href="<?php echo $v['url'] ?>"><?php echo html($v['title'])?></a>
						</td>

						<td><?php echo $v['post_time']?></td>
						<td><?php echo html($v['name'])?></td>
						<td>
							<a
								href="<?php echo url(RMA.'?mod='.$mod.'&act=edit&id='.$id.'&pid='.$k)?>"
								class="btn btn-default btn-xs purple">
								<i class="icon-edit"></i>
								编辑
							</a>

							<a
								href="<?php echo url(RMA.'?mod='.$mod.'&act=del&id='.$id.'&pid='.$k)?>"
								onclick="if(confirm('要删除文章吗?'))ajaxget(this.href);doane(event);"
								class="btn btn-default btn-xs black">
								<i class="icon-trash"></i>
								删除
							</a>



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
			<button type="submit" class="btn default" onclick="_type='del';">删除</button>
			<button class="btn btn-primary" data-toggle="modal" data-target="#moveModal" >移动</button>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="moveModalLabel">移动</h4>
      </div>
      <div class="modal-body">

      		<div class="form-group">
			<label class="col-md-2 control-label">目标</label>
			<div class="col-md-5">
				<select class="form-control" name="tochannel">
				<option value="0"></option>                
<?php
foreach($G['channels'] as $k=>$v){
if($v['formod']==$mod) {
?>
            <option value="<?php echo $k?>" <?php echo $k==$id?'disabled':''?>>
             <?php echo $v['name']?>
              </option>
            <?php
            }
            }
            ?>
             </select>

			</div>
		</div>
		
	
		
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" onclick="_type='move';">移动</button>
      </div>
    </div>
  </div>
</div>



<?php echo $page?>
</form>







<script type="text/javascript"> 
var _type='';
function _submit(){


if(_type=='del'){
	if(confirm('要删除所选主题吗?')){
	document.getElementById("form").action="<?php echo furl(RMA.'?mod='.$mod.'&act=del&id='.$id.'')?>";
	return true;
	}else
		return false;
		
}else if(_type=='move'){

	if(confirm('要移动所选主题吗?')){
		document.getElementById("form").action="<?php echo furl(RMA.'?mod='.$mod.'&act=move&id='.$id.'')?>";
		return true;
		}else
			return false;
	
}




}
</script>



