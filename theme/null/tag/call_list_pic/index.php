<?php

$channel_id=(int)$channel_id;
$tab=(string)$tab;
$field=(string)$field;
$titlenum=(int)$titlenum;
$listnum=(int)$listnum;
$height=(string)$height;


if($channelid==-1){
	if(!defined('CID')) return; 
	$channel_id=CID;
}


$order=$field?$field:'id';
$where='thumb!=\'\' && '.($channel_id>0?('channel_id='.$channel_id):'1=1');



$rs=$DB->query("select * from ".PF.$tab." where ".$where." order by ".$order." desc limit 0,".$listnum);
$posts=array();
while($row=$DB->fetch_array($rs)){
	
	$id=$row['id'];
	$posts[$id]=$row;
	
}

if(empty($posts)) return;
?>
<ul class="thumbnails" style="margin-bottom: 0">
<?php 


foreach ($posts as $id=>$post){

if($field){
$fieldstr=$post[$field];
//处理时间
if(strlen($fieldstr)==10 && str_is_int($fieldstr))
	$fieldstr=date('Y-m-d',$fieldstr);	
}

$_channel_id=$post['channel_id'];
?>
  <li class="span12">
    <a class="thumbnail" href="<?php echo url(R.$G['channels'][$_channel_id]['link'].$post['link'])?>"><img alt="<?php echo html(xstr($post['title'],$titlenum,true))?>" src="<?php echo R,$post['thumb']?>" style="width: 100%; height: <?php echo $height?>;" /></a>
  </li>
<?php 
}?>  
</ul>


