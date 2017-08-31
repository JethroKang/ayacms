<?php
$data=(string)$data;
$html='
	<div class="form-group">
    <label for="tab_%d" class="col-sm-2 control-label">%s</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="tab_%d" name="tab_%d" placeholder="%s" value="%s" style="width:100px">
	  <p class="help-block"></p>
    </div>
  </div>';

echo sprintf($html,$tab['id'],$tab['title'],$tab['id'],$tab['id'],$tab['info'],$data);