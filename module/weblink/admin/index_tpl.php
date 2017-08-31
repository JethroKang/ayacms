<ul class="nav nav-tabs">
	<li class="active">
		<a href="javascript:void(0)"
			onclick="location=this.href">编辑</a>
	</li>
</ul>

<h3></h3>
<div class="col-md-12">

	<form class="form-horizontal" role="form" id="form"
		action="<?php echo furl(RMA.'?mod='.$mod.'&act='.$act.'&id='.$id)?>"
		method="post" onsubmit="<?php echo ke_set()?>ajaxp(this.id);return false;">

		<div class="form-group">
			<label class="col-sm-2 control-label">链接地址</label>
			<div class="col-sm-8">
			
<input type="text" class="form-control" 
					name="link" placeholder=""
					value="<?php echo $G['channels'][$id]['link']=='-null-'?'':$G['channels'][$id]['link']?>">
				
				<p class="help-block">留空,代表无链接</p>
			</div>
		</div>
  
  
  <div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="reset" class="btn default">重置</button>
				<button type="submit" class="btn blue">提交</button>
			</div>
		</div>


	</form>
</div>

<script type="text/javascript">

</script>
