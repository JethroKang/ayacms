<?php
$layoutdata=xml2array($_POST['layoutdata']);

$themename=(string)$_POST['themename'];
$themefile=(string)$_POST['themefile'];

if(!preg_match('/^\w+$/is',$themename))
	yun_msg('','异常,返回重新提交');
if(!preg_match('/^[\w\.]+$/is',$themefile))
	yun_msg('','异常,返回重新提交');

$file=ABSPATH.'theme/'.$themename.'/cache/layer';
$file2=ABSPATH.'theme/'.$themename.'/cache/diy';

$layer=array ();
if(file_exists($file)){
	$layer=unserialize(read_file($file));
}
$diy=array ();
if(file_exists($file2)){
	$diy=unserialize(read_file($file2));
}

$curl=(string)$_POST['curl'];
$save_as=(string)$_POST['save_as'];

if(strlen($save_as)>1){
	// 复制
	
	// 合法性检查
	if(!preg_match('/^[\w\.]+$/is',$save_as))
		yun_msg('','非法的模板名称');
	if(is_file($as_file=ABSPATH.'theme/'.$themename.'/'.$save_as))
		yun_msg('','非法的模板名称');
	
	$so_file=ABSPATH.'theme/'.$themename.'/'.$themefile;
	
	if(!copy($so_file,$as_file))
		yun_msg('','无法保存文件');
	$themefile=$save_as;
	unset($layer[$themefile]);
	
	$diykeys=array ();
	$diydatas=array ();
	
	$diydatas=template::copy_layer($layoutdata,$diykeys);
	
	template::copy_diy($diy,$diykeys);
	
	$curl=url(RM.'?tpl='.preg_replace("/\.php$/i",'',$save_as));
	
	$layoutdata=$diydatas;
}

$data=isset($layer[$themefile])?$layer[$themefile]:array ();

$data_key=$layoutdata_key=array ();
template::get_diykeys($data,$data_key);
template::get_diykeys($layoutdata,$layoutdata_key);
$delkey=array_diff($data_key,$layoutdata_key);

foreach($diy as $k=>$v){
	if(in_array($k,$delkey)){
		unset($diy[$k]);
		
		if(is_array($v['delfile_'.M_E])){
			foreach($v['delfile_'.M_E] as $_k=>$_v){
				if(preg_match("/^".preg_quote(TP,'/')."upload\//i",$_v))
					@unlink(DOCROOT.$_v);
			}
		}
	}
}

if(file_exists($file)){
	
	for($i=9;$i>0;$i--){
		if(is_file($_file=dirname($file).'/backup_'.$i.'.zip')){
			$_newfile=dirname($file).'/backup_'.($i+1).'.zip';
			copy($_file,$_newfile);
		}
	}
	
	$tmpzip=dirname($file).'/backup_1.zip';
	require_once (ABSPATH.'static/class_pclzip.php');
	$archive=new PclZip($tmpzip);
	$archive->create($file,PCLZIP_OPT_REMOVE_PATH,dirname($tmpzip));
}

$layer[$themefile]=$layoutdata;
if(!write_file($file,serialize($layer))){
	yun_error('数据保存失败');
}

if(!write_file($file2,serialize($diy))){
	yun_error('数据保存失败');
}
@unlink(ABSPATH.'cache/tag_data_'.$themename.'_'.$themefile);

yun_succeed('操作成功',$curl);
?>