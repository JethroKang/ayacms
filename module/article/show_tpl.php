<h2><?php echo html($post['title'])?></h2>

<ul class="inline">
	<li>
		发布时间:
		<span class="text-info"><?php echo date('Y-m-d',$post['post_time'])?></span>
	</li>
	<li>
		提交:
		<span class="text-info"><?php echo html($post['name'])?></span>
	</li>
</ul>

<div class="clearfix"></div>


<?php echo tab::tpls($channel['tabs']['diss'],$channel['tabs']['tpls'],'show.php',$post)?>
<hr />
<p>
  <?php echo $post['contents'][$eid]?>
</p>

<!-- 分页菜单 -->

<p>
<ol>
  <?php
		
		foreach($post['pagetitles'] as $k=>$v){
			?>
  <li>
		<a href="<?php echo $page_urls[$k]?>"
			class="<?php echo $k==$eid?'text-primary':'text-muted'?>"><?php echo html($v)?></a>
	</li>
  <?php
		}
		?>
</ol>
</p>

<p>
Tags:<?php echo tag::show($post['keywords'])?>
</p>


<!-- 上下文 -->
<div class="clearfix"></div>

<div class="mod_up">上:
    <?php
				
				if(!empty($tup)){
					?>
    <a href="<?php echo $tup['url']?>">
    <?php echo html($tup['title'])?>
    </a>
    <?php
				}else{
					?>
    无
    <?php
				}
				?>
  </div>
<div class="mod_down">下:
    <?php
				
				if(!empty($tdown)){
					?>
    <a href="<?php echo $tdown['url']?>">
    <?php echo html($tdown['title'])?>
    </a>
    <?php
				}else{
					?>
    无
    <?php
				}
				?>
</div>


