<?php
$channels=&$G['channels'];

$pid=get_homeid();
if($pid<1)
	return;

$p=array ();
foreach($channels as $k=>$v){
	($v['pid']==$pid or empty($v['hide']))&&$p[$v['pid']][]=$k;
}

?>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
				data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="#" class="brand" style="display: none">Title</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li <?php echo HOME?'class="active"':''?>>
						<a href="<?php echo url(R)?>">首页</a>
					</li>
          <?php
										foreach((array)$p[$pid] as $id){
											
											$class=CID==$id?' active':'';
											
											if(is_array($p[$id])){
												
												?>
            <li class="dropdown <?php echo $class?>">
						<a data-toggle="dropdown" class="dropdown-toggle"
							href="<?php echo curl($channels[$id]['link'])?>"><?php echo $channels[$id]['name']?> <b
								class="caret"></b>
						</a>
						<ul class="dropdown-menu"> 
             <?php
												foreach($p[$id] as $id2){
													?>
             <li>
								<a href="<?php echo curl($channels[$id2]['link'])?>"><?php echo $channels[$id2]['name']?></a>
							</li>
              <?php
												}
												?>
              </ul>
					</li>
              <?php } else{?>
              <li class="<?php echo $class?>">
						<a href="<?php echo curl($channels[$id]['link'])?>"><?php echo $channels[$id]['name']?> </a>
					</li>
             
            <?php }}?>
              
          </ul>

				<form class="navbar-form pull-right" id="<?echo strrand()?>"
					method="post" name="search" action="<?php echo url(R.'search/')?>"
					onsubmit="ajaxp(this.id);return false;">
					<input type="text" class="span9" name="q" placeholder="关键字">
					<button type="submit" class="btn">搜</button>
				</form>

			</div>
		</div>
	</div>
</div>