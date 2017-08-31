<div class="control-group">
	<label class="control-label">链接</label>
	<div class="controls">
		<textarea id="_con" name="con" cols="" rows="8"
			class="input-block-level" placeholder="百度|http://www.baidu.com;每行一个"><?php echo html($con)?></textarea>
	</div>
</div>

<div class="control-group">
	<label class="control-label"></label>
	<div class="controls">
		<input type="text" class="span3" id="_title" placeholder="标题" value="" />
		<input type="text" class="span7" id="_url" placeholder=""
			value="http://" />
		<button type="button" class="btn"
			onclick="_add_con($('#_title').val(),$('#_url').val())">添加</button>

	</div>
</div>

<div class="control-group">
	<label class="control-label"></label>
	<div class="controls">
		<select class="form-control" onchange="_add_text(this.value)">
			<option value="">添加栏目..</option>
	<?php
	foreach($G['channels'] as $k=>$v){
		?>
<option
				value="<?php echo html($v['name'])?>|<?php echo curl($v['link'])?>"><?php echo html($v['name'])?></option>
				
<?php
	}
	?>
</select>
	</div>
</div>

<div class="control-group">
	<label class="control-label">文字方向</label>
	<div class="controls">


		<label class="radio inline">
			<input name="class" type="radio" value=""
				<?php echo empty($class)?'checked':''?> />
			默认
		</label>
		<label class="radio inline">
			<input name="class" type="radio" value="text-left"
				<?php echo $class=='text-left'?'checked':''?> />
			左
		</label>
		<label class="radio inline">
			<input name="class" type="radio" value="text-center"
				<?php echo $class=='text-center'?'checked':''?> />
			中
		</label>

		<label class="radio inline">
			<input name="class" type="radio" value="text-right"
				<?php echo $class=='text-right'?'checked':''?> />
			右
		</label>
	</div>
</div>

<script type="text/javascript">
function _add_con(a,b){
if(a=='' || b=='') return;
_add_text(a+'|'+b);	
}

function _add_text(str){
	if(str=='') return;
	var con=$('#_con').val();
	if(con.length>0){
	var lstr=con.charAt(con.length - 1);
	if(lstr!="\n") con+="\n";
	}
	con+=str+"\n";
	$('#_con').val(con);
}
</script>


