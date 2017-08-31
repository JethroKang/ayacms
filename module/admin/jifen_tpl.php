
<h3></h3>
<div class="col-md-12">

<form class="form-horizontal" role="form" id="form1" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_t_a" class="col-sm-2 control-label">发表主题增加积分a</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_t_a" name="sys_t_a" placeholder="" value="<?php echo html($C['sys_t_a'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_t_b" class="col-sm-2 control-label">增加积分b</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_t_b" name="sys_t_b" placeholder="" value="<?php echo html($C['sys_t_b'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_t_c" class="col-sm-2 control-label">增加积分c</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_t_c" name="sys_t_c" placeholder="" value="<?php echo html($C['sys_t_c'])?>">
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="sys_r_a" class="col-sm-2 control-label">发表评论增加积分a</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_r_a" name="sys_r_a" placeholder="" value="<?php echo html($C['sys_r_a'])?>">
    </div>
  </div>
    <div class="form-group">
    <label for="sys_r_b" class="col-sm-2 control-label">增加积分b</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_r_b" name="sys_r_b" placeholder="" value="<?php echo html($C['sys_r_b'])?>">
    </div>
  </div>
  <div class="form-group">
    <label for="sys_r_c" class="col-sm-2 control-label">增加积分c</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_r_c" name="sys_r_c" placeholder="" value="<?php echo html($C['sys_r_c'])?>">
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

