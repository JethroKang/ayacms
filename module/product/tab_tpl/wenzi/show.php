<?php
if(!empty($first)){
	?>
<ul class="unstyled">
<?php
}
?>
  <li>
		<?php  echo $tab['title']?> <span class="text-info"><?php echo html($data)?> </span>
	</li>
  
<?php
if(!empty($last)){
	?>
</ul>
<?php
}