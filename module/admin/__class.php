<?php

class admin{
	
	function upcache(){
		$dirName=ABSPATH.'cache';
		if($handle=@opendir($dirName)){
			while(false!==($item=readdir($handle))){
				if($item!='.'&&$item!='..'){
					@unlink($dirName.'/'.$item);
				}
			}
			closedir($handle);
			set_conf('sys_cjcode',strrand());
			return write_file($dirName.'/index.html','0');
		}else{
			return false;
		}
	}
	function deldir($dirName){
		if($handle=@opendir($dirName)){
			while(false!==($item=readdir($handle))){
				if($item!='.'&&$item!='..'){
					if(is_dir($dirName.'/'.$item)){
						self::deldir($dirName.'/'.$item);
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
	function getPHPini($varName){
		switch($res=get_cfg_var($varName)){
			case 0:
				return 'NO';
				break;
			case 1:
				return 'YES';
				break;
			default:
				return $res;
				break;
		}
	}
	
	function tab($tab,$sel=''){
		$sel==''&&$sel=md5(M_E);
		echo '<ul class="admin_tab">';
		foreach($tab as $name=>$url){
			$class=preg_match("/".preg_quote($sel,'/')."/",$url)?'selected':'';
			echo '<li><a class="',$class,'" href="',url($url),'">',html($name),'</a></li>';
		}
		echo '</ul>';
	}














function menu_select($pid=0,$layer=0,$mid=0,$newpid=0){
	global $G;
	
	$str='';
	$pf='';
	for($i=0;$i<$layer;$i++)
		$pf.=($i==$layer-1)?'└─&nbsp;':'&nbsp;&nbsp;&nbsp;&nbsp;';
	foreach($G['channels'] as $k=>$v){
		
		if(empty($newpid)){
		if($v['pid']==$pid && $mid!=$k){
			
			$str.='<option value="'.$k.'" '.($k==$G['channels'][$mid]['pid']?'selected="selected"':'').'> '.$pf.html($v['name']).'</option>';
			$str.=self::menu_select($k,$layer+1,$mid,$newpid);
		}
		}else{
			
				if($v['pid']==$pid){
			
			$str.='<option value="'.$k.'" '.($k==$newpid?'selected="selected"':'').'> '.$pf.html($v['name']).'</option>';
			$str.=self::menu_select($k,$layer+1,$mid,$newpid);
		}	
			
		}
		
		
		
		
	}
	return $str;
}





function channel_list($pid=0,$layer=0){
		global $G;
		foreach($G['channels'] as $id=>$v){
			if($v['pid']!=$pid)
				continue;
				$url=curl($v['link']);
			
			?>

                              <tr>
			<td><?php echo $id?></td>
			<td><?php
			
			for($i=0;$i<$layer;$i++)
				echo ($i==$layer-1)?'└─&nbsp;':'&nbsp;&nbsp;&nbsp;&nbsp;';
			?><input style="width: 60px" type="text" name="order[<?php echo $id?>]"
				value="<?php echo html($v['o'])?>" size="3" maxlength="3" /> <a
				href="<?php echo $url?>"><?php echo html($v['name'])?></a> <a
				href="<?php echo url(RM.'channelnew/?id='.$id)?>"
				onclick="showwin(this.href)"><i class="icon-plus"></i></a></td>
                
			<td><?php echo html($v['sign'])?></td>

			<td><strong><?php echo modname($v['formod'])?></strong></td>
			
			<?php if($pid==0){?>
			
			<td><input onclick="ajaxget('<?php echo url(RM.'channelhome/?id='.$id)?>');doane(event);" type="checkbox" value="" <?php echo $v['home']?'checked':''?> /></td>
			<td></td>
			<?php }else{?>
			<td></td>
			<td><input onclick="ajaxget('<?php echo url(RM.'channelhide/?id='.$id)?>');doane(event);" type="checkbox" value="" <?php echo $v['hide']?'checked':''?> /></td>
			
			<?php }?>
			<td><a href="<?php echo url(RM.'channeledit/?id='.$id)?>" class="btn default btn-xs purple" onclick="showwin(this.href)"><i class="icon-edit"></i> 编辑</a>  
            <a href="<?php echo url(RM.'channeldel/?id='.$id)?>"
				onclick="if(confirm('要删除栏目吗?'))ajaxget(this.href);doane(event);" class="btn default btn-xs black" ><i class="icon-trash"></i> 删除</a>
                
                </td>
		</tr>
		<?php
			
			self::channel_list($id,$layer+1);
		}
	}

function user_del($id){
	global $DB;
	//do_apply('deluser');
	$DB->query("delete from ".PF."user where id='$id'");
	return true;
}

}
?>