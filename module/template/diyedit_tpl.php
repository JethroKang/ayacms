<div id="win_close" style="display: none">
	<span>
		<a href="javascript:;" class="flbc"
			onclick="hidewin();<?php
			if($is_new){
				echo ' drag.removeBlock(\'',$tag_key,'\');';
			}
			?>return false;"
			title="关闭">关闭</a>
	</span>
</div>



<ul id="diyTab" class="nav nav-tabs">
	<li>
		<a onclick="$(this).tab('show');$('#diy_button').show();return false;"
			href="#diybox_0" data-toggle="tab">设置</a>
	</li>

	<li>
		<a onclick="$(this).tab('show');$('#diy_button').hide();return false;"
			href="#diybox_1" data-toggle="tab">示例</a>
	</li>
	<span class="icon-info-sign"
		onclick="$('#tag_info').toggle();"></span>
	<span id="tag_info" style="display: none">Name: "<?php echo html($tag['name'])?>"  Path: "<?php echo $tag['path']?>" Key: "<?php echo $tag_key?>"</span>
	
</ul>



<div class="tab-content">
	<div class="tab-pane active" id="diybox_0">

		<form class="form-horizontal" id="<?php echo $tag['form_id']?>"
			name="<?php echo $tag['form_id']?>" enctype="multipart/form-data"
			method="post" autocomplete="off"
			action="<?php echo R?>index.php?template/diyedit/<?php echo $is_global?('&tag_name='.$tag_name):''?>&classname=<?php echo $tag_name?>&eleid=<?php echo $tag_key?>&themefile=<?php echo $themefile?>&themename=<?php echo $themename?>"
			onsubmit="ke_set('<?php echo $tag['ke_id']?>');ajaxp(this.id);return false;">

			<div class="win_w">	
	
<?php echo $html?>

<?php include ABSPATH.'static/in_diyedit.php';?>
		</div>
			<input type="hidden" name="tag_name" value="<?php echo $tag_name?>" />
			<input type="hidden" name="eleid" value="<?php echo $tag_key?>" />

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset" class="btn btn-default">重置</button>
		</div>
	</div>


		</form>
	</div>


	<div class="tab-pane" id="diybox_1">

		<div class="win_w">

			<div class="bs-docs-example">

        <?php echo is_array($tag['code'])?implode('', $tag['code']):'无'?>
        </div>
        
        <?php
								
								if(is_array($tag['code'])&&$tag['type']=='css'){
									
									?>
        <div class="prettyprint">
					<?php $_code= html(trim($tag['code'][1]," \n\r")); echo preg_replace("/\r?\n/", '<br />',$_code);?>
				</div>
			<?php
								}
								?>
        
        
		</div>
	</div>
</div>



<script type="text/javascript">

$("#diybox_0").removeClass("show");												
$('#diyTab a:first').tab('show');

document.getElementById('layer_title').innerHTML=document.getElementById('win_close').innerHTML;

</script>
