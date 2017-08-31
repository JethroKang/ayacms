<?php

class tag{
	
	function show($str){
		$arr=explode(',', $str);
		$html='';
			foreach($arr as $v){
				$html.='<a class="badge" href="'.url(R.'tag/?q='.urldecode($v)).'">'.html($v).'</a> ';
			}
		return $html;	
	}
	
	
}

