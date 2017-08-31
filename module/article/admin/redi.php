<?php
$channel=$G['channels'][$id];

$act_files=array ();
$tpl_files=array ();
if($_d=@opendir(ABSPATH.'module/'.$mod.'/')){
	while($entry=readdir($_d)){
		if(!in_array(substr($entry,0,1),array (
				'.',
				'_' 
		))&&is_file(ABSPATH.'module/'.$mod.'/'.$entry)){
			if(substr($entry,-8)=='_tpl.php')
				$tpl_files[]=$entry;
			else
				$act_files[]=$entry;
		}
	}
	closedir($_d);
}

$theme_files=array ();
if($_d=@opendir(ABSPATH.'theme/'.$C['sys_theme'].'/')){
	while($entry=readdir($_d)){
		if(!in_array(substr($entry,0,1),array (
				'.',
				'_' 
		))&&substr($entry,-4)=='.php'&&is_file(ABSPATH.'theme/'.$C['sys_theme'].'/'.$entry)){
			$theme_files[]=$entry;
		}
	}
	closedir($_d);
}

if(IS_POST){
	$arr=array ();
	
	for($i=1;$i<4;$i++){
		
		$key='action_'.$i;
		$key_to='action_'.$i.'_to';
		
		$arr[$key]='';
		$arr[$key_to]='';
		
		if(in_array($_POST[$key],$act_files)&&in_array($_POST[$key_to],$act_files)){
			$arr[$key]=$_POST[$key];
			$arr[$key_to]=$_POST[$key_to];
		}
	}
	
	for($i=1;$i<4;$i++){
		
		$key='action_tpl_'.$i;
		$key_to='action_tpl_'.$i.'_to';
		
		$arr[$key]='';
		$arr[$key_to]='';
		
		if(in_array($_POST[$key],$tpl_files)&&in_array($_POST[$key_to],$tpl_files)){
			$arr[$key]=$_POST[$key];
			$arr[$key_to]=$_POST[$key_to];
		}
	}
	
	for($i=1;$i<4;$i++){
		
		$key='theme_tpl_'.$i;
		$key_to='theme_tpl_'.$i.'_to';
		
		$arr[$key]='';
		$arr[$key_to]='';
		
		if(in_array($_POST[$key],$act_files)&&in_array($_POST[$key_to],$theme_files)){
			$arr[$key]=$_POST[$key];
			$arr[$key_to]=$_POST[$key_to];
		}
	}
	
	$arr['theme_tpl']=$_POST['theme_tpl'];
	
	$str=sql_update($arr);
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('提交成功','f');
}



