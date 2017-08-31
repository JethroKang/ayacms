<?php 
$data=strlen($data)>0?unserialize($data):array ();

?>
	<div class="control-group">
			<label class="control-label"><?php  echo $tab['title']?></label>
			<div class="controls">
				<?php echo init_uploads('tab_'.$id,'jpg,jpge,gif,png',$data) ?>
						<p class="help-block">允许上传数量: <?php echo $tab['conf'][0].' - '.$tab['conf'][1]?></p>
			</div>
		</div>
		