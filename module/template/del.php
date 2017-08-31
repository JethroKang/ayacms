<?php

$tpl=(string)$_GET['tpl'];
if(!preg_match('/^\w+$/is',$tpl)) yun_msg('','非法的tpl参数');
if(!is_file($file=THEMEDIR.$tpl.'.php')) yun_msg('warning','模板文件不存在');

if(in_array($tpl,array('header','footer','default'))) yun_msg('warning','该模板禁止删除');

@unlink($file);

$themefile=$tpl.'.php';

$file=THEMEDIR.'cache/layer';
$file2=THEMEDIR.'cache/diy';

$layer=array();
if(file_exists($file)){
	$layer=unserialize(read_file($file));
}
$diy=array();
if(file_exists($file2)){
	$diy=unserialize(read_file($file2));
}

$data=isset($layer[$themefile])?$layer[$themefile]:array();

$del_key=array();
template::get_diykeys($data,$del_key);



foreach($diy as $k=>$v){
	if(in_array($k,$del_key)){
		unset($diy[$k]);

		if(is_array($v['delfile_'.M_E])){
			foreach($v['delfile_'.M_E] as $_k=>$_v){
				if(preg_match("/^".preg_quote(TP,'/')."upload\//i",$_v))
					@unlink(DOCROOT.$_v);
			}
		}
	}
}


if(file_exists($file)&&file_exists($file2)){

	for($i=2;$i>0;$i--){
		if(is_file($_file=dirname($file).'/backup_'.$i.'.zip')){
			$_newfile=dirname($file).'/backup_'.($i+1).'.zip';
			copy($_file,$_newfile);
		}
	}


	$data=read_file($file2);
	$tmpzip=dirname($file2).'/backup_1.zip';
	require_once (ABSPATH.'static/class_pclzip.php');
	$archive=new PclZip($tmpzip);
	$archive->create($file,PCLZIP_OPT_REMOVE_PATH,dirname($tmpzip));
	$archive->add($file2,PCLZIP_OPT_REMOVE_PATH,dirname($tmpzip));
}

unset($layer[$themefile]);
if(!write_file($file,serialize($layer))){
	yun_error('数据保存失败');
}
if(!write_file($file2,serialize($diy))){
	yun_error('数据保存失败');
}
@unlink(ABSPATH.'cache/tag_data_'.THEMENAME.'_'.$themefile);


yun_msg('success','成功删除.',url(RM.'?tpl=default'));
//yun_succeed('操作成功',url(RM.'?tpl=home'));
?>