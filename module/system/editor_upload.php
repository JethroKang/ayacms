<?php
if(empty($BPV[2])) exit;

$info=pathinfo((string)$_GET['file']);


if(is_file($file=ABSPATH.'static/ueditor/php/'.$info['filename'].'.php'))
include $file;
exit;