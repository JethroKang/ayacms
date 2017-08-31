
<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo furl(RM.'teamnew/')?>" method="post" autocomplete="off"
	onsubmit="ajaxp(this.id);return false;">
  <div class="win_w">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">用户组名</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name" name="name" placeholder="必填" value="">
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-2 control-label">权限</label>
      <div class="col-sm-5">
        <div class="checkbox-list">
          <?php

foreach($C['sys_pvnames'] as $k=>$v){
	?>
          <label>
            <input type="checkbox" name="pvs[<?php echo $k?>]" value="1">
            <?php echo html($v)?>
          </label>
          <?php

}
?>
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
<script type="text/javascript">
	yun_onfocus("name");
</script> 
