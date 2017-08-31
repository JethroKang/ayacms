


  <form class="form-horizontal" role="form" id="form1" action="<?php echo furl(RMA.'?type='.$type)?>"
	method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">

<div class="win_w">
  <div class="form-group">
    <label for="tab_biaoti" class="col-sm-2 control-label">所在位置</label>
    <div class="col-sm-5">
      <select class="form-control" name="tabname">
<?php
foreach($tabs as $v){
	?>
  <option value="<?php echo html($v)?>"><?php echo html(PF.'_'.$v)?></option>
  <?php
}
?>
</select>
    </div>
  </div>


<?php echo $tpl?>

</div>

  <div class="form-group">
                           <div class="col-md-offset-2 col-md-5">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
  
  
  
  
  
  
</form>