<div class="content-unit">
<?php 
	$hidden = array('id' => $reply->id);
	echo form_open('/reply/update', '', $hidden); 
?>
<table>
	<tr>
		<td>
			<?php 
				$data = array(
	              'name'        => 'body',
	              'id'          => 'body',
	              'value'       => $reply->body,
	            );
				echo form_textarea($data); 
			?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_submit('submit', '提交修改', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>