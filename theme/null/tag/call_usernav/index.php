<?php
$_menus = do_apply ( 'user_menus' );
$menus = array ();
foreach ( $_menus as $v ) {
	$menus [$v [0]] = array (
			$v [1],
			$v [2] 
	);
}

if (empty ( $menus ))
	return;
?>

<div class="list-group">
<?php foreach ($menus as $k=>$v){?>
	<a href="<?php echo url($v[1])?>"
		class="list-group-item <?php echo $k==ACTION?'active':''?>"> <?php echo html($v[0])?> </a>
	<?php }?>
</div>