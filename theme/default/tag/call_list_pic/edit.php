
<div class="control-group">
	<label class="control-label">栏目ID</label>
	<div class="controls">
		<select name="channel_id" class="form-control">
			<option value=0 <?php echo !$channel_id?'selected="selected"':''?>>不限</option>
			<option value=-1
				<?php echo -1==$channel_id?'selected="selected"':''?>>当前栏目(动态)</option>
	
	<?php
	
	foreach($G['channels'] as $cid=>$v){
		
		if(!isset($C['fields'][$v['formod']]))
			continue;
		
		?>
<option value=<?php echo $cid?>
				<?php echo $cid==$channel_id?'selected="selected"':''?>><?php echo $cid; echo ' (',html($v['name']),')'?></option>
<?php
	}
	
	?>
	</select>
	</div>
</div>

<div class="control-group">
	<label class="control-label">数据表</label>
	<div class="controls">
		<select name="tab" class="form-control"
			onchange="__open_fields(this.value)">
<?php

foreach($C['fields'] as $_tab=>$_){
	?>
<option value="<?php echo $_tab?>"
				<?php echo $_tab==$tab?'selected="selected"':''?>><?php echo html($_tab); $name=modname($_tab); if($name) echo ' (',html($name),')'?></option>
<?php
}

?>
      </select>
	</div>
</div>


<div class="control-group">
	<label class="control-label">图片高度</label>
	<div class="controls">

		<input type="text" class="form-control" name="listnum"
			placeholder="选填" value="<?php echo $height?>">

	</div>
</div>

<div class="control-group" style="display: none">
	<label class="control-label">标题字数</label>
	<div class="controls">
		<input type="text" class="form-control" name="titlenum"
			placeholder="一个汉字代表2个" value="<?php echo $titlenum?$titlenum:26?>">
	</div>
</div>
<div class="control-group">
	<label class="control-label">列表数量</label>
	<div class="controls">
		<input type="text" class="form-control" name="listnum"
			placeholder="不得少于1" value="<?php echo $listnum?$listnum:4?>">
	</div>
</div>


<script type=text/javascript>

var __field = new Array();

<?php
foreach($C['fields'] as $_tab=>$_field){
	?>
__field['<?php echo $_tab?>']='<?php
	foreach($_field as $fs){
		?><option value="<?php echo $fs?>" <?php echo $field==$fs?'selected="selected"':''?>><?php echo $fs?></option><?php
	}
	?>';

<?php
}

?>

function __open_fields(tab){
	if(!tab) return;
	document.getElementById('count_field').innerHTML='<option value="">无</option>'+__field[tab];
}

__open_fields('<?php echo empty($tab)?array_shift(array_keys($C['fields'])):$tab?>');


</script>



