<?php

set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);


if(IS_POST){
	
	$order=(array)$_POST['order'];
	
	
	foreach($order as $id=>$o){
		$DB->query("update " . PF . "channel set o='".(int)$o."' where id='$id'");
	}
	
	admin::upcache();
	yun_succeed('提交成功','f');
}


?>