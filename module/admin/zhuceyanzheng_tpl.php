
<h3></h3>
<div class="col-md-12">

<form class="form-horizontal" role="form" id="form1" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_reg_t" class="col-sm-2 control-label">邮件标题</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_reg_t" name="sys_reg_t" placeholder="" value="<?php echo html($C['sys_reg_t'])?>">
      <p class="help-block">[webname] 网站名称, [name] 当前用户</p>
    </div>
  </div>
  
  <div class="form-group">
    <label for="sys_reg_c" class="col-sm-2 control-label">邮件内容</label>
    <div class="col-sm-8">
      
      <textarea name="sys_reg_c" class="" 
	id="sys_reg_c"><?php echo html($C['sys_reg_c'])?>
</textarea>
<p class="help-block">[webname] 网站名称, [name] 当前用户,[url] 密码链接</p>
    </div>
  </div>
  
<?php echo ini_editor('sys_reg_c','form1','300')?>  


  
  <div class="form-group">
                           <div class="col-md-offset-2 col-md-10">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  
</form>



</div>

