<?php 
if($type=='new'){
?>
<div class="form-group">
	<label for="tab_biaoti" class="col-sm-2 control-label">标题</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="title" name="title"
			placeholder="1~255个字" value="">
	</div>
</div>



<div class="form-group">
	<label for="tab_biaoti" class="col-sm-2 control-label">最少字数</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="conf[0]" name="conf[0]"
			placeholder="0~255之内的数字,0代表可以为空" value="">
	</div>
</div>

<div class="form-group">
	<label for="tab_biaoti" class="col-sm-2 control-label">最多字数</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="conf[1]" name="conf[1]"
			placeholder="1~255之内的整数" value="">
	</div>
</div>


<div class="form-group">
	<label for="tab_biaoti" class="col-sm-2 control-label">提示</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="info" name="info"
			placeholder="0~255个字" value="">
	</div>
</div>


<div class="form-group">
	<label for="tab_biaoti" class="col-sm-2 control-label">警告</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="warning" name="warning"
			placeholder="1~255个字" value="">
	</div>
</div>
<?php 
}else if($type=='edit'){
?>


<div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">ID</label>
    <div class="col-sm-5">
      <p class="form-control-static"><?php echo html($tab['id'])?></p>
    </div>
  </div>
    
    <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">所在位置</label>
    <div class="col-sm-5">
    <p class="form-control-static"><?php echo html(PF.$tab['fortab'])?></p>
	
    </div>
  </div>
    
      <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="title" name="title" placeholder="1~255个字" value="<?php echo html($tab['title'])?>">
    </div>
  </div>
  

        <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">最少字数</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="conf[0]" name="conf[0]" placeholder="0~255之内的数字,0代表可以为空" value="<?php echo $tab['conf'][0]?>">
    </div>
  </div>
  
    <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">最多字数</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="conf[1]" name="conf[1]" placeholder="1~255之内的整数" value="<?php echo $tab['conf'][1]?>">
    </div>
  </div>
 
  
  <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">提示</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="info" name="info" placeholder="0~255个字" value="<?php echo html($tab['info'])?>">
    </div>
  </div>
  
    
  <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">警告</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="warning" name="warning" placeholder="1~255个字" value="<?php echo html($tab['warning'])?>">
    </div>
  </div>  



<?php }
?>