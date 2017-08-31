<?php

$data=strlen($data)>0?unserialize($data):array ();

$html='
	<div class="form-group">
			<label class="col-sm-2 control-label">'.html($tab['title']).'</label>
			<div class="col-sm-5">
				'.init_uploads('tab_'.$id,'jpg,jpge,gif,png',$data).'
						<p class="help-block">允许上传数量: '.$tab['conf'][0].' -'.$tab['conf'][1].'</p>
			</div>
		</div>';

echo $html;