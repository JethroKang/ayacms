<?php
if(!file_exists($file=THEMEDIR.'cache/backup_1.zip'))
	yun_msg('','无还原记录');
require_once (ABSPATH.'static/class_pclzip.php');
$archive=new PclZip($file);
if($archive->extract(PCLZIP_OPT_PATH,THEMEDIR.'cache/',PCLZIP_OPT_REPLACE_NEWER)==0)
	yun_error('还原时出错');
@unlink($file);

for($i=2;$i<10;$i++){
if(is_file($file=THEMEDIR.'cache/backup_'.$i.'.zip'))
	rename($file,THEMEDIR.'cache/backup_'.($i-1).'.zip');
}

yun_msg('','已还原','f');
