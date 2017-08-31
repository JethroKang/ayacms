<?php

set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);


if(IS_POST){
	
	
	yun_succeed('提交成功',url(RM.'base/'));
}

$tabs=array_reverse($G['tabs']);

?>