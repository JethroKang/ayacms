<?php
class tab{
	function post($diss){
		global $G;
		
		if(empty($diss))
			return array ();
		
		$datas=array ();
		
		foreach($diss as $id){
			$tab=$G['tabs'][$id];
			$conf=$tab['conf'];
			$type=$tab['type'];
			$field='tab_'.$id;
			$data=$_POST[$field];
			
			switch($type){
				case 'wenzi':
					
					$data=trim((string)$data);
					fstrlen($data,$conf[0],$conf[1]) or yun_error($tab['warning'],'yun_onfocus("'.$field.'");');
					
					$datas[$field]=$data;
					
					break;
				
				case 'tupian':
					
					$arr=array ();
					empty($data) && $data=array();
					$num=count($data);
					
					fint($num,$conf[0],$conf[1]) or yun_error($tab['warning'],'yun_onfocus("'.$field.'");');
					
					foreach($data as $file){
						
						$path=upload_move($file,$tab['fortab']);
						if(!empty($path))
							$arr[]=$path;
					}
					
					$datas[$field]=serialize($arr);
					
					break;
				
				case 'zhengxingsuzi':
					
					$data=(int)trim($data);
					($data<$conf[0] or $data>$conf[1])&&yun_error($tab['warning'],'yun_onfocus("'.$field.'");');
					
					$datas[$field]=$data;
					
					break;
				
				default:
					exit();
			}
		}
		return $datas;
	}
	function tpls($diss,$tpls,$deftpl,$post='',$mod=''){
		global $G;
		
		if(!is_array($tpls)){
			$mod=$post;
			$post=$deftpl;
		}
		
		$html='';
		
		$types=array ();
		foreach($diss as $id){
			$types[]=$G['tabs'][$id]['type'];
		}
		
		$diss=array_values($diss);
		
		foreach($diss as $k=>$id){
			$type=$G['tabs'][$id]['type'];
			if($k==0 or $types[$k-1]!=$type)
				$first=1;
			else
				$first=0;
			
			if(!isset($types[$k+1]) or $types[$k+1]!=$type)
				
				$last=1;
			else
				$last=0;
			
			$html.=self::get_tpl($id,is_array($tpls)?(empty($tpls[$id])?$deftpl:$tpls[$id]):$tpls,$post['tab_'.$id],$mod,$first,$last);
		}
		
		return $html;
	}
	function tpl($id,$tpl,$data,$mod='',$first=true,$last=true){
		global $G;
		return self::get_tpl($id,$tpl,$data,$mod,$first,$last);
	}
	function get_tpl($id,$tpl,$data,$mod,$first,$last){
		global $G;
		$mod==''&&$mod=MOD;
		
		
		if(!is_file($file=ABSPATH.'module/'.$mod.'/tab_tpl/'.$G['tabs'][$id]['type'].'/'.$tpl))
			return;
		$tab=$G['tabs'][$id];
		ob_start();
		include $file;
		$html=ob_get_contents();
		ob_end_clean();
		return $html;
	}
}