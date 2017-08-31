<?php

if(IS_POST){
	$link=trim((string)$_POST['link']);
	if(count($link)<1) $link='-null-';
	$DB->query("update ".PF."channel set link='".addslashes($link)."' where id='".$id."'");

	yun_succeed('编辑成功');
}
