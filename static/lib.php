<?php
if(!defined('ABSPATH'))
	exit('Access Denied');
function is($str,$team=false){
	if($team===false)
		$team=$GLOBALS['user']['team'];
	
	$arr=explode(',',$str);
	return in_array($team,$arr);
}
function xml2array(&$xml,$isnormal=false){
	$xml_parser=new xml($isnormal);
	$data=$xml_parser->parse($xml);
	$xml_parser->destruct();
	return $data;
}
function tag($tag_name,$diydata=array()){
	global $C,$G,$U,$BPV,$MPV,$DB,$_tag_update,$_tag_html;
	
	global $tag_diy,$tag_layer;
	
	if(!is_array($diydata))
		return;
	
	if(!isset($G['tags'][$tag_name]))
		return;
	
	$tag=$G['tags'][$tag_name];
	
	static $_load_ci=array ();
	$_this=array ();
	
	$_this['ci']=++$_load_ci['_'.$tag_name.'_load_ci'];
	
	$_cssfile=pathinfo($tag['load_css']);
	$tag['class']=trim(str_replace(array (
			'/',
			'\\',
			'.' 
	),'_',$tag['path'].$_cssfile['filename']),'_');
	
	@extract($diydata);
	
	if(strlen($tag['close'])>0)
		eval('$_tag_close='.$tag['close'].';');
	if($_tag_close)
		return;
	
	$_tag_sign='';
	if(strlen($tag['sign'])>0)
		eval('$_tag_sign='.$tag['sign'].';');
	$_tag_key=$tag_name.'_'.md5(serialize($diydata).serialize($_tag_sign));
	$_tag_cache=(int)$tag['cache'];
	$_tag_cache<0&&$_tag_cache=0;
	$_tag_cache>1&&$_tag_cache=60;
	
	$file=DOCROOT.$tag['path'].'/index.php';
	
	if($_tag_cache==0){
		
		ob_start();
		include $file;
		$_html=ob_get_contents();
		ob_end_clean();
		
		if(strlen($_html)<1)
			return;
		
		if(strlen(trim($tag_css))>0){
			$_html='<div style="'.$tag_css.'">'.$_html."</div>";
		}
		
		if(!empty($_well)){
			$_html='<div class="'.$_well.'">'.$_html.'</div>';
		}
		
		if(!empty($_panel)){
			$_html='
			<div class="panel panel-'.$_panel.'">
			<div class="panel-heading">
			<h3 class="panel-title">'.(empty($_panellink)?'':('<a href="'.$_panellink.'" class="badge pull-right">更多..</a>')).html($_paneltitle).'</h3>
			</div>
			<div class="panel-body">'.$_html.'
			</div>
			</div>';
			
			if(strlen(trim($tag_panel_css))>0){
				$_html='<div style="'.$tag_panel_css.'">'.$_html."</div>";
			}
		}
		
		echo $_html;
		return;
	}
	
	$_up=(MOD=='template' or DEBUG or !isset($_tag_html[$_tag_key]) or ($_tag_cache>1&&(TIME-$_tag_html[$_tag_key]['time'])<$_tag_cache))?true:false;
	
	if(empty($_up)){
		
		echo $_tag_html[$_tag_key]['html'];
		
		return;
	}
	$_tag_update=true;
	
	ob_start();
	include $file;
	$_html=ob_get_contents();
	ob_end_clean();
	
	if(strlen($_html)>0){
		
		if(!empty($_well)){
			$_html='<div class="'.$_well.'">'.$_html.'</div>';
		}
		
		if(!empty($_panel)){
			$_html='
			<div class="panel panel-'.$_panel.'">
			<div class="panel-heading">
			<h3 class="panel-title">'.(empty($_panellink)?'':('<a href="'.$_panellink.'" class="badge pull-right">更多..</a>')).html($_paneltitle).'</h3>
			</div>
			<div class="panel-body">'.$_html.'
			</div>
			</div>';
		}
		if(strlen(trim($tag_css))>0){
			$_html='<div style="'.$tag_css.'">'.$_html."</div>";
		}
		
		echo $_html;
	}
	$_tag_html[$_tag_key]=array (
			'time'=>TIME+rand(0,3),
			'html'=>$_html 
	);
	return;
}
function frame($code){
	global $C,$tag_layer;
	$arr=(array)$tag_layer[THEMEFILE][$code];
	
	if(MOD=='template'){
		echo '<!--[diy='.$code.']-->
    <div id='.$code.' class="area">
    ';
		
		list($_key,$_val)=@each($arr);
		
		if(is_array($_val)){
			foreach($arr as $key=>$val){
				if(substr($key,0,5)=='frame'){
					framediy($val);
				}
			}
		}
		echo '<div class="clearfixmove-span temp" id="'.$code.'_temp"></div></div>
    <!--[/diy]-->';
	}else{
		foreach($arr as $key=>$val){
			if(substr($key,0,5)=='frame'){
				framediy($val);
			}
		}
	}
}
function framediy($val){
	global $tag_diy,$tag_layer;
	
	if(MOD=='template'){
		echo '<div class="',$val['attr']['className'],'" id="',$val['attr']['name'],'" style="cursor: move;">';
		foreach($val as $kk=>$vv){
			if(substr($kk,0,6)=='column'){
				echo '<div class="',$vv['attr']['className'],'" id="',$vv['attr']['name'],'">
    <div class="move-span temp" id="',$vv['attr']['name'],'_temp"></div>';
				foreach($vv as $kkk=>$vvv){
					if(substr($kkk,0,5)=='block'){
						echo '<div class="',$vvv['attr']['className'],'" id="',$vvv['attr']['name'],'" style="cursor: move;">
      <div style="overflow: hidden" id="',$vvv['attr']['name'],'_content">';
						if(isset($tag_diy[$vvv['attr']['name']])){
							tag($tag_diy[$vvv['attr']['name']]['tag_name'],$tag_diy[$vvv['attr']['name']]);
						}
						echo '</div>
    </div>';
					}elseif(substr($kkk,0,5)=='frame'){
						framediy($vvv);
					}
				}
				echo '</div>';
			}
		}
		echo '
</div>';
	}else{
		
		echo '<div class="row-fluid clearfix" >';
		foreach($val as $kk=>$vv){
			if(substr($kk,0,6)=='column'){
				
				echo '<div class="',preg_replace("/ column/is",'',$vv['attr']['className']),'" >';
				foreach($vv as $kkk=>$vvv){
					if(substr($kkk,0,5)=='block'){
						if(isset($tag_diy[$vvv['attr']['name']])){
							tag($tag_diy[$vvv['attr']['name']]['tag_name'],$tag_diy[$vvv['attr']['name']]);
						}
					}elseif(substr($kkk,0,5)=='frame'){
						framediy($vvv);
					}
				}
				echo '</div>';
			}
		}
		echo '
</div>';
	}
}
function url($url){
	if(IS_REWRITE)
		return DOADMIN.$url;
	if($url==R)
		return DOADMIN.R;
	$url=preg_replace("/^".preg_quote(R,'/')."(.*)/is","\\1",$url);
	$ex=explode('?',$url);
	return rtrim(DOADMIN.R.'?'.$ex[0].'&'.$ex[1],'&');
}
function curl($url){
	$pf=strtolower(substr($url,0,6));
	if(in_array($pf,array (
			'http:/',
			'https:',
			'ftp://'
	))){
		return $url;
	}
	
	if($pf=='-null-')
		return 'javascript:void(0)';
	
	return url(R.$url);
}
function furl($url){
	return url($url);
}
// 路由
function router(){
	global $G,$DB;
	$par='';
	
	if(is_array($_GET)){
		
		list($par,)=each($_GET);
		
		if(!strpos($par,'/')){
			if(strlen($par)>0) jump(url(R));
			$par='';
		}else
			array_shift($_GET);
	}
	
	// 获得当前模型名
	$mod='';
	$cid=0;
	$clink='';
	$rm='';
	$home=false;
	
	if(preg_match('/[\\\\]+/is',$par))
		die('pars error!');
	
	$pars=explode('/',$par);
	
	if(strlen($pars[0])<1){
		// 从channel伪造$pars
		foreach($G['channels'] as $v){
			if(!empty($v['home'])){
				$pars[0]=$v['sign'];
				$home=true;
				break;
			}
		}
	}
	
	if(in_array($pars[0],array (
			'admin',
			'system',
			'user',
			'template',
			'search',
			'tag' 
	))){
		$mod=$pars[0];
		if($mod!='system'){
			apply('title',modname($mod));
			apply('current',array (
					modname($mod) 
			));
		}
		$rm=R.$mod.'/';
	}else{
		foreach($G['channels'] as $v){
			if($pars[0]==$v['sign']){
				$mod=$v['formod'];
				$cid=$v['id'];
				$clink=$v['link'];
				$rm=R.($home?'':($v['sign'].'/'));
				break;
			}
		}
	}
	
	module_exists($mod) or jump(url(R));
	
	define('MOD',$mod);
	define('CID',$cid);
	define('CLINK',$clink);
	define('RM',$rm);
	define('HOME',$home);
	
	array_shift($pars);
	
	 if(str_is_int($pars[0])){ array_unshift($pars,"index"); }
	 
	return $pars;
}
function sql_update($arr){
	$a=array ();
	foreach($arr as $k=>$v){
		$a[]=$k.'=\''.addslashes($v).'\'';
	}
	return implode(',',$a);
}
function sql_insert($arr){
	$karr=$varr=$varr2=array ();
	foreach($arr as $key=>$val){
		if(is_array($val)){
			foreach($val as $k=>$v){
				empty($karr)&&$karr=array_keys($val);
				$varr[$key][]='\''.addslashes($v).'\'';
			}
		}else{
			$karr[]=$key;
			$varr[0][]='\''.addslashes($val).'\'';
		}
	}
	$kstr=' ('.implode(',',$karr).')';
	foreach($varr as $v){
		$varr2[]='('.implode(',',$v).')';
	}
	return $kstr.' values'.implode(',',$varr2);
}
function modname($mod){
	global $G;
	return $G['mods'][$mod]['name'];
}
function html($str){
	return htmlspecialchars($str);
}
function upconfig($str,$str2){
	$file=ABSPATH.'config/config.php';
	$data=read_file($file);
	$data=str_replace($str,$str2,$data);
	return write_file($file,$data);
}
function set_conf($key,$value=M_E){
	global $DB,$C;
	if($value==M_E)
		$value=$C[$key];
	$_value=is_string($value)?$value:serialize($value);
	if($row=$DB->fetch_first("select * from ".PF."val where name='".$key."' limit 0,1")){
		$DB->query("update ".PF."val set value='".addslashes($_value)."',serialize='".(is_string($value)?0:1)."' where id='".$row['id']."'");
	}else{
		$DB->query("insert into ".PF."val (name,value,serialize) values('".$key."','".addslashes($_value)."','".(is_string($value)?0:1)."')");
	}
}
function unset_conf($key){
	global $DB,$C;
	$DB->query("delete from ".PF."val where name='$key'");
}
function set_mod($mod){
	global $C;
	if(in_array($mod,$C['install_mods']))
		return;
	array_push($C['install_mods'],$mod);
	set_conf('install_mods');
}
function unset_mod($mod){
	global $C;
	
	$key=array_search($mod,$C['install_mods']);
	if($key===false)
		return;
	unset($C['install_mods'][$key]);
	set_conf('install_mods');
}
function get_conf(){
	global $DB,$C;
	$result=$DB->query("select * from ".PF."val");
	while($row=$DB->fetch_array($result)){
		$C[$row['name']]=$row['serialize']>0?unserialize($row['value']):$row['value'];
	}
}
function get_val($key){
	return $GLOBALS['__G'][$key];
}
function set_val($key,$val){
	$GLOBALS['__G'][$key]=$val;
}
function yun_action_tpl(){
	global $C;
	$file=ABSPATH.'module/'.MOD.'/'.ACTION.'_tpl.php';
	if(file_exists($file)){
		
		return $file;
	}else{
		return false;
	}
}
function yun_load_module(){
	global $C,$G;
	
	if(DEBUG||UPDATE||empty($C['install_mods'])){
		
		@$_d=opendir(ABSPATH.'module/');
		while($mod=readdir($_d)){
			
			if(in_array($mod,$C['install_mods']))
				continue;
			if(in_array(substr($mod,0,1),array (
					'_',
					'.' 
			)))
				continue;
			if(file_exists(ABSPATH.'module/'.$mod.'/admin/install.php'))
				continue;
			$C['install_mods'][]=$mod;
		}
		set_conf('install_mods');
	}
	
	$mods=array ();
	foreach($C['install_mods'] as $mod){
		$mods[$mod]=require (ABSPATH.'module/'.$mod.'/__conf.php');
	}
	$G['mods']=$mods;
}
function yun_load_field(){
	global $C,$DB;
	
	if(DEBUG||UPDATE||empty($C['fields'])){
		$fields=array ();
		
		$result=$DB->query('show table status');
		$tabs=array ();
		while($row=$DB->fetch_row($result)){
			$arr=explode(PF,$row[0]);
			if($arr[0]=='')
				$tabs[]=$arr[1];
		}
		
		foreach($tabs as $tab){
			
			$rs=$DB->query("SHOW TABLES LIKE '".PF.$tab."'");
			if($DB->num_rows($rs)>0){
				
				$result=$DB->query("describe ".PF.$tab);
				$field=array ();
				while($row=$DB->fetch_array($result)){
					$field[]=$row["Field"];
				}
				$fields[$tab]=$field;
			}
		}
		
		$C['fields']=$fields;
		
		set_conf('fields');
	}
}
function yun_load_part(){
	global $G;
	
	$cache_file=ABSPATH.'cache/part_'.THEMENAME.'.php';
	
	if(DEBUG||UPDATE||MOD=='admin'||MOD=='template'||!file_exists($cache_file)){
		
		$parts=array ();
		
		if($_d=@opendir(THEMEDIR.'part/')){
			while($entry=readdir($_d)){
				if(in_array(substr($entry,0,1),array (
						'_',
						'.' 
				)))
					continue;
				if(!file_exists($file=THEMEDIR.'part/'.$entry.'/__conf.php'))
					continue;
				
				$parts[$entry]=include ($file);
			}
			closedir($_d);
		}
		
		$_var=$parts['global'];
		unset($parts['global']);
		$parts=array_merge(array (
				'global'=>$_var 
		),$parts);
		
		write_file($cache_file,serialize($parts)) or die(R.'cache/, 无法写入');
	}
	
	$G['parts']=unserialize(read_file($cache_file));
	
	foreach($G['parts'] as $part=>$v){
		if(is_file(THEMEDIR.'part/'.$part.'/'.$v['load_css'])){
			apply('cssfile',THEMEPATH.'part/'.$part.'/'.$v['load_css']);
		}
		
		if(is_file(THEMEDIR.'part/'.$part.'/'.$v['load_js'])){
			apply('jsfile',THEMEPATH.'part/'.$part.'/'.$v['load_js']);
		}
	}
}
function yun_load_tag(){
	global $G;
	
	$cache_file=ABSPATH.'cache/tag_'.THEMENAME.'.php';
	$apply_file=ABSPATH.'cache/tag_apply_'.THEMENAME.'.php';
	
	if(DEBUG||UPDATE||MOD=='admin'||MOD=='template'||!file_exists($cache_file)||!file_exists($apply_file)){
		$tags=array ();
		$apply='';
		
		if($_d=@opendir(THEMEDIR.'tag/')){
			while($entry=readdir($_d)){
				if(in_array(substr($entry,0,1),array (
						'_',
						'.' 
				)))
					continue;
				if(!file_exists($file=THEMEDIR.'tag/'.$entry.'/__conf.php'))
					continue;
				
				$_conf=include ($file);
				
				$_conf['path']=THEMEPATH.'tag/'.$entry.'/';
				
				if(file_exists($file=THEMEDIR.'tag/'.$entry.'/example.php')){
					
					ob_start();
					include ($file);
					$_code=ob_get_contents();
					ob_end_clean();
					
					preg_replace("/^\s*(<[^>]+>)(.+?)(<[^>]+>)\s*$/eis","\$arr=array('\\1','\\2','\\3')",$_code);
					
					$_conf['code']=array (
							stripslashes($arr[0]),
							trim(stripslashes($arr[1])),
							stripslashes($arr[2]) 
					);
				}
				
				$_pf5=substr($entry,0,5);
				$_pf4=substr($entry,0,4);
				if($_pf5=='call_')
					$pf='call';
				else if($_pf4=='css_')
					$pf='css';
				else
					$pf='';
				$_conf['type']=$pf;
				
				if($_conf['apply']!=''){
					$_arr=explode(',',$_conf['apply']);
					$apply.='apply(\''.$_arr[0].'\',\'code:tag(\\\''.$k.'\\\');\','.(int)$_arr[1].');';
				}
				
				$tags[$entry]=$_conf;
			}
			closedir($_d);
		}
		
		write_file($apply_file,serialize($apply)) or die(R.'cache/, 无法写入');
		write_file($cache_file,serialize($tags)) or die(R.'cache/, 无法写入');
	}
	
	eval(unserialize(read_file($apply_file)));
	$G['tags']=unserialize(read_file($cache_file));
	
	foreach($G['tags'] as $tag=>$v){
		
		if(is_file(THEMEDIR.'tag/'.$tag.'/'.$v['load_css'])){
			apply('cssfile',THEMEPATH.'tag/'.$tag.'/'.$v['load_css']);
		}
		
		if(is_file(THEMEDIR.'tag/'.$tag.'/'.$v['load_js'])){
			apply('jsfile',THEMEPATH.'tag/'.$tag.'/'.$v['load_js']);
		}
	}
}
function get_template(){
	global $G;
	
	if(IS_AJAX){
		return ABSPATH.'static/ajax.php';
	}
	
	apply('header','<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
',0);
	
	$theme_file=get_val('theme_file');
	
	if(!is_file(THEMEDIR.$theme_file)){
		if(CID>0){
			
			$channel=$G['channels'][CID];
			
			$filename=ACTION.'.php';
			if($filename==$channel['theme_tpl_1']&&strlen($channel['theme_tpl_1_to'])>0)
				$theme_file=$channel['theme_tpl_1_to'];
			else if($filename==$channel['theme_tpl_2']&&strlen($channel['theme_tpl_2_to'])>0)
				$theme_file=$channel['theme_tpl_2_to'];
			else if($filename==$channel['theme_tpl_3']&&strlen($channel['theme_tpl_3_to'])>0)
				$theme_file=$channel['theme_tpl_3_to'];
			else
				$theme_file=$channel['theme_tpl'];
			
			if(!is_file(THEMEDIR.$theme_file))
				$theme_file='default.php';
		}else{
			$theme_file='default.php';
		}
	}
	
	define('THEMEFILE',$theme_file);
	$sourfile=THEMEDIR.$theme_file;
	$cachefile=ABSPATH.'cache/'.THEMENAME.'_'.$theme_file;
	
	if(DEBUG||!file_exists($cachefile)){
		@$data=file_get_contents(THEMEDIR.'header.php').file_get_contents($sourfile).file_get_contents(THEMEDIR.'footer.php');
		
		// $data = preg_replace ( "/<!--T\/(.+?)-->/eis", "template_in('\\1')", $data );
		$data=preg_replace("/([:|\s]url\(['|\"]*)(?!\/|http:|<\?|R)/is","\\1".THEMEPATH."\\3",$data);
		$data=preg_replace("/((href|src)=['|\"])(?!\/|http:|https:|ftp:|#|javascript:|<\?)/is","\\1".THEMEPATH."\\3",$data);
		write_file($cachefile,$data) or die('致命错误!!! 目录"'.R.'/cache/" 无法写入!');
	}
	return $cachefile;
}
function yun_tag_update(){
	global $_tag_html;
	write_file(ABSPATH.'cache/tag_data_'.THEMENAME.'_'.THEMEFILE,serialize($_tag_html));
}
function module_exists($mod){
	global $C;
	return in_array($mod,$C['install_mods']);
}
function subject_exists($page){
	global $C;
	return isset($C['sys_subjects'][$page]);
}
function __autoload($class_name){
	if(file_exists($file=ABSPATH.'static/class_'.$class_name.'.php')){
		require_once ($file);
	}elseif(module_exists($class_name)){
		if(file_exists($file=ABSPATH.'module/'.$class_name.'/__class.php'))
			require_once ($file);
	}
}
function hook_exists($action){
	global $yun_hooks;
	return is_array($yun_hooks[$action]);
}
function do_apply($action,$type='array'){
	global $yun_hooks;
	
	$arr=array ();
	if(hook_exists($action)){
		
		ksort($yun_hooks[$action]);
		foreach($yun_hooks[$action] as $funcs){
			
			foreach($funcs as $func){
				if(!is_string($func[0])){
					$arr[]=$func[0];
				}else if(substr($func[0],0,5)=='code:'){
					$func[0]=substr($func[0],5);
					$func=create_function('',$func[0]);
					$arr[]=$func();
				}elseif(substr($func[0],-2)=='()'){
					$func[0]=substr($func[0],0,-2);
					$argarr_1=is_array($func[1])?$func[1]:array ();
					$argarr_2=(func_num_args()>2)?array_splice(func_get_args(),2):array ();
					$argarr=$argarr_1+$argarr_2;
					$arg=array ();
					while(list($key,)=@each($argarr)){
						$arg[]='$argarr['.$key.']';
					}
					eval('$_t='.$func[0].'('.implode(',',$arg).');empty($_t) or $arr[]=$_t;');
				}else{
					$arr[]=$func[0];
				}
			}
		}
	}
	
	switch($type){
		case 'string':
			return implode('',$arr);
			break;
		case 'array+':
			$_arr=array ();
			for($i=0;$i<count($arr);$_arr+=$arr[$i],$i++)
				;
			return $_arr;
			break;
		case 'array_merge':
		case 'array_m':
			$_arr=array ();
			for($i=0;$i<count($arr);$_arr=array_merge($_arr,$arr[$i]),$i++)
				;
			return $_arr;
			break;
		case 'array':
			return $arr;
			break;
		default:
			return;
	}
}
function action_exists($action){
	global $yun_hooks;
	return is_array($yun_hooks[$action])?true:false;
}
function apply($action,$func,$level=10){
	global $yun_hooks;
	$is=get_val('apply_stop');
	if(!empty($is))
		return;
	if($level===true){
		unset($yun_hooks[$action]);
		$level=0;
	}
	/* php 5.4 */
	$arr=func_get_args();
	$args=(func_num_args()>3)?array_splice($arr,3):null;
	$yun_hooks[$action][$level][]=array (
			$func,
			$args 
	);
}
function str_is_int($str){
	return preg_match("/^[0-9]+$/",$str);
}
function encrypt($txt,$key='yun'){
	$chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey=WEBKEY;
	$nh1=rand(0,64);
	$nh2=rand(0,64);
	$nh3=rand(0,64);
	$ch1=$chars{$nh1};
	$ch2=$chars{$nh2};
	$ch3=$chars{$nh3};
	$nhnum=$nh1+$nh2+$nh3;
	$knum=0;
	$i=0;
	while(isset($key{$i}))
		$knum+=ord($key{$i++});
	$mdKey=substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8+16);
	$txt=base64_encode($txt);
	$txt=str_replace(array (
			'+',
			'/',
			'=' 
	),array (
			'-',
			'_',
			'.' 
	),$txt);
	$tmp='';
	$j=0;
	$k=0;
	$tlen=strlen($txt);
	$klen=strlen($mdKey);
	for($i=0;$i<$tlen;$i++){
		$k=$k==$klen?0:$k;
		$j=($nhnum+strpos($chars,$txt{$i})+ord($mdKey{$k++}))%64;
		$tmp.=$chars{$j};
	}
	$tmplen=strlen($tmp);
	$tmp=substr_replace($tmp,$ch3,$nh2%++$tmplen,0);
	$tmp=substr_replace($tmp,$ch2,$nh1%++$tmplen,0);
	$tmp=substr_replace($tmp,$ch1,$knum%++$tmplen,0);
	return $tmp;
}
function decrypt($txt,$key='yun'){
	$tlen=strlen($txt);
	if($tlen<1)
		return;
	$chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey=WEBKEY;
	$knum=0;
	$i=0;
	while(isset($key{$i}))
		$knum+=ord($key{$i++});
	$ch1=$txt{$knum%$tlen};
	$nh1=strpos($chars,$ch1);
	$txt=substr_replace($txt,'',$knum%$tlen--,1);
	$ch2=$txt{$nh1%$tlen};
	$nh2=strpos($chars,$ch2);
	$txt=substr_replace($txt,'',$nh1%$tlen--,1);
	$ch3=$txt{$nh2%$tlen};
	$nh3=strpos($chars,$ch3);
	$txt=substr_replace($txt,'',$nh2%$tlen--,1);
	$nhnum=$nh1+$nh2+$nh3;
	$mdKey=substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8+16);
	$tmp='';
	$j=0;
	$k=0;
	$tlen=strlen($txt);
	$klen=strlen($mdKey);
	for($i=0;$i<$tlen;$i++){
		$k=$k==$klen?0:$k;
		$j=strpos($chars,$txt{$i})-$nhnum-ord($mdKey{$k++});
		while($j<0)
			$j+=64;
		$tmp.=$chars{$j};
	}
	$tmp=str_replace(array (
			'-',
			'_',
			'.' 
	),array (
			'+',
			'/',
			'=' 
	),$tmp);
	return trim(base64_decode($tmp));
}
function stripslashe($string){
	if(is_array($string)){
		foreach($string as $key=>$val){
			$string[$key]=stripslashe($val);
		}
	}else{
		$string=stripslashes($string);
	}
	return $string;
}
function read_file($file){
	if(function_exists('file_get_contents')){
		return file_get_contents($file);
	}
	if(!$fp=@fopen($file,FOPEN_READ)){
		return false;
	}
	flock($fp,LOCK_SH);
	$data='';
	if(filesize($file)>0){
		$data=&fread($fp,filesize($file));
	}
	flock($fp,LOCK_UN);
	fclose($fp);
	return $data;
}
function write_file($root,$data,$mode='wb'){
	if(!$fp=@fopen($root,$mode)){
		return false;
	}
	flock($fp,LOCK_EX);
	fwrite($fp,$data);
	flock($fp,LOCK_UN);
	fclose($fp);
	return true;
}
function mkdirs($pathname,$mode=0755){
	is_dir(dirname($pathname))||mkdirs(dirname($pathname),$mode);
	return is_dir($pathname)||@mkdir($pathname,$mode);
}
function showtime($time){
	return @date('Y-m-d H:i',$time);
}
function bpv($team){
	global $C;
	$team=isset($C['sys_teams'][$team])?$team:0;
	return $C['sys_teams'][$team]['pvs'];
}
function get_user($u){
	static $user=array ();
	global $DB;
	if(!isset($user[$u])){
		if(!str_is_int($u)){
			$ur=$DB->fetch_first('select * from '.PF.'user where name="'.addslashes($u).'"');
		}else{
			if($u>0){
				$ur=$DB->fetch_first('select * from '.PF.'user where id="'.$u.'"');
			}else
				$ur=false;
		}
		if(empty($ur)){
			$ur=array (
					'id'=>0,
					'name'=>'NONAME',
					'team'=>0 
			);
		}
		$ur['utable']=empty($ur['utable'])?array ():unserialize($ur['utable']);
		$user[$u]=$ur;
	}
	return $user[$u];
}
function arraysort($arr,$sarr){
	$a=$b=array ();
	foreach($arr as $k=>$v){
		$kv=array_shift($sarr);
		empty($kv)&&$kv=0;
		$a[$kv][]=$k;
	}
	ksort($a);
	foreach($a as $v){
		foreach($v as $v2){
			$b[$v2]=$arr[$v2];
		}
	}
	return $b;
}
function strrand($length=6){
	$hash='';
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$max=strlen($chars)-1;
	for($i=0;$i<$length;$i++){
		$s=$chars[mt_rand(0,$max)];
		if($i<1&&str_is_int($s)){
			$i--;
			continue;
		}
		$hash.=$chars[mt_rand(0,$max)];
	}
	return $hash;
}
function XMLheader(){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
	@header("Pragma: no-cache");
	@header("Content-type: text/xml; charset=utf-8");
}
function getIP(){
	if(getenv('HTTP_CLIENT_IP')){
		$ip=getenv('HTTP_CLIENT_IP');
	}elseif(getenv('HTTP_X_FORWARDED_FOR')){
		$ip=getenv('HTTP_X_FORWARDED_FOR');
	}elseif(getenv('HTTP_X_FORWARDED')){
		$ip=getenv('HTTP_X_FORWARDED');
	}elseif(getenv('HTTP_FORWARDED_FOR')){
		$ip=getenv('HTTP_FORWARDED_FOR');
	}elseif(getenv('HTTP_FORWARDED')){
		$ip=getenv('HTTP_FORWARDED');
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
function set_url($url,$key,$val){
	$arr=explode('-',$url);
	$arr[$key]=$val;
	return implode('-',$arr);
}
function get_url($url,$key){
	$arr=explode('-',$url);
	return (int)$arr[$key];
}
function fstrlen($str,$min,$max,$encoding='UTF-8'){
	$t=mb_strlen($str,$encoding);
	if($t>$max)
		return false;
	if($t<$min)
		return false;
	return true;
}
function fint($i,$min,$max){
	return ($i>=$min&&$i<=$max);
}
function ftag($keystr){
	$keystr=str_replace(' ',',',$keystr);
	$arr=explode(',',$keystr);
	foreach($arr as $k=>$v){
		$v=trim($v);
		$t=mb_strlen($v,'UTF-8');
		if($t<2||$t>15||str_is_int($v)){
			unset($arr[$k]);
			continue;
		}
		$arr[$k]=$v;
	}
	return implode(',',array_unique($arr));
}
function menu_select($pid=0,$layer=0,$mid=0,$fixid=0){
	global $C;
	$str='';
	$pf='';
	for($i=0;$i<$layer;$i++)
		$pf.=($i==$layer-1)?'└─&nbsp;':'&nbsp;&nbsp;&nbsp;&nbsp;';
	foreach($C['sys_menus'] as $k=>$v){
		if($k==$mid)
			continue;
		if($v['pid']==$pid){
			$str.='<option value="'.$k.'" '.($k==($fixid>0?$fixid:$C['sys_menus'][$mid]['pid'])?'selected="selected"':'').'> '.$pf.html($v['name']).'</option>';
			$str.=menu_select($k,$layer+1,$mid,$fixid);
		}
	}
	return $str;
}
function menu_select_yun($mid=0,$pid=0,$layer=0){
	global $C;
	$str='';
	$pf='';
	for($i=0;$i<$layer;$i++)
		$pf.=($i==$layer-1)?'└&nbsp;':'&nbsp;&nbsp;';
	if($C['sys_menu_subs'][$pid]){
		foreach($C['sys_menu_subs'][$pid] as $k=>$v){
			$str.='<option '.($C['sys_modules'][$v['mod']]['yun']?'':'disabled="disabled"').' value="'.$k.'" '.($k==$mid?'selected="selected"':'').'> '.$pf.html($v['name']).'</option>';
			$str.=menu_select_yun($mid,$k,$layer+1);
		}
	}
	return $str;
}
function ppmid($mid){
	global $C;
	if(!isset($C['sys_menus'][$mid]))
		return 0;
	$pid=$C['sys_menus'][$mid]['pid'];
	if($pid==0){
		return $mid;
	}else
		return ppmid($pid);
}
function yun_mail($sendto_email,$subject,$body,$user_name){
	global $user,$C;
	require_once (ABSPATH.'static/phpmailer/class.phpmailer.php');
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->Host=$C['sys_mail_host'];
	$mail->Port=$C['sys_mail_port'];
	$mail->SMTPAuth=true;
	$mail->Username=$C['sys_mail_username'];
	$mail->Password=$C['sys_mail_password'];
	$mail->From=$C['sys_mail_from'];
	$mail->FromName=$C['sys_mail_fromname'];
	$mail->CharSet="UTF-8";
	$mail->Encoding="base64";
	$mail->AddAddress($sendto_email,$user_name);
	$mail->IsHTML(true);
	$mail->Subject=$subject;
	$mail->Body='
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>'.$body.'
</body>
</html>
';
	if($mail->Send()){
		return true;
	}else{
		return $mail->ErrorInfo;
	}
}
function basepv(){
	global $U;
	return bpv($U['team']);
}
function currentuser($g=true){
	global $DB;
	list($uid,$name)=explode("\t",decrypt($_COOKIE[PF.'yun_user']));
	$uid=intval($uid);
	$user=get_user(empty($g)?0:$uid);
	if($user['id']>0&&($name!=$user['name'])){
		$user=get_user(0);
	}
	$user['sid']=substr(md5($_SERVER['HTTP_USER_AGENT'].microtime(true)),0,5);
	
	if($user['msg']>0){
		apply('open_msg','<a href="'.url(R.'user/msg/').'">您有新的消息('.$user['msg'].')</a>');
	}
	
	return $user;
}
function yun_error($msg,$re=''){
	yun_msg('',$msg,$re);
}
function yun_succeed($msg,$re=''){
	yun_msg('success',$msg,$re);
}
function yun_loading($msg,$re=''){
	yun_msg('loading',$msg,$re);
	
	do_apply('yun_loading',null,$msg,$re);
	$method=get_val('method');
	if(IS_AJAX||$method==='ajax'){
		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
		@header("Pragma: no-cache");
		@header("Content-type: text/xml; charset=utf-8");
		if(substr($re,0,1)==='/'||substr($re,0,5)=='http:'){
			if(!empty($msg)){
				setcookie('yun_message',rawurlencode($msg),0,R);
				setcookie('yun_message_type','loading',0,R);
			}
			echo '<?xml version="1.0" encoding="utf-8"?>
<root><![CDATA[<script type="text/javascript">location="',$re,'";</script>]]></root>';
		}elseif($re==='refresh'||$re=='f'){
			if(!empty($msg)){
				setcookie('yun_message',rawurlencode($msg),0,R);
				setcookie('yun_message_type','loading',0,R);
			}
			echo '<?xml version="1.0" encoding="utf-8"?>
<root><![CDATA[<script type="text/javascript">location=location.href;</script>]]></root>';
			exit();
		}else{
			echo '<?xml version="1.0" encoding="utf-8"?>
<root><![CDATA[<script type="text/javascript">';
			if(!empty($msg)){
				echo 'yun_loading_msg("',htmlspecialchars($msg),'");';
			}else{
				echo 'hidemessage();';
			}
			echo $re,' </script>]]></root>';
		}
	}else{
		if(substr($re,0,1)!='/'&&substr($re,0,5)!='http:'){
			$re='/';
		}
		if(!empty($msg)){
			setcookie('yun_message',rawurlencode($msg),0,R);
			setcookie('yun_message_type','loading',0,R);
		}
		echo '<script type="text/javascript">location="',$re,'";</script>';
	}
	exit();
}
function page($url,$pg_c,$pg_m,$pg_d=20,$pg_l=10,$classname='pull-right'){
	$query='';
	if(($q=strrchr($_SERVER['REQUEST_URI'],'?'))!==false){
		$query=substr($q,1);
	}
	if(!IS_REWRITE){
		$arr=explode('&',$query);
		array_shift($arr);
		$query=implode('&',$arr);
	}
	if(strlen($query)>0){
		$url.=(strpos($url,'?')===false?'?':'&').$query;
	}
	require_once (ABSPATH.'static/class_page.php');
	$pages=new page($pg_d,$pg_m,$pg_c,$pg_l,$url,true,false,$classname);
	return $pages->pages;
}
function timer_start(){
	global $timestart;
	return $timestart=microtime(true);
}
function timer_end($display=false){
	global $timestart;
	$_t=sprintf('%01.3fms',microtime(true)-$timestart);
	$_t.=sprintf(' %01.2fMB',memory_get_usage()/1024/1024);
	if(empty($display))
		return $_t;
	echo $_t;
}
function ke_set($return=0){
	$key=strrand();
	set_val('ke_key',$key);
	if(empty($return))
		return 'ke_set(\''.$key.'\');';
	else
		return $key;
}
function ini_editor($id,$formid,$height=0){
	$key=get_val('ke_key');
	$kid=strrand();
	$fid=strrand();
	$js='
	<script type="text/javascript">
	$(document).ready(function(){
		if (Object.prototype.toString.apply(KEID["'.$key.'"]) === \'[object Array]\')
	KEID["'.$key.'"].push("'.$kid.'");
	else
	KEID["'.$key.'"]=["'.$kid.'"];

'.$kid.' = new baidu.editor.ui.Editor({
	zIndex :  \'undefined\'==typeof(fwin_xxx)?2:300'.($height?(',
	minFrameHeight: '.$height):'').'
   });
   '.$kid.'.render(\''.$id.'\');

});

</script>';
	apply('foot',$js);
}
function init_upload($uploadname,$exts='',$file='',$size='1024000'){
	$arr=explode(',',$exts);
	
	foreach($arr as $k=>$v){
		$arr[$k]='*.'.$v;
	}
	$exts=implode(';',$arr);
	
	if(empty($exts))
		$exts='*.*';
	
	$filebox='';
	$thumb='';
	if(strlen($file)>0){
		
		$ext=strtolower(str_replace('.','',strrchr($file,'.')));
		if(in_array($ext,array (
				'jpg',
				'jpge',
				'gif',
				'png' 
		)))
			$thumb='<div class="margin-top-10"> <img data-src="holder.js/50%x180" style="width:50%" src="'.R.$file.'" alt=""></div>';
		$_id=strrand();
		$filebox='<div id="'.$_id.'" class="alert alert-success"><input name="'.$uploadname.'" type="hidden" value="'.$file.'" /><button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$(\'#'.$_id.'\').remove()">×</button><strong>'.str_replace('/','',strrchr($file,'/')).'</strong>'.$thumb.'</div>';
	}
	
	$filebox_id=strrand();
	$queue_id=strrand();
	$upload_id=strrand();
	
	$html='
	<div id="'.$filebox_id.'">'.$filebox.'</div>
	<div id="'.$queue_id.'"></div>
	<input id="'.$upload_id.'" name="" type="file" multiple="true">
	';
	
	$_id=strrand();
	$js='$(\'#'.$upload_id.'\').uploadify({
				\'formData\'     : {
				},
				\'queueID\'	:\''.$queue_id.'\',	
				\'swf\'      : \''.R.'static/uploadify/uploadify.swf\',
				\'uploader\' : \''.url(RM.'upload/').'\',
				\'button_image_url\':\''.R.'static/uploadify/button.png\',
				\'auto\' : true,
				\'buttonText\' : \'选择文件\', 
				\'fileTypeExts\' : \''.$exts.'\', 
				\'fileSizeLimit\' : \''.$size.'KB\', 
				\'height\' : 30,  
		        \'width\' : 100, 
		        \'removeTimeout\' : \'1\', 
		        \'onUploadSuccess\' : function(file, data, response){
						if(data.indexOf(".") <0) {
						alert(data);
						return;
						}
						var extStart=file.name.lastIndexOf(".");
						var thumb=\'\'; 
        var ext=file.name.substring(extStart,file.name.length).toUpperCase(); 
						
        if(ext==".JPG" || ext==".JPEG" || ext==".GIF" || ext==".PNG"){ 
        thumb=\'<div class="margin-top-10"> <img data-src="holder.js/50%x180" style="width:50%" src="'.R.'upload/temp/\'+data+\'" alt=""></div>\';
						
        } 
						$(\'#'.$filebox_id.'\').html(\'<div id="'.$_id.'" class="alert alert-success"><input name="'.$uploadname.'" type="hidden" value="\'+data+\'" /><button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$(\\\'#'.$_id.'\\\').remove()">×</button><strong>\'+file.name+\'</strong>\'+thumb+\'</div>\');
		        },
		        \'method\' : \'post\',
		         \'multi\'    : true,
		       
			});
			';
	apply('jscode',$js);
	
	return $html;
}
function init_uploads($uploadname,$exts='',$files=array(),$size='1024000'){
	$arr=explode(',',$exts);
	
	foreach($arr as $k=>$v){
		$arr[$k]='*.'.$v;
	}
	$exts=implode(';',$arr);
	
	if(empty($exts))
		$exts='*.*';
	
	$filebox='';
	
	foreach($files as $file){
		$thumb='';
		$ext=strtolower(str_replace('.','',strrchr($file,'.')));
		if(in_array($ext,array (
				'jpg',
				'jpge',
				'gif',
				'png' 
		)))
			$thumb='<div class="margin-top-10"> <img data-src="holder.js/50%x180" style="width:50%" src="'.R.$file.'" alt="..."></div>';
		$_id=strrand();
		$filebox.='<div id="'.$_id.'" class="alert alert-success"><input name="'.$uploadname.'[]" type="hidden" value="'.$file.'" /><button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$(\'#'.$_id.'\').remove()">×</button><strong>'.str_replace('/','',strrchr($file,'/')).'</strong>'.$thumb.'</div>';
	}
	
	$filebox_id=strrand();
	$queue_id=strrand();
	$upload_id=strrand();
	
	$html='
	<div id="'.$filebox_id.'">'.$filebox.'</div>
	<div id="'.$queue_id.'"></div>
	<input id="'.$upload_id.'" name="" type="file" multiple="true">
	';
	$_id=strrand();
	$js='
			$(\'#'.$upload_id.'\').uploadify({
				\'formData\'     : {
				},
				\'queueID\'	:\''.$queue_id.'\',
				\'swf\'      : \''.R.'static/uploadify/uploadify.swf\',
				\'uploader\' : \''.url(RM.'upload/').'\',
				\'button_image_url\':\''.R.'static/uploadify/button.png\',
				\'auto\' : true,
				\'buttonText\' : \'选择文件\',
				\'fileTypeExts\' : \''.$exts.'\',
				\'fileSizeLimit\' : \''.$size.'KB\',
				\'height\' : 30,
		        \'width\' : 100,
		        \'removeTimeout\' : \'1\',
		        \'onUploadSuccess\' : function(file, data, response){
						if(data.indexOf(".") <0) {
						alert(data);
						return;
						}
						var extStart=file.name.lastIndexOf(".");
						var thumb=\'\';
        var ext=file.name.substring(extStart,file.name.length).toUpperCase();

        if(ext==".JPG" || ext==".JPEG" || ext==".GIF" || ext==".PNG"){
        thumb=\'<div class="margin-top-10"> <img data-src="holder.js/50%x180"  style="width:50%" src="'.R.'upload/temp/\'+data+\'" alt="..."></div>\';

        }
						$(\'#'.$filebox_id.'\').append(\'<div id="'.$_id.'" class="alert alert-success"><input name="'.$uploadname.'[]" type="hidden" value="\'+data+\'" /><button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="$(\\\'#'.$_id.'\\\').remove()">×</button><strong>\'+file.name+\'</strong>\'+thumb+\'</div>\');
		        },
		        \'method\' : \'post\',
		         \'multi\'    : true,
		   
			});
			';
	
	apply('jscode',$js);
	
	return $html;
}
function xstr($str,$len,$pf=false){
	$tmp_str='';
	$w=0;
	$x=$len;
	if(empty($x))
		return $str;
	for($i=0;$i<$len;$i++){
		$bin=decbin(ord($str[$i]));
		$tmp_str2=$str[$i];
		if($bin>'10000000'){
			for($n=1;$bin[$n];$n++){
				$tmp_str2.=$str[++$i];
			}
			$len++;
			$w++;
		}
		$w++;
		if($w>=$x-1&&$str[$i+1]){
			$pf&&$tmp_str.='…';
			break;
		}else{
			$tmp_str.=$tmp_str2;
		}
	}
	return $tmp_str;
}
function wstr($str){
	$w=0;
	$i=0;
	while(isset($str[$i])){
		$bin=decbin(ord($str[$i]));
		if($bin>'10000000'){
			for($n=1;$bin[$n];$n++,$i++)
				;
			$w++;
		}
		$w++;
		$i++;
	}
	return $w;
}
function lv($user=false){
	global $C;
	if(false===$user)
		$user=$GLOBALS['user'];
	if(empty($C['sys_lv_a'][0])){
		$lv_a=-1;
	}else if(empty($C['sys_lv_a'][1])){
		for($lv=0,$lvv=$C['sys_lv_a'][0];$user['a']>$lvv;$lv++,$lvv=$C['sys_lv_a'][0]*($lv+$C['sys_lv_a'][2]/100))
			;
		$lv_a=$lv;
	}else{
		for($lv=0,$lvv=$C['sys_lv_a'][0];$user['a']>$lvv;$lv++,$lvv=$lvv*(1+$C['sys_lv_a'][2]/100))
			;
		$lv_a=$lv;
	}
	if(empty($C['sys_lv_b'][0])){
		$lv_b=-1;
	}else if(empty($C['sys_lv_b'][1])){
		for($lv=0,$lvv=$C['sys_lv_b'][0];$lvv<$user['b'];$lv++,$lvv=$C['sys_lv_b'][0]*($lv+$C['sys_lv_b'][2]/100))
			;
		$lv_b=$lv;
	}else{
		for($lv=0,$lvv=$C['sys_lv_b'][0];$lvv<$user['b'];$lv++,$lvv=$lvv*(1+$C['sys_lv_b'][2]/100))
			;
		$lv_b=$lv;
	}
	if(empty($C['sys_lv_c'][0])){
		$lv_c=-1;
	}else if(empty($C['sys_lv_c'][1])){
		for($lv=0,$lvv=$C['sys_lv_c'][0];$lvv<$user['c'];$lv++,$lvv=$C['sys_lv_c'][0]*($lv+$C['sys_lv_c'][2]/100))
			;
		$lv_c=$lv;
	}else{
		for($lv=0,$lvv=$C['sys_lv_c'][0];$lvv<$user['c'];$lv++,$lvv=$lvv*(1+$C['sys_lv_c'][2]/100))
			;
		$lv_c=$lv;
	}
	return min($lv_a<0?999999:$lv_a,$lv_b<0?999999:$lv_b,$lv_c<0?999999:$lv_c);
}
function refresh(){
	if(MOD!='system'||ACTION!='message')
		return;
	$sid=substr(md5($_SERVER['REQUEST_URI']),0,5);
	$reurl=urldecode($_GET['url']);
	if(empty($reurl)){
		header('Location: '.url(R));
		exit();
	}
	$cookie=array ();
	if(!empty($_COOKIE[PF.'yun_reurl'])){
		@$cookie=unserialize($_COOKIE[PF.'yun_reurl']);
		if(!is_array($cookie)){
			header('Location: '.url(R));
			exit();
		}
	}
	if(empty($cookie[$sid])){
		if(count($cookie)>5)
			array_shift($cookie);
		$cookie[$sid]=$reurl;
		setcookie(PF.'yun_reurl',serialize($cookie),0,R);
	}else{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$cookie[$sid]);
		exit();
	}
}
function yun_load_theme(){
	global $C,$theme_conf;
	$cache_file=ABSPATH.'cache/theme.php';
	if(DEBUG||UPDATE||!file_exists($cache_file)){
		$theme=array ();
		if($_d=@opendir(ABSPATH.'theme/')){
			while($entry=readdir($_d)){
				if(substr($entry,0,1)=='_')
					continue;
				if(is_dir(ABSPATH.'theme/'.$entry)&&$entry!='.'&&$entry!='..'&&file_exists($file=ABSPATH.'theme/'.$entry.'/__conf.php')&&!in_array($entry,$C['sys_theme_close'])){
					$theme[$entry]=include $file;
				}
			}
			closedir($_d);
		}
		$theme_conf=$theme;
		write_file($cache_file,serialize($theme)) or yun_error(R.'cache/, 无法写入');
	}
	$theme_conf=unserialize(read_file($cache_file));
}
function memory_usage(){
	return (!function_exists('memory_get_usage'))?'0':round(memory_get_usage()/1048576,3);
}
function is_num($n){
	return preg_match('/^\-?(\d+\.)?\d+$/',$n);
}
function docroot(){
	$r=trim(R,'/\\');
	if($r=='')
		return rtrim(ABSPATH,'/\\');
	return preg_replace("/[\/\\\\]".preg_quote($r,'/')."/s","",rtrim(ABSPATH,'/\\'));
}
function get_submenuid($mid){
	global $C;
	$arr=array ();
	$marr=(array)$C['sys_menu_subs'][$mid];
	
	if(empty($marr))
		return $arr;
	foreach($C['sys_menu_subs'][$mid] as $k=>$v){
		$arr[]=$k;
		$_arr=get_submenuid($k);
		if(!empty($_arr)){
			$arr=array_merge($arr,$_arr);
		}
	}
	return $arr;
}
function get_tab(){
	global $DB;
	$result=$DB->query("select * from ".PF."tab");
	$arr=array ();
	while($row=$DB->fetch_array($result)){
		
		$arr[$row['id']]=$row;
		$arr[$row['id']]['conf']=count($row['conf'])>0?unserialize($row['conf']):array ();
	}
	
	return $arr;
}
function get_channel(){
	global $DB;
	$result=$DB->query("select * from ".PF."channel order by o asc");
	$arr=array ();
	while($row=$DB->fetch_array($result)){
		
		$row['pvs']=strlen($row['pvs'])>0?unserialize($row['pvs']):array ();
		$row['cats']=strlen($row['cats'])>0?unserialize($row['cats']):array ();
		$row['tabs']=strlen($row['tabs'])>0?unserialize($row['tabs']):array (
				'diss'=>array (),
				'tpls'=>array () 
		);
		$row['configs']=strlen($row['configs'])>0?unserialize($row['configs']):array ();
		
		$arr[$row['id']]=$row;
	}
	
	return $arr;
}
function deldir($dirName){
	if($handle=@opendir($dirName)){
		while(false!==($item=readdir($handle))){
			if($item!='.'&&$item!='..'){
				if(is_dir($dirName.'/'.$item)){
					deldir($dirName.'/'.$item);
				}else{
					@unlink($dirName.'/'.$item);
				}
			}
		}
		closedir($handle);
		return rmdir($dirName);
	}else{
		return false;
	}
}
function jump($url=''){
	global $C;
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
	@header("Pragma: no-cache");
	@header('Content-Type: text/html; charset=utf-8');
	@header("http/1.1 404 not found");
	@header("status: 404 not found");
	
	$msg='页面不存在';
	include ABSPATH.'static/404.php';
	
	exit();
}
function upload_move($file,$mod,$thumb=false){
	$file=str_replace(array (
			'\\',
			'/' 
	),'/',$file);
	
	$arr=explode('/',$file);
	$num=count($arr);
	
	if($num==3&&str_is_int($arr[1])&&$arr[0]=='upload')
		return $file;
	
	elseif($num==1){
		$file=ABSPATH.'upload/temp/'.$file;
		
		if(!is_file($file))
			return;
		
		$ext=strtolower(str_replace('.','',strrchr($file,'.')));
		
		$path='upload/'.date('Ymd');
		$filename=$mod.'_'.strrand().'.'.$ext;
		
		$newfile=ABSPATH.$path.'/'.$filename;
		
		if(!is_dir(ABSPATH.$path)){
			if(!mkdir(ABSPATH.$path,0777))
				return;
			write_file(ABSPATH.$path.'/index.html','0');
		}
		
		if($thumb&&in_array($ext,array (
				'gif',
				'png',
				'jpg',
				'jpeg' 
		))){
			
			if(!$data=@getimagesize($file)){
				@unlink($file);
				return;
			}
			
			$img=null;
			if($ext=='gif'){
				$img=imagecreatefromgif($file);
			}else if($ext=='jpg'||$ext=='jpeg'){
				$img=imagecreatefromjpeg($file);
			}else if($ext=='png'){
				$img=imagecreatefrompng($file);
			}
			if(empty($img)){
				@unlink($file);
				return;
			}
			$width=200;//新图像大小
			$height=112;
			
			$srcW=$data[0];
			$srcH=$data[1];
			
			if($srcW/$srcH>16/9){//扁的图
				$_x=$srcH*16/9;
				$sx=round(($srcW-$_x)/2);
				$sy=0;
				$srcW=round($srcH*16/9);
				
			}elseif($srcW/$srcH<16/9){
				$_y=$srcW*9/16;
				$sx=0;
				$sy=round(($srcH-$_y)/2);
				$srcH=round($srcW*9/16);
			}else{
				$sx=0;
				$sy=0;
			}
			
			
			/*
			$width=($width>$srcW)?$srcW:$width;
			$height=round($width*$srcH/$srcW);
			if($srcW*$width>$srcH*$height)
				$height=round($srcH*$width/$srcW);
			else
				$width=round($srcW*$height/$srcH);
			*/
			
			if(function_exists('imagecreatetruecolor')){
				$new=imagecreatetruecolor($width,$height);
				ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
			}else{
				$new=imagecreate($width,$height);
				ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
			}
			ImageJPEG($new,$newfile,90);
			ImageDestroy($new);
			ImageDestroy($img);
			@unlink($file);
			
			return $path.'/'.$filename;
		}else if(rename($file,$newfile))
			return $path.'/'.$filename;
		
		else
			return;
	}else
		return;
}
function diy_upload_move($file,$thumb=false){
	$file=str_replace(array (
			'\\',
			'/' 
	),'/',$file);
	
	$arr=explode('/',$file);
	$num=count($arr);
	
	if($num==4)
		return $file;
	
	elseif($num==1){
		$file=ABSPATH.'upload/temp/'.$file;
		
		if(!is_file($file))
			return;
		
		$ext=strtolower(str_replace('.','',strrchr($file,'.')));
		
		$path='theme/'.THEMENAME.'/upload';
		$filename=date('Ymd-His').'_'.strrand(4).'.'.$ext;
		
		$newfile=ABSPATH.$path.'/'.$filename;
		
		if($thumb&&in_array($ext,array (
				'gif',
				'png',
				'jpg',
				'jpeg' 
		))){
			
			if(!$data=@getimagesize($file)){
				@unlink($file);
				return;
			}
			
			$img=null;
			if($ext=='gif'){
				$img=imagecreatefromgif($file);
			}else if($ext=='jpg'||$ext=='jpeg'){
				$img=imagecreatefromjpeg($file);
			}else if($ext=='png'){
				$img=imagecreatefrompng($file);
			}
			if(empty($img)){
				@unlink($file);
				return;
			}
			$width=200;
			$height='auto';
			$srcW=$data[0];
			$srcH=$data[1];
			$width=($width>$srcW)?$srcW:$width;
			$height=round($width*$srcH/$srcW);
			if($srcW*$width>$srcH*$height)
				$height=round($srcH*$width/$srcW);
			else
				$width=round($srcW*$height/$srcH);
			if(function_exists('imagecreatetruecolor')){
				$new=imagecreatetruecolor($width,$height);
				ImageCopyResampled($new,$img,0,0,0,0,$width,$height,$data[0],$data[1]);
			}else{
				$new=imagecreate($width,$height);
				ImageCopyResized($new,$img,0,0,0,0,$width,$height,$data[0],$data[1]);
			}
			ImageJPEG($new,$newfile,90);
			ImageDestroy($new);
			ImageDestroy($img);
			@unlink($file);
			
			return $path.'/'.$filename;
		}else if(rename($file,$newfile))
			return $path.'/'.$filename;
		
		else
			return;
	}else
		return;
}
function yun_msg($class='',$msg,$re=''){
	global $C,$G;
	
	$url='';
	$js='';
	$refresh='';
	
	if(substr($re,0,1)=='/'||substr($re,0,5)=='http:'||substr($re,0,6)=='https:'){
		$url=$re;
	}
	if(substr($re,-1)==';'){
		$js=$re;
	}
	if($re=='refresh' or $re=='f'){
		$refresh='location.href';
	}
	
	$class==''&&$class='warning';
	
	$method=get_val('method');
	
	if(IS_AJAX||$method==='ajax'){
		
		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
		@header("Pragma: no-cache");
		@header("Content-type: text/xml; charset=utf-8");
		$js.='if(document.getElementById("fwin_content_xxx")!=null) { var str=document.getElementById("fwin_content_xxx").innerHTML; newstr=stripscript(str);if(!newstr){setTimeout(function () {$$(\'append_parent\').removeChild($$(\'fwin_xxx\'));}, 0);}};';
		
		if(strlen($msg)>0){
			
			$msg='<div style="z-index:9999999" class="alert alert-'.$class.'"><strong>'.$msg.'</strong>';
			
			if(!empty($url)){
				$msg.=' <span id="ajax_jumpTo">2</span>秒后跳转...';
				$js.='countDown("ajax_jumpTo",2,"'.$url.'");';
			}else if(!empty($refresh)){
				$msg.=' <span id="ajax_jumpTo">2</span>秒后刷新...';
				$js.='countDown("ajax_jumpTo",2,"");';
			}
			$msg.='</div>';
		}
		
		echo '<?xml version="1.0" encoding="utf-8"?>
<root><![CDATA[<script type="text/javascript">yun_msg(\'',$class,'\', \''.$msg.'\');',$js,'</script>]]></root>';
	}else{
		
		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
		@header("Pragma: no-cache");
		@header('Content-Type: text/html; charset=utf-8');
		@header("http/1.1 404 not found");
		@header("status: 404 not found");
		
		if(is_file($file=THEMEDIR.'404.php'))
			include $file;
		else
			include ABSPATH.'static/404.php';
	}
	exit();
}
function init_module(){
	global $G;
	if(CID>0){
		$channel=$G['channels'][CID];
		
		$ji=9;
		$_mid=$channel['pid'];
		
		while(isset($G['channels'][$_mid]) && $G['channels'][$G['channels'][$_mid]['pid']]['pid']>0){
			apply('tag_title',$G['channels'][$_mid]['name'],$ji);
			apply('current',array (
					$G['channels'][$_mid]['name'],
					R.$G['channels'][$_mid]['link'] 
			),$ji--);
			$_mid=$G['channels'][$_mid]['pid'];
		}
		
		if($channel['pid']>0){
		
		apply('tag_title',$channel['name']);
		apply('current',array (
				$channel['name'],
				R.$channel['link'] 
		));
		apply('tag_keywords',$channel['keywords']);
		apply('tag_description',$channel['description']);
		}
	}
}
function get_action(){
	global $G;
	$filename=ACTION.'.php';
	
	if(CID>0){
		$channel=$G['channels'][CID];
		if($filename==$channel['action_1']&&strlen($channel['action_1_to'])>0)
			$filename=$channel['action_1_to'];
		else if($filename==$channel['action_2']&&strlen($channel['action_2_to'])>0)
			$filename=$channel['action_2_to'];
		else if($filename==$channel['action_3']&&strlen($channel['action_3_to'])>0)
			$filename=$channel['action_3_to'];
	}
	return ABSPATH.'module/'.MOD.'/'.$filename;
}
function get_action_tpl(){
	global $G;
	$filename=ACTION.'_tpl.php';
	
	if(CID>0){
		$channel=$G['channels'][CID];
		if($filename==$channel['action_tpl_1']&&strlen($channel['action_tpl_1_to'])>0)
			$filename=$channel['action_tpl_1_to'];
		else if($filename==$channel['action_tpl_2']&&strlen($channel['action_tpl_2_to'])>0)
			$filename=$channel['action_tpl_2_to'];
		else if($filename==$channel['action_tpl_3']&&strlen($channel['action_tpl_3_to'])>0)
			$filename=$channel['action_tpl_3_to'];
	}
	return ABSPATH.'module/'.MOD.'/'.$filename;
}
function cssmin($buffer){
	$buffer=preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$buffer);
	$buffer=str_replace(array (
			"\r\n",
			"\r",
			"\n",
			"\t",
			'  ',
			'    ',
			'    ' 
	),'',$buffer);
	return $buffer;
}
function add_jsfile(){
	global $C;
	$is_compress=!empty($C['sys_compress'])&&MOD!='admin'&&MOD!='template';
	$arr=do_apply('jsfile','array');
	require_once ABSPATH.'static/JSMin.php';
	
	if(DEBUG){
		foreach($arr as $file){
			echo '<script src="',$file,'?',$C['sys_cjcode'],'" type="text/javascript"></script>
						';
		}
	}else{
		
		foreach($arr as $file){
			if(substr($file,0,1)=='/'){
				if(is_file($_file=DOCROOT.$file)){
					$filename=md5($file).'.js';
					if(!is_file(ABSPATH.'cache/'.$filename))
						write_file(ABSPATH.'cache/'.$filename,$is_compress?JSMin::minify(read_file($_file)):read_file($_file));
					echo '<script src="',R,'cache/',$filename,'?',$C['sys_cjcode'],'" type="text/javascript"></script>
							';
				}
			}else
				echo '<script src="',$jsfile,'?',$C['sys_cjcode'],'" type="text/javascript"></script>
						';
		}
	}
}
function add_cssfile(){
	global $C;
	
	$is_compress=!empty($C['sys_compress'])&&MOD!='admin'&&MOD!='template';
	
	$arr=do_apply('cssfile','array');
	foreach($arr as $file){
		if(substr($file,0,1)=='/'){
			if(is_file($_file=DOCROOT.$file)){
				$info=pathinfo($file);
				$class=ltrim(str_replace(array (
						'/',
						'\\',
						'.' 
				),'_',$info['dirname'].'/'.$info['filename']),'_');
				
				$filename=$class.'.css';
				
				if(!is_file($__file=ABSPATH.'cache/'.$filename)||DEBUG||UPDATE){
					$css=preg_replace("/([:|,| ]\s*url\(['|\"]*)(?!\/|http:|<\?)/is","\\1".$info['dirname'].'/'."\\2",read_file($_file));
					$css=str_replace('CLASS',$class,$css);
					write_file(ABSPATH.'cache/'.$filename,$is_compress?cssmin($css):$css);
				}
				
				echo '<link href="',R,'cache/',$filename,'?',$C['sys_cjcode'],'" rel="stylesheet" type="text/css"/>
						';
			}
		}else
			
			echo '<link href="',$file,'" rel="stylesheet" type="text/css"/>
					';
	}
}
function get_homeid(){
	global $G;
	$homeid=0;
	if(CID<1){
		
		foreach($G['channels'] as $k=>$v){
			if(!empty($v['home'])){
				$homeid=$k;
				break;
			}
		}
	}else{
		
		$pid=$G['channels'][CID]['pid'];
		
		if($pid<1)
			$homeid=CID;
		else{
			while(isset($G['channels'][$pid])){
				$_pid=$pid;
				$pid=$G['channels'][$pid]['pid'];
				if($pid<1){
					$homeid=$_pid;
					break;
				}
			}
		}
	}
	return $homeid;
}
