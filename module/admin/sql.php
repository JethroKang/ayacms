<?php

set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);





//$dir=date('y-m-d',TIME).'_'.TIME;
$result=$DB->query('show table status');
$tabs=array();
while($row=$DB->fetch_row($result)){
	$arr=explode(PF,$row[0]);
	if($arr[0]=='')$tabs[]=$row;
	
}





$d=dir(ABSPATH.'backup');
$dirs=array();
while(false!==($entry=$d->read())){
	if(is_dir(ABSPATH.'backup/'.$entry)&&$entry!='.'&&$entry!='..'){
		$st=explode('_',$entry);
		$t=glob(ABSPATH.'backup/'.$entry.'/*.php');
		$t===false&&$t=array();
		@$dirs[$entry]=array($entry,count($t),showtime($st[1]));
	}
}
$d->close();
krsort($dirs);

?>