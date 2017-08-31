
<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo furl(RM.'usernew/')?>" method="post" autocomplete="off"
	onsubmit="ajaxp(this.id);return false;">
 
<div class="win_w">
  

     <div class="form-group">
    <label for="name" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="name" name="name" placeholder="必填" value="">
    </div>
  </div>
   <div class="form-group">
    <label for="pass" class="col-sm-2 control-label">登陆密码</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="pass" name="pass" placeholder="必填" value="">
    </div>
  </div>
                           
      <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="email" name="email" placeholder="必填" value="">
    </div>
  </div>    
  
  <div class="form-group">
                              <label class="col-md-2 control-label">性别</label>
                              <div class="col-md-5">
                                <select class="form-control" name="sex">
                                 <option value="0">男</option>
	<option value="1">女</option>
                                 
                                                </select>    
                                    
                              </div>
                           </div>
                           
                           
  <div class="form-group">
                              <label class="col-md-2 control-label">身份</label>
                              <div class="col-md-5">
                                <select class="form-control" name="team">
                                <?php

foreach($C['sys_teams'] as $k=>$v){
	?>
	<option value="<?php echo $k?>" <?php echo $k===0?'selected="selected"':''?>><?php echo htmlspecialchars($v['name'])?>
	</option>
	<?php

}
?>
</select> 
                                    
                              </div>
                           </div>  
   
                    
  
              
    
  
  
  
  
  
  
          
  
  </div>
  


<div class="form-group">
                           <div class="col-md-offset-2 col-md-10">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
</form>








<script type="text/javascript">
	yun_onfocus("name");
</script>
