<?php
module_exists('product') or yun_error('模型未安装');

foreach($G['channels'] as $k=>$v){
	if($v['formod']=='product')
		product::channel_del($k);
}

$DB->query("delete from ".PF."yun where modname='product'");
$DB->query("delete from ".PF."tag where modname='product'");
$DB->query("DROP TABLE `".PF."product`;");

unset_mod('product');

admin::upcache();
yun_succeed('成功卸载','refresh');