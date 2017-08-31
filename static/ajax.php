<?php

$classname=strrand();
$winwidth=intval($_GET['winwidth']);
$winwidth=$winwidth?$winwidth:750;
ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
echo '<root><![CDATA[<div style="display:none">none</div>
	<style type="text/css">
.win_w_',$classname,'{
	height: auto !important;
    max-height: 300px;
    overflow-x: hidden;
    overflow-y: auto;
    width: ',$winwidth,'px;
    margin: 10px 10px;
}
	</style>';
echo do_apply('content','string');

$s=ob_get_contents();
ob_end_clean();
$s.= '<script type="text/javascript">';
$s.= do_apply('jscode','string');
$s.= ';</script>';
$s=preg_replace("/([\\x01-\\x08\\x0b-\\x0c\\x0e-\\x1f])+/",' ',$s);
$s=str_replace(array(chr(0),']]>'),array(' ',']]&gt;'),$s);
$s=preg_replace("/(<div\s+class=[\"|'|]*win_w[\"|'|]*\s*>)/is","<div class=\"win_w_".$classname."\">",$s);

echo $s;
echo ']]></root>';
?>