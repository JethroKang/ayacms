<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-<?php echo $id=rand(100000,999999)?>"
				data-toggle="tab" >Section 1</a>
		</li>
		<li class="">
			<a href="#panel-<?php echo $id2=rand(100000,999999)?>"
				data-toggle="tab" >Section 2</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="panel-<?php echo $id?>">
			<p >I'm in Section 1.</p>
		</div>
		<div class="tab-pane" id="panel-<?php echo $id2?>">
			<p >Howdy, I'm in Section 2.</p>
		</div>
	</div>
</div>