<?php


$U['id']<1&&yun_error('请先登陆');
$u=$U;

if(IS_POST){
	
	$face = trim ( ( string ) $_POST ['face'] );
	
	$arr=array(
		'sex'=>	$_POST['sex']?1:0,
	);

	if($face!=$u['face']){
		if(strlen($u['face'])>0) @unlink(ABSPATH.$u['face']);
		$arr['face']=upload_move($face,MOD,true);
	}
	
	$tabdata=tab::post ($C['user_tabs']['diss']);
	$arr=array_merge($arr,$tabdata);
	
	$sql=sql_update($arr);
	if($DB->query("update ".PF."user set $sql where id='$u[id]'")){
		yun_succeed('修改成功',url(RM.'show/'));
	}else{
		yun_error('修改失败');
	}
}
apply('current',array('资料编辑'));
apply('title','资料编辑');

?>