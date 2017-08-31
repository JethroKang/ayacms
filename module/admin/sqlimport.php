<?php

$id=$_GET['id'];
$cid=intval($_GET['cid']);
$cid=empty($cid)?1:$cid;
if(!is_dir(ABSPATH.'backup/'.$id))
	yun_error('未找到备份');
if(file_exists(ABSPATH.'/backup/'.$id.'/'.$cid.'.php')){
	$data=trim(file_get_contents(ABSPATH.'/backup/'.$id.'/'.$cid.'.php'));
	
	$sql=explode("\r\n\r\n",$data);
	if(count($sql)<2)
	$sql=explode("\n\n",$data);
	foreach($sql as $query){
		$query=trim($query);
		if(in_array(substr($query,0,10),array('DROP TABLE','CREATE TAB','INSERT INT','SET SQL_MO'))){
			$DB->query($query);
		}
	}
	$c=$cid-1;
	$url=url(RM.'sqlimport/?id='.$id.'&cid='.++$cid);
	admin::upcache();
	yun_loading('继续导入('.$cid.'),请等待...','ajaxget(\''.$url.'\');');
}else if($cid==1){
	yun_error('备份不存在');
}else{
	yun_succeed('导入结束');
}
?>