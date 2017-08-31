
<form class="form-horizontal" id="form" action="<?php echo url(RMA.'?id='.$id)?>"
	method="post" onsubmit="ajaxp(this.id);return false;"
	autocomplete="off">
 
<div class="win_w">

  <div class="form-group">
                              <label class="col-md-2 control-label">所属模型</label>
                              <div class="col-md-5">
                                <select class="form-control" name="formod">
                                  <option value="" >                                
                                 <?php
											
											
											foreach($G['mods'] as $_mod=>$v){
												
												if(class_exists($_mod) && method_exists($_mod,'channel_new')) {
												
												?>
            <option value="<?php echo $_mod?>" <?php echo $_mod==$formod?'selected="selected"':''?>/>
              <?php echo html(modname($_mod))?>
              </option>
            <?php
												
											}
											}
											
												?>
                                 
                                                </select>    
                                    
                              </div>
                           </div>
                           
                           
   
   
   <div class="form-group">
    <label for="name" class="col-sm-2 control-label">栏目名称</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="name" name="name" placeholder="必填" value="<?php echo $name?>">
    </div>
  </div>
   
                           
      <div class="form-group">
    <label for="sign" class="col-sm-2 control-label">链接标识</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="sign" name="sign" placeholder="必填" value="<?php echo $sign?>">
    </div>
  </div>                        
  
       
  <div class="form-group">
    <label for="page" class="col-sm-2 control-label">位置</label>
    <div class="col-sm-5">
    <select class="form-control" name="pid">
	<option value="0">/</option>
<?php
												
			echo admin::menu_select(0,0,$id);
												?>
          </select>
    </div>
  </div>
  
  
  
  
  
        <div class="form-group" style="display:none">
    <label for="order" class="col-sm-2 control-label">排序号</label>
    <div class="col-sm-5">
    
      <input type="text" class="form-control" id="order" name="order" placeholder="必填" value="<?php echo $o?>">
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
<script>

$('#Tab a:first').tab('show');


if($$('name')) yun_onfocus("name");
 </script>
