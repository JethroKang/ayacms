<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo html($C['sys_webname'])?> <?php echo $class?></title>
<link href="<?php echo R?>static/bootstrap/2.3.2/css/bootstrap.min.css"
	rel="stylesheet">
<!--[if lt IE 9]>
    <script src="<?php echo R?>static/js/html5shiv.js"></script>
    <script src="<?php echo R?>static/js/respond.min.js"></script>
  <![endif]-->

</head>

<body>
<div class="container">
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />

	<div class="row">
		<div class="span2"></div>
		<div class="span8">
			<div class="alert alert-<?php echo $class?>">
				<strong><?php echo html($msg)?></strong>
  <?php
		if (! empty ( $url )) {
			?><span id="jumpTo">3</span>秒后跳转...
<?php
		
} else if (! empty ( $refresh )) {
			?><span id="jumpTo">3</span>秒后刷新...
	
	<?php
		}
		?>
</div>
		</div>
		<div class="span2"></div>
	</div>


	<ul class="pager">
		<li>
			<a href="javascript:history.go(-1);">&larr; 返回</a>
		</li>
		<li>
			<a href="<?php echo R?>"><?php echo $C['sys_webname']?></a>
		</li>
	</ul>

</div>

<script type="text/javascript">
function countDown(id,secs,surl){

	if(!surl){
		var url=location.href;
		pos=url.indexOf("#");
		surl=url.substring(0,pos);
	}
	
	 var jumpTo = document.getElementById(id);
	 
	 if(--secs>-1 && jumpTo){ 
	 jumpTo.innerHTML=secs+1;     
	     setTimeout("countDown('"+id+"',"+secs+",'"+surl+"')",1000);     
	     }     
	 else{       
	     location.href=surl;     
	     }     
	 } 

<?php
		if (! empty ( $url )) {
			?>
		countDown('jumpTo',3,'<?php echo $url?>');
		
		<?php

		}else if(! empty ( $refresh )) {
			?>
		countDown('jumpTo',3,'');
		
		<?php
		}
		?>
</script>

<script src="<?php echo R?>static/js/jquery-1.11.0.min.js"
		type="text/javascript"></script>
	<script src="<?php echo R?>static/bootstrap/2.3.2/js/bootstrap.min.js"
		type="text/javascript"></script>
</body>
</html>
