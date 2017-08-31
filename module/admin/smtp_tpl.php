
<h3></h3>
<div class="col-md-12">

<form class="form-horizontal" role="form" id="<?php echo strrand()?>" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_webname" class="col-sm-2 control-label">网站域名</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_host" name="sys_host" placeholder="" value="<?php echo html($C['sys_host'])?>">
      <p class="help-block">不加http://</p>
    </div>
  </div>
  <div class="form-group">
    <label for="sys_mail_host" class="col-sm-2 control-label">邮件服务器</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_host" name="sys_mail_host" placeholder="" value="<?php echo html($C['sys_mail_host'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_mail_port" class="col-sm-2 control-label">端口号</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_port" name="sys_mail_port" placeholder="" value="<?php echo html($C['sys_mail_port'])?>">
    </div>
  </div>


    <div class="form-group">
    <label for="sys_mail_username" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_username" name="sys_mail_username" placeholder="" value="<?php echo html($C['sys_mail_username'])?>">
    </div>
  </div>
  
  
  
    <div class="form-group">
    <label for="sys_mail_password" class="col-sm-2 control-label">用户密码</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_password" name="sys_mail_password" placeholder="" value="<?php echo html($C['sys_mail_password'])?>">
    </div>
  </div>
  
  
    
    <div class="form-group">
    <label for="sys_mail_from" class="col-sm-2 control-label">发件人邮箱</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_from" name="sys_mail_from" placeholder="" value="<?php echo html($C['sys_mail_from'])?>">
    </div>
  </div>
  
  
      <div class="form-group">
    <label for="sys_mail_fromname" class="col-sm-2 control-label">发件人名称</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_mail_fromname" name="sys_mail_fromname" placeholder="" value="<?php echo html($C['sys_mail_fromname'])?>">
    </div>
  </div>
  
  
  
  <div class="form-group">
                           <div class="col-md-offset-2 col-md-10">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  
  
  
  
  
</form>



</div>

