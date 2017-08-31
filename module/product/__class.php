<?php
class product{
	function topic_new($pid,$row){
		global $DB,$G;
		
		$arr=array (
				'link'=>$link=strlen($row['sign'])>0?($row['sign'].'/'):('show/'.$pid.'/') 
		);
		$str=sql_update($arr);
		$DB->query("update ".PF."product set $str where id='$pid'");
		
		$arr=array (
				'channel_id'=>$row['channel_id'],
				'pid'=>$pid,
				'post_time'=>$row['post_time'],
				'title'=>$row['title'],
				'link'=>$link 
		);
		
		$str=sql_insert($arr);
		$DB->query("insert into ".PF."yun $str");
		
		$tags=explode(',',$row['keywords']);
		foreach($tags as $tag){
			if(strlen($tag)<1)
				continue;
			$arr=array (
					'tag'=>$tag,
					'channel_id'=>$row['channel_id'],
					'pid'=>$pid,
					'title'=>$row['title'],
					'post_time'=>$row['post_time'] 
			);
			$str=sql_insert($arr);
			$DB->query("insert into ".PF."tag $str");
		}
	}
	function topic_edit($pid,$row){
		global $G,$DB;
		
		$arr=array (
				'link'=>$link=strlen($row['sign'])>0?($row['sign'].'/'):('show/'.$pid.'/') 
		);
		$str=sql_update($arr);
		$DB->query("update ".PF."product set $str where id='$pid'");
		
		$arr=array (
				'title'=>$row['title'],
				'link'=>$link 
		);
		
		$str=sql_update($arr);
		$DB->query("update ".PF."yun set $str where channel_id='".$row['channel_id']."' && pid='".$pid."'");
		
		$DB->query("delete from ".PF."tag where channel_id='".$row['channel_id']."' && pid='".$pid."'");
		$tags=explode(',',$row['keywords']);
		foreach($tags as $tag){
			if(strlen($tag)<1)
				continue;
			$arr=array (
					'tag'=>$tag,
					'channel_id'=>$row['channel_id'],
					'pid'=>$pid,
					'title'=>$row['title'],
					'link'=>$link,
					'post_time'=>$row['post_time'] 
			);
			$str=sql_insert($arr);
			$DB->query("insert into ".PF."tag $str");
		}
	}
	function topic_del($pid,&$row){
		global $G,$DB;
		
		$DB->query("delete from ".PF."product where id='$pid'");
		
		$DB->query("delete from ".PF."yun where channel_id='$row[channel_id]' && pid='$pid'");
		$DB->query("delete from ".PF."tag where channel_id='$row[channel_id]' && pid='$pid'");
	}
	function topic_move($pid,$tochannel_id){
		global $G,$DB;
		
		if(!$row=$DB->fetch_first("select * from ".PF."product where id=".$pid))
			return;
		$channel_id=$row['channel_id'];
		if($channel_id==$tochannel_id)
			return;
		
		$arr=array (
				'channel_id'=>$tochannel_id,
				'cat_0'=>0,
				'cat_1'=>0,
				'cat_2'=>0 
		);
		
		$str=sql_update($arr);
		$DB->query("update ".PF."product set $str where id='$pid'");
		
		$DB->query("update ".PF."yun set channel_id='$tochannel_id' where channel_id='$channel_id' && pid='$pid'");
		$DB->query("update ".PF."tag set channel_id='$tochannel_id' where channel_id='$channel_id' && pid='$pid'");
		;
	}
	function channel_new($arr){
		global $DB,$G;
		
		/*
		 * 'pvs'=>array('name'=>array('进入','评论','取消验证码','无间隔提交','前台管理','投稿'),'0'=>array(1,0,0,0,0),'1'=>array(1,1,0,0,0),'2'=>array(1,0,0,0,0),'3'=>array(1,1,1,1,1),'4'=>array(1,1,1,1,1,1)),
		 */
		
		$pvs=$G['mods']['product']['pvs'];
		$configs=$G['mods']['product']['configs'];
		
		$arr['link']=$arr['sign'].'/';
		$arr['pvs']=serialize($pvs);
		$arr['configs']=serialize($configs);
		$arr['cats']=serialize(array ());
		
		
		$arr['tabs']=serialize(array ('diss'=>array(),'tpls'=>array()));
		
		foreach($G['channels'] as $v){
			if($v['link']==$arr['link'])
				yun_error('无法创建,栏目链接已占用');
		}
		
		$str=sql_insert($arr);
		$DB->query("insert into ".PF."channel $str");
	}
	function channel_edit($id,$arr){
		global $DB,$G;
		
		$arr['link']=$arr['sign'].'/';
		
		foreach($G['channels'] as $k=>$v){
			if($v['link']==$arr['link']&&$id!=$k)
				yun_error('无法创建,栏目链接已占用');
		}
		
		$str=sql_update($arr);
		$DB->query("update ".PF."channel set $str where id='$id'");
	}
	function channel_del($id){
		global $DB;
		
		$rs=$DB->query('select * from '.PF.'product where channel_id='.$id);
		
		while($row=$DB->fetch_array($rs)){
			self::topic_del($row['id'],$row);
		}
	}
	function mpv($mid,$user=false){
		global $G,$U;
		$user===false&&$user=$U;
		
		$pv=$G['channels'][$mid]['pvs'][$U['team']];
		
		return is_array($pv)?$pv:array ();
	}
	function sign($sign,$pid=0){
		global $DB;
		
		if(!preg_match("/^\w+$/is",$sign))
			return false;
		
		if(file_exists(ABSPATH.'module/product/'.$sign.'.php')){
			return false;
		}
		if($DB->fetch_first("select id from ".PF."product where id<>'$pid' && sign='".addslashes($sign)."'")){
			return false;
		}
		return true;
	}
	function get_content($content){
		$arr=explode('_ayacms_page_',$content);
		array_unshift($arr,0);
		unset($arr[0]);
		return $arr;
	}
	function get_pagetitle($titles){
		if($titles=='')
			return array ();
		$arr=array_map('trim',explode("\n",$titles));
		array_unshift($arr,0);
		unset($arr[0]);
		return $arr;
	}
	function comment_content($content){
		return preg_replace("/(\r?\n)+/","<br />",html($content));
	}
}
?>