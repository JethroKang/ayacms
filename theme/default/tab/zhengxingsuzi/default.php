<?php
if (! empty ( $first )) {
	?>
<ul class="list-unstyled">
<?php
}
?>

<li>
		<span class="text-info"><?php  echo $tab['title']?></span> <?php echo html($data)?> </li>

<?php
if (! empty ( $last )) {
	?>
</ul>
<?php
}