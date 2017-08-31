<legend>样式</legend>

<div class="control-group">
	<label class="control-label">嵌入效果</label>
	<div class="controls">


		<label class="radio inline">
			<input name="_well" type="radio" value="0"
				<?php echo empty($_well)?'checked':''?> />
			不使用
		</label>
		<label class="radio inline">
			<input name="_well" type="radio" value="well"
				<?php echo $_well=='well'?'checked':''?> />
			default
		</label>
		<label class="radio inline">
			<input name="_well" type="radio" value="well well-lg"
				<?php echo $_well=='well well-lg'?'checked':''?> />
			lg
		</label>
		<label class="radio inline">
			<input name="_well" type="radio" value="well well_sm"
				<?php echo $_well=='well well_sm'?'checked':''?> />
			sm
		</label>


	</div>
</div>
<div class="control-group">
	<label class="control-label">CSS</label>
	<div class="controls">
		<div class="span12">
			<textarea id="tag_css" name="tag_css" cols="" rows="3"
				class="input-block-level"><?php echo html($tag_css)?></textarea>
		</div>
		<div class="span11">
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' height: px;');">高</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' width: px;');">宽</button>

			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border-radius: 4px;');">圆角</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' background-color: #f5f5f5;');">背景色</button>

			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border: 1px solid #e3e3e3;');">边框</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border-top: 1px solid #e3e3e3;');">边框↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border-right: 1px solid #e3e3e3;');">边框→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border-bottom: 1px solid #e3e3e3;');">边框↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' border-left: 1px solid #e3e3e3;');">边框←</button>

			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' padding:  px;');">内边距</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' padding-top:  px;');">内边距↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' padding-right:  px;');">内边距→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' padding-bottom:  px;');">内边距↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' padding-left:  px;');">内边距←</button>
			
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' margin:  px;');">外边距</button>	
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' margin-top:  px;');">外边距↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' margin-right:  px;');">外边距→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' margin-bottom:  px;');">外边距↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_css').val($('#tag_css').val()+' margin-left:  px;');">外边距←</button>
			<button type="button" class="btn btn-mini btn-danger"
				onclick="$('#tag_css').val('');">清空</button>
		</div>

	</div>
</div>

<legend>面版</legend>

<div class="control-group">
	<label class="control-label">面板颜色</label>
	<div class="controls">
		<label class="radio inline">
			<input name="_panel" type="radio" value="0"
				<?php echo empty($_panel)?'checked':''?> onclick="_panel_show(0)" />
			不使用
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="default"
				<?php echo $_panel=='default'?'checked':''?>
				onclick="_panel_show(1)" />
			<span class="text-default">default</span>
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="primary"
				<?php echo $_panel=='primary'?'checked':''?>
				onclick="_panel_show(1)" />
			<span class="text-primary">primary</span>
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="success"
				<?php echo $_panel=='success'?'checked':''?>
				onclick="_panel_show(1)" />
			<span class="text-success">success</span>
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="info"
				<?php echo $_panel=='info'?'checked':''?> onclick="_panel_show(1)" />
			<span class="text-info">info</span>
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="warning"
				<?php echo $_panel=='warning'?'checked':''?>
				onclick="_panel_show(1)" />
			<span class="text-warning">warning</span>
		</label>
		<label class="radio inline">
			<input name="_panel" type="radio" value="danger"
				<?php echo $_panel=='danger'?'checked':''?> onclick="_panel_show(1)" />
			<span class="text-danger">danger</span>
		</label>


	</div>
</div>

<div class="control-group" id="panel_title">
	<label class="control-label">标题/链接</label>
	<div class="controls">

		<input type="text" class="span3" id="_paneltitle" name="_paneltitle"
			placeholder="选填" value="<?php echo html($_paneltitle)?>" />
		<input type="text" class="span5" id="_panellink" name="_panellink"
			placeholder="选填" value="<?php echo html($_panellink)?>" />

		<select onchange="_add_panel(this.value)" class="span3">
			<option value="">快捷选择..</option>
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

<div class="control-group" id="panel_css">
	<label class="control-label">CSS</label>
	<div class="controls">
		<div class="span12">
			<textarea id="tag_panel_css" name="tag_panel_css" cols="" rows="3"
				class="input-block-level"><?php echo html($tag_panel_css)?></textarea>
		</div>
		<div class="span11">
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' height: px;');">高</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' width: px;');">宽</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border-radius: 4px;');">圆角</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' background-color: #f5f5f5;');">背景色</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border: 1px solid #e3e3e3;');">边框</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border-top: 1px solid #e3e3e3;');">边框↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border-right: 1px solid #e3e3e3;');">边框→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border-bottom: 1px solid #e3e3e3;');">边框↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' border-left: 1px solid #e3e3e3;');">边框←</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' padding:  px;');">内边距</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' padding-top:  px;');">内边距↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' padding-right:  px;');">内边距→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' padding-bottom:  px;');">内边距↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' padding-left:  px;');">内边距←</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' margin:  px;');">外边距</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' margin-top:  px;');">外边距↑</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' margin-right:  px;');">外边距→</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' margin-bottom:  px;');">外边距↓</button>
			<button type="button" class="btn btn-mini"
				onclick="$('#tag_panel_css').val($('#tag_panel_css').val()+' margin-left:  px;');">外边距←</button>
			<button type="button" class="btn btn-mini btn-danger"
				onclick="$('#tag_panel_css').val('');">清空</button>

		</div>

	</div>
</div>

<script>

function _add_panel(c){
	if(c=='') return;
	var ch =c.split("|");
$('#_paneltitle').val(ch[0]);
$('#_panellink').val(ch[1]);
	
}


	
				function _panel_show(panel){
					
if(panel){
$('#panel_title').show();
$('#panel_css').show();
}else{
	$('#panel_title').hide();
	$('#panel_css').hide();
}
}

				_panel_show(<?php echo empty($_panel)?0:1?>);
  </script>
