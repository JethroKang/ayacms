<h2><?php echo html($post['title'])?></h2>

<?php foreach($post['pics'] as $pic){?>
<p>
		<a href="<?php echo R.$pic?>" class="thumbnail">
			<img data-src="holder.js/100%x200" alt="<?php echo html($post['title'])?>"
				src="<?php echo R.$pic?>"
				style="width: 100%;">
		</a>
	</p>
<?php 
}?>


<?php echo tab::tpls($channel['tabs']['diss'],$channel['tabs']['tpls'],'show.php',$post)?>
<div class="clearfix"></div>

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
			class="<?php echo $k==$eid?'text-success':''?>"><?php echo html($v)?></a>
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


