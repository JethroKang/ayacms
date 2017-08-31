
<h3></h3>
<div class="col-md-12">

<form class="form-horizontal" role="form" id="form" action="<?php echo furl(RMA)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">
  
  <div class="form-group">
    <label for="sys_webname" class="col-sm-2 control-label">协议内容</label>
    <div class="col-sm-8">
      
      <textarea name="sys_regc" class="" 
	id="sys_regc"><?php echo html($C['sys_regc'])?>
</textarea>
<p class="help-block">此处不填写,将使用默认协议</p>
    </div>
  </div>
  
<?php echo ini_editor('sys_regc','form','300')?>  


  
  <div class="form-group">
                           <div class="col-md-offset-2 col-md-10">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  
</form>



</div>

