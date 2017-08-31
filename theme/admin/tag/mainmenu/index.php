<?php

$ctitle=get_val('current_mainmenu_title');
$clist=get_val('current_mainmenu_list');


$title_arr=do_apply('mainmenu_title');
$list_arr=do_apply('mainmenu_list');
$_listarr=array();

foreach($list_arr as $v){
	$_listarr[$v[2]][]=$v;
}

$num=count($title_arr);
foreach($title_arr as $k=>$v){

$title_class=$k===0?'start ':'';
$title_class.=($num>1&&$num==($k+1))?'last ':'';
$title_class.=$v[0]==$ctitle?'active ':'';

$url=empty($v[3])?'javascript:;':$v[3];

?>
            <li class="<?php echo $title_class?>">
               <a href="<?php echo $url?>">
               <i class="<?php echo $v[2]?>"></i> 
               <span class="title"><?php echo html($v[1])?></span>
               <?php
			   
			  if(is_array($_listarr[$v[0]])){
			   
			  if(strlen($title_class)>1){?>
              <span class="selected"></span>
               <span class="arrow open"></span>
               <?php
			  }else{
				  ?>
               <span class="arrow "></span>
               <?php
			  }
			  }
			  ?>
               </a>
               
               <?php if(is_array($_listarr[$v[0]])){?>
               <ul class="sub-menu">
                 
                 <?php
				 foreach($_listarr[$v[0]] as $vv){
					 $class=$clist==($v[0].'_'.$vv[0])?'active ':'';
					 
					if( $vv[3]=='admin'){
						$url=url(RM.$vv[0].'/');
					}else{
						$url=url(RM.'to/?mod='.$vv[3].'&act='.$vv[0]);
					}
					 ?>
                  <li class="<?php echo $class?>">
                     <a href="<?php echo $url?>">
                     <?php echo html($vv[1])?></a>
                  </li>
                <?php
				 }
				 ?>
                  
               </ul>
               <?php
			   }
			   ?>
            </li>
            
            
<?php
}