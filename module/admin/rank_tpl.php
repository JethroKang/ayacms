
<h3 ></h3>
<div class="col-md-12">

<form class="form-horizontal" role="form" id="form" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_lv_a_0" class="col-sm-2 control-label">积分a基数</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_lv_a_0" name="sys_lv_a[0]" placeholder="" value="<?php echo html($C['sys_lv_a'][0])?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="sys_lv_a_2" class="col-sm-2 control-label">积分a级别递增</label>
    <div class="col-sm-5">
      <div class="row">

  <div class="col-xs-4">
    
    
    <select class="form-control"
		name="sys_lv_a[1]">
                <option value="0"
			<?php echo empty($C['sys_lv_a'][1])?'selected="selected"':''?>>相对基数</option>
                <option value="1"
			<?php echo empty($C['sys_lv_a'][1])?'':'selected="selected"'?>>相对前一级</option>
              </select>
    
    
  </div>
  <div class="col-xs-3">
    
    <div class="input-group">
        <input name="sys_lv_a[2]" id="sys_lv_a_2" type="text" class="form-control" value="<?php echo $C['sys_lv_a'][2]?>">
        <span class="input-group-addon">%</span>
      </div>
    
  </div>
</div>
    </div>
  </div>
  
  
  
  
  
  
  
  <div class="form-group">
    <label for="sys_lv_b_0" class="col-sm-2 control-label">积分b基数</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_lv_b_0" name="sys_lv_b[0]" placeholder="" value="<?php echo html($C['sys_lv_b'][0])?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="sys_lv_a_2" class="col-sm-2 control-label">积分b级别递增</label>
    <div class="col-sm-5">
      <div class="row">

  <div class="col-xs-4">
    
    
    <select class="form-control"
		name="sys_lv_b[1]">
                <option value="0"
			<?php echo empty($C['sys_lv_b'][1])?'selected="selected"':''?>>相对基数</option>
                <option value="1"
			<?php echo empty($C['sys_lv_b'][1])?'':'selected="selected"'?>>相对前一级</option>
              </select>
    
    
  </div>
  <div class="col-xs-3">
    
    <div class="input-group">
        <input name="sys_lv_b[2]" id="sys_lv_b_2" type="text" class="form-control" value="<?php echo $C['sys_lv_b'][2]?>">
        <span class="input-group-addon">%</span>
      </div>
    
  </div>
</div>
    </div>
  </div>
  
  
  
 
 
 <div class="form-group">
    <label for="sys_lv_c_0" class="col-sm-2 control-label">积分c基数</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="sys_lv_c_0" name="sys_lv_c[0]" placeholder="" value="<?php echo html($C['sys_lv_c'][0])?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="sys_lv_c_2" class="col-sm-2 control-label">积分c级别递增</label>
    <div class="col-sm-5">
      <div class="row">

  <div class="col-xs-4">
    
    
    <select class="form-control"
		name="sys_lv_b[1]">
                <option value="0"
			<?php echo empty($C['sys_lv_c'][1])?'selected="selected"':''?>>相对基数</option>
                <option value="1"
			<?php echo empty($C['sys_lv_c'][1])?'':'selected="selected"'?>>相对前一级</option>
              </select>
    
    
  </div>
  <div class="col-xs-3">
    
    <div class="input-group">
        <input name="sys_lv_c[2]" id="sys_lv_c_2" type="text" class="form-control" value="<?php echo $C['sys_lv_c'][2]?>">
        <span class="input-group-addon">%</span>
      </div>
    
  </div>
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



</div>

