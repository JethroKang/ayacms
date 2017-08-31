<?php


$is_global=isset($_GET['tag_name']);
if(!$is_global){
	$is_new=empty($_GET['bid']);
	
	$eleid=(string)$_GET['eleid'];
	
	if($is_new){
		$tag_key=$eleid;
		
	}else{
		
		$tag_key=str_replace('_','',strrchr($_GET['bid'],'_'));
	}
	
	if(isset($_GET['classname'])){
		$tag_name=(string)$_GET['classname'];
	}else{
		@$tag_name=(string)$tag_diy[$tag_key]['tag_name'];
	}
}else{
	$tag_name=(string)$_GET['tag_name'];
	$tag_key='ayacms000_'.$tag_name;
}

strlen($tag_key)<11&&yun_error('参数异常:1');
if(!$is_global)
	substr($tag_key,0,10)=='ayacms000_'&&yun_error('参数异常:2');

strlen($tag_name)<1&&yun_error('参数异常:3');

isset($G['tags'][$tag_name]) or yun_error('DIY不存在:'.$tag_name);
$tag=$G['tags'][$tag_name];
//if($this_tag['type']!=1&&$this_tag['type']!=2)
//	yun_error('标签不支持可视化操作');
$themename=(string)$_GET['themename'];
$themename=str_replace(array('\\','/'),array('',''),$themename);
file_exists($editfile=DOCROOT.$tag['path'].'edit.php') or yun_error('该DIY不支持可视编辑');


if(IS_POST){
	
	//处理上传文件;
	foreach($_POST as $k=>$v){
		if(substr($k,0,4)=='img_' && is_string($v))
			$_POST[$k]=diy_upload_move($v);
	}
	

	$file=ABSPATH.'theme/'.$themename.'/cache/diy';
	
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
	

	
	$diydata=array();
	if(file_exists($file)){
		$diydata=unserialize(read_file($file));
	}
	
$diydata[$tag_key]=$_POST;


	

	if(false==write_file($file,serialize($diydata))){
		yun_error('数据保存失败');
	}
	
	yun_loading('正在保存布局',"setTimeout(\"javascript:spaceDiy.save();\",200);");
}



$tag['form_id']=strrand();
$tag['class_name']='tag_'.$tag_name;
$tag['ke_id']=ke_set(1);


//$this_path=$tag['path'];
//$this_formid=strrand();
//$this_class='tag_'.$tag_name;
//$this_ke_id=ke_set(1);

$_val=(array)$tag_diy[$tag_key];
@extract($_val);


ob_start();
include_once $editfile;
$html=ob_get_contents();
ob_end_clean();



?>