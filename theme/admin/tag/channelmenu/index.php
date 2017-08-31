<?php
function __tag_channelmenu($id,$layer){
	global $G;
	
	$p=array();
	foreach($G['channels'] as $k=>$v){
	$p[$v['pid']][]=$k;	
	}
	
	foreach((array)$p[$id] as $cid){
		$c=$G['channels'][$cid];
	
	
	if($layer==0){
	?>
    <li class="dropdown">
            <a data-toggle="dropdown" class="btn" data-target="#"
               href="<?php echo url(RM.'admin/?mod='.$c['formod'].'&id='.$cid)?>" onclick="location=this.href">
                <?php echo html($c['name'])?>
                
                <?php
				if(isset($p[$cid])){
					?>
                <span class="caret"></span>
                <?php
				}
				?>
            </a>
            <?php
			if(isset($p[$cid])){
			?>
            <ul class="dropdown-menu" role="menu">
            <?php __tag_channelmenu($cid,$layer+1);?>
            </ul>
            <?php
	}
	?>
            
            
        </li>
        <?php		
	}else{
		?>
        
      
       <li <?php echo isset($p[$cid])?'class="dropdown-submenu"':''?>>
       
       
            <a tabindex="-1" href="<?php echo url(RM.'admin/?mod='.$c['formod'].'&id='.$cid)?>"><?php echo html($c['name'])?></a>
                
            <?php
			if(isset($p[$cid])){
			?>
            <ul class="dropdown-menu">
            <?php __tag_channelmenu($cid,$layer+1);?>
            </ul>
            <?php
	}
	?>
            
            
        </li>  
        
        
        
        <?php
	}
	}
	
	
}


__tag_channelmenu(0,0);