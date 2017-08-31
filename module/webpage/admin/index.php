<?php

$row=$DB->fetch_first('select * from '.PF.'page where id="'.$id.'"');
if(!$row) yun_error('ID不存在');

if(IS_POST){
	$content=trim((string)$_POST['content']);
	$DB->query("update ".PF."page set content='".addslashes($content)."' where id='".$id."'");

	yun_succeed('编辑成功');
}
