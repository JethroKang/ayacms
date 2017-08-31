<div class="carousel slide"
	id="carousel-<?php echo $id=rand(100000,999999)?>">
	<ol class="carousel-indicators">
		<li data-slide-to="0" data-target="#carousel-<?php echo $id?>"
			class="active"></li>
		<li data-slide-to="1" data-target="#carousel-<?php echo $id?>"
			class=""></li>
		<li data-slide-to="2" data-target="#carousel-<?php echo $id?>"
			class=""></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<img alt="" src="<?php echo url(R).$img_1?>">
			<div class="carousel-caption">
				<h4><?php echo html($title1)?></h4>
				<p><?php echo html($con1)?></p>
			</div>
		</div>
		<div class="item">
			<img alt="" src="<?php echo url(R).$img_2?>?>">
			<div class="carousel-caption">
				<h4><?php echo html($title2)?></h4>
				<p><?php echo html($con2)?></p>
			</div>
		</div>
		<div class="item">
			<img alt="" src="<?php echo url(R).$img_3?>">
			<div class="carousel-caption">
				<h4><?php echo html($title3)?></h4>
				<p><?php echo html($con3)?></p>
			</div>
		</div>
	</div>

  <a class="left carousel-control" href="#carousel-<?php echo $id?>" data-slide="prev">&lsaquo;</a>
  <a class="right carousel-control" href="#carousel-<?php echo $id?>" data-slide="next">&rsaquo;</a>
</div>
