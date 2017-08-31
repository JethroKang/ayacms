

<div class="col-md-12">

<form class="form-horizontal" role="form" id="<?php echo strrand()?>" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_webname" class="col-sm-2 control-label">网站名称</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_webname" name="sys_webname" placeholder="" value="<?php echo html($C['sys_webname'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_keywords" class="col-sm-2 control-label">网站关键字</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_keywords" name="sys_keywords" placeholder="" value="<?php echo html($C['sys_keywords'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_description" class="col-sm-2 control-label">网站描述</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_description" name="sys_description" placeholder="" value="<?php echo html($C['sys_description'])?>">
    </div>
  </div>



<div class="form-group">
                              <label class="col-md-2 control-label">注册方式</label>
                              <div class="col-md-5">
                                 <div class="radio-list">
                                    <label class="radio-inline">
                                    <input type="radio" name="sys_reg" value="on" <?php echo $C['sys_reg']=='on'?'checked="checked"':''?>> 开放
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="sys_reg" value="email" <?php echo $C['sys_reg']=='email'?'checked="checked"':''?>> Email验证
                                    </label>
                                    <label class="radio-inline">
                                   <input type="radio" name="sys_reg" value="off" <?php echo $C['sys_reg']=='off'?'checked="checked"':''?>> 关闭
                                    </label>  
                                    
                               <p class="help-block">     
                                   Email验证,及密码找回功能,需要正确配置SMTP,点<a
	href="<?php echo url(RM.'smtp/')?>">[这里]</a> 
                                    </p> 
                                    
                                    
                                 </div>
                              </div>
                           </div>



    <div class="form-group">
    <label for="sys_kregword" class="col-sm-2 control-label">严禁注册词汇</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_kregword" name="sys_kregword" placeholder="" value="<?php echo htmlspecialchars(implode(',',$C['sys_kregword']))?>">
      <p class="help-block">多词汇用半角逗号","分隔</p>
    </div>
  </div>
  
  
    <div class="form-group">
    <label for="sys_kregword" class="col-sm-2 control-label">注册默认身份</label>
    <div class="col-sm-5">

<select name="sys_regteam" class="form-control">
            <?php
										
										foreach($C['sys_teams'] as $k=>$v){
											?>
            <option value="<?php echo $k?>"
		<?php echo $C['sys_regteam']==$k?'selected="selected"':''?>>
            <?php echo html($v['name'])?>
            </option>
            <?php
										
										}
										?>
          </select>

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

