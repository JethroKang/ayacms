<?php
module_exists('picture') or yun_error('模型未安装');

foreach($G['channels'] as $k=>$v){
	if($v['formod']=='picture')
		picture::channel_del($k);
}

$DB->query("delete from ".PF."yun where modname='picture'");
$DB->query("delete from ".PF."tag where modname='picture'");
$DB->query("DROP TABLE `".PF."picture`;");

unset_mod('picture');

admin::upcache();
yun_succeed('成功卸载','refresh');