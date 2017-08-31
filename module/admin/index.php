<?php
set_val('current_mainmenu_title','index');


$os=@explode(" ",php_uname());
$arr=array();
$arr[0]=date("Y-n-j H:i:s");
$arr[1]=$os[0].'/'.PHP_OS;
$arr[2]=$_SERVER['SERVER_SOFTWARE'];
$arr[3]=PHP_VERSION;
$arr[4]=php_sapi_name();
$arr[5]=mysql_get_server_info();
$arr[6]=round((@disk_free_space(".")/(1024*1024)),2);
$arr[7]=admin::getPHPini("memory_limit");
$arr[8]=admin::getPHPini("post_max_size");
$arr[9]=admin::getPHPini("upload_max_filesize");
$arr[10]=admin::getPHPini("max_execution_time");

?>