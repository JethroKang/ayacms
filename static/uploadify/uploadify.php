<?php
if (! defined ( 'ABSPATH' ))
	exit ( 'Access Denied' );


if (!empty($_FILES)) {
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$filename=TIME.'_'.strrand(3).'.'.$fileParts['extension'];
	$targetFile = ABSPATH.'upload/temp/' . $filename;


	$fileTypes = array('php','js','html','htm'); 
	
	if (in_array($fileParts['extension'],$fileTypes)) {
	exit('禁止上传该类型文件');
	}
		
		if(!move_uploaded_file($tempFile,$targetFile))
		exit('上传失败(1)');
		else 
	    exit($filename);
	
}else 
exit('上传失败(2)');