<?php
module_exists('article') or yun_error('模型未安装');

foreach($G['channels'] as $k=>$v){
	if($v['formod']=='article')
		article::channel_del($k);
}

$DB->query("delete from ".PF."yun where modname='article'");
$DB->query("delete from ".PF."tag where modname='article'");
$DB->query("DROP TABLE `".PF."article`;");

unset_mod('article');

admin::upcache();
yun_succeed('成功卸载','refresh');