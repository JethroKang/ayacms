<?php
$cats=$channel['cats'];
$actives=array ();
$allurls=array ();

$actives[0][P2]=' btn-mini btn-inverse';
$actives[1][P3]=' btn-mini btn-inverse';
$actives[2][P4]=' btn-mini btn-inverse';

$allurls[0]=url(R.CLINK.'1/0/'.P3.'/'.P4.'/');
$allurls[1]=url(R.CLINK.'1/'.P2.'/0/'.P4.'/');
$allurls[2]=url(R.CLINK.'1/'.P2.'/'.P3.'/0/');

foreach($cats as $k=>$v){
	if(empty($v['name'])||empty($v['subnames']))
		continue;
	
	?>
<p>
<div class="row-fluid">
	<div class="span2 text-right">
		<strong><?php echo $v['name']?></strong>
	</div>
	<div class="span10">

		<a class="btn btn-mini <?php echo $actives[$k][0]?> btn-primary"
			href="<?php echo $allurls[$k]?>" role="button">全部</a>
	
	<?php
	foreach($v['subnames'] as $k2=>$v2){
		if(empty($v2))
			continue;
		if($k==0)
			$url=url(R.CLINK.'1/'.($k2+1).'/'.P3.'/'.P4.'/');
		else if($k==1)
			$url=url(R.CLINK.'1/'.P2.'/'.($k2+1).'/'.P4.'/');
		else
			$url=url(R.CLINK.'1/'.P2.'/'.P3.'/'.($k2+1).'/');
		?>			
	
		<a class="btn btn-mini <?php echo $actives[$k][$k2+1]?>  btn-xs"
			href="<?php echo $url?>" role="button"><?php echo html($v2)?></a>
	<?php
	}
	?>
</div>
</div>

</p>
<?php
}
?>
<style>
h5.list_title {
	margin: 0;
	font-weight: normal;
}
</style>

<table class="table">
	<thead>
		<tr>
			<th>标题</th>
			<th>提交时间</th>
		</tr>

	</thead>
	<tbody>
		<?php
		
		foreach($posts as $k=>$v){
			?><tr>
			<td>
				<h5 class="list_title">
					<a href="<?php echo $v['url']?>"> <?php echo html($v['title'])?></a>
				</h5>
			</td>
			<td style="width: 100px">
				<small><?php echo date('Y-m-d',$v['post_time'])?> </small>
			</td>
		</tr>
			<?php
		}
		?>
</tbody>
</table>
<?php echo $page?>

<div class="clearfix"></div>
<script type="text/javascript">
</script>