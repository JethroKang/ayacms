<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo tag('title')?></title>
<meta name="Description" content="<?php echo tag('description')?>">
<meta name="Keywords" content="<?php echo tag('keywords')?>">
<?php echo add_cssfile()?>
<?php if(false){?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="style/index.css" rel="stylesheet">
<?php }?>
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
<script type="text/javascript">
var ROOTPATH="<?=R?>";
var WEBURL="<?=url(R)?>";
var THEMEFILE="<?=THEMEFILE?>";
</script>
<?php echo add_jsfile()?>
<script type="text/javascript">
$(function(){
<?php echo do_apply('jscode','string')?>
})
</script>
<?php echo do_apply('head','string')?>
</head>

<body>
<?php echo do_apply('header','string')?>

<div class="container">
<?php echo frame('xxx')?>
</div>

<?php echo do_apply('footer','string')?> 
<?php echo do_apply('foot','string')?>
</body>
</html>
