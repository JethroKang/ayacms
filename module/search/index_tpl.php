	<table class="table">
		<thead>
			<tr>
				<th>标题</th>
				<th>位置</th>
				<th>提交时间</th>
			</tr>
		
        </thead>
        <tbody>
		<?php
		
foreach ( $posts as $k => $v ) {
			?><tr>
			<td>
				<h5 style="margin: 0">
					<a href="<?php echo $v['url']?>"> <?php echo html($v['title'])?></a>
				</h5>
			</td>
			<td style="width: 150px">
				<?php echo html($G['channels'][$v['channel_id']]['name'])?>
			</td>
			<td style="width: 100px">
				<small><?php echo date('Y-m-d',$v['post_time'])?> </small>
			</td>
		</tr>
			<?php
		
}
		?>
</tbody>
	</table>
<?php echo $page?>
