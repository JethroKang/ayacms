<div class="col-md-12">
	<form class="form-horizontal" role="form" id="<?php echo strrand()?>"
		action="<?php echo furl(RMA)?>" method="post"
		onsubmit="ajaxp(this.id);return false;">

		<div class="form-group">
			<label class="col-md-2 control-label">开发模式</label>
			<div class="col-md-5">
				<div class="radio-list">
					<label class="radio-inline">
						<input name="sys_debug" type="radio" value="1"
							<?php echo $C['sys_debug']?'checked':''?> />
						启用
					</label>
					<label class="radio-inline">
						<input name="sys_debug" type="radio" value="0"
							<?php echo $C['sys_debug']?'':'checked'?> />
						关闭
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">伪静态</label>
			<div class="col-md-5">
				<div class="radio-list">
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_rewrite']=='1'?'checked="checked"':''?>
							value="1" name="sys_rewrite" />
						启用
					</label>
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_rewrite']=='0'?'checked="checked"':''?>
							value="0" name="sys_rewrite" />
						关闭
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">压缩js,CSS文件</label>
			<div class="col-md-5">
				<div class="radio-list">
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_compress']=='1'?'checked="checked"':''?>
							value="1" name="sys_compress" />
						启用
					</label>
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_compress']=='0'?'checked="checked"':''?>
							value="0" name="sys_compress" />
						关闭
					</label>
				</div>
                                    
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">显示运行时间</label>
			<div class="col-md-5">
				<div class="radio-list">
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_count']=='1'?'checked="checked"':''?>
							value="1" name="sys_count" />
						启用
					</label>
					<label class="radio-inline">
						<input type="radio"
							<?php echo $C['sys_count']=='0'?'checked="checked"':''?>
							value="0" name="sys_count" />
						关闭
					</label>
				</div>
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