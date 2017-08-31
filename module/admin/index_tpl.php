
<form class="form-horizontal">

	<div class="win_w">


		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">主平台版本</label>
			<div class="col-sm-5">
				<p class="form-control-static">AyaCMS <?php echo VER?></p>

			</div>
		</div>


		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">系统当前时间</label>
			<div class="col-sm-5">

				<p class="form-control-static"><?php echo $arr[0]?></p>

			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">服务器操作系统</label>
			<div class="col-sm-5">

				<p class="form-control-static"><?php echo $arr[1]?></p>

			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">服务器解译引擎</label>
			<div class="col-md-5">
				<p class="form-control-static"><?php echo html(xstr($arr[2],80,true))?></p>

			</div>
		</div>


		<div class="form-group">
			<label class="col-md-2 control-label">PHP版本</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[3]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">PHP运行方式</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[4]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Mysql版本</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[5]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">磁盘剩余空间</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[6]?></p>


			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">程序最多使用的内存量</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[7]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">POST最大字节数</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[8]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">允许最大上传文件</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[9]?></p>


			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">程序最长运行时间</label>
			<div class="col-md-5">

				<p class="form-control-static"><?php echo $arr[10]?>s</p>


			</div>
		</div>
	</div>
</form>