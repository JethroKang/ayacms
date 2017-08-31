<div class="row">
  <?php
	
	$i=0;
	foreach($tarr as $k=>$v){
		$carr=explode('\n',$v['contact']);
		$carr=array_map('html',$carr);
		$cstr=implode('<br />',$carr);
		?>
  <div class="col-sm-6 col-md-3">
    <div class="thumbnail"> <img src="<?php echo $v['image']?>" alt="<?php echo $v['image']?>">
      <div class="caption">
        <h3>
          <?php echo html($v['name'])?>
        </h3>
        <p>作者:
          <?php echo html($v['author'])?>
          <br />
          日期:
          <?php echo date('Y-m-d',$v['date'])?>
          <br />
          <?php echo $cstr?>
        <p>路径: theme/
          <?php echo html($k)?>
          /</p>
        <p>
          <?php
			  
              if($C['sys_theme']==$k){
				  ?>
          <a role="button" class="btn btn-default green"> <span class="glyphicon glyphicon-ok"></span> 正在使用 </a>
          <a role="button" href="<?php echo url(R.'template/?tpl=default')?>" class="btn btn-primary"> 编辑 </a>
          <?php
			  }else{
				  ?>
          <a href="<?php echo url(RM.'theme/?theme='.$k)?>" class="btn btn-primary" role="button" onclick="ajaxget(this.href);doane(event);">立即使用</a>
          <?php
			  }
			  ?>
        </p>
      </div>
    </div>
  </div>
  <?php
	
	}
	?>
</div>

