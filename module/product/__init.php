<?php
strlen($P[0])<1&&$P[0]='index';

if(is_file(ABSPATH.'module/product/'.$P[0].'.php')){
	
	define('ACTION',$P[0]);
}else if($post=$DB->fetch_first("select id from ".PF."product where sign='".addslashes($P[0])."'")){
	define('ACTION','show');
	array_splice($P,1,0,$post['id']);
}else
	yun_error('页面不存在');

for($i=1;$i<11;$i++)
	define('P'.$i,(int)$P[$i]);

$channel=$G['channels'][CID];

$MPV=product::mpv(CID);

empty($MPV[0])&&yun_error('权限不足,禁止进入');

?>