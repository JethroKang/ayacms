<?php
class template{
	function get_diykeys($data,&$keys){
		if(!is_array($data))
			return;
		foreach($data as $key=>$val){
			if(substr($key,0,5)=='block'){
				$keys[]=$val['attr']['name'];
			}else{
				self::get_diykeys($val,$keys);
			}
		}
	}
	function copy_layer($data,&$keys){
		if(!is_array($data))
			return $data;
		$datas=array ();
		foreach($data as $key=>$val){
			if(substr($key,0,5)=='block'){
				$_k='block'.strrand(6);
				$_arr=$val;
				$_arr['attr']['name']=$_k;
				$datas['block`'.$_k]=$_arr;
				$keys[$val['attr']['name']]=$_k;
			}else{
				$datas[$key]=self::copy_layer($val,$keys);
			}
		}
		return $datas;
	}
	function copy_diy(&$diy,$keys){
		foreach($diy as $k=>$v){
			if(isset($keys[$k])){
				$diy[$keys[$k]]=$v;
				$diy[$keys[$k]]['eleid']=$keys[$k];
			}
		}
	}
}
?>