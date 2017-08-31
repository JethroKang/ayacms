<?php



$id=intval($_GET['id']);

isset($G['channels'][$id]) or yun_error('栏目不存在');
$formod=$G['channels'][$id]['formod'];
$pid=$G['channels'][$id]['pid'];

if(!class_exists($formod) || !method_exists($formod,'channel_del')) {
	yun_error('缺少成员函数');
}
		
		eval("$formod::channel_del(\$id);");
		
		$DB->query('delete from ' . PF . 'channel where id='.$id);
		$DB->query('update ' . PF . 'channel set pid=0 where pid='.$id);
		
		admin::upcache();
		yun_succeed('成功删除','f');
	





?>