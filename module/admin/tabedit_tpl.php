<form class="form-horizontal" id="<?php echo strrand()?>"
	action="<?php echo furl(RMA.'?id='.$id)?>" method="post" autocomplete="off"
	onsubmit="ajaxp(this.id);return false;">
    
    <div class="win_w">
    <?php echo $tpl?>
    
    </div>
    
    
    <div class="form-group">
                           <div class="col-md-offset-2 col-md-5">                        
                              <button type="reset" class="btn default">重置</button>  
                              <button type="submit" class="btn blue">提交</button> 
                           </div>
                        </div>
                        
                        
    </form>