<div class="content-unit">
<?php 
	$hidden = array('id' => $topic->id);
	echo form_open('/topic/update', '', $hidden); 
?>
<table>
	<tr>
		<td>
			<?php 
				$data = array(
	              'name'        => 'title',
	              'id'          => 'title',
	              'value'       => $topic->title,
	              'cols' => 100,
	            );
				echo form_input($data); 
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				$data = array(
	              'name'        => 'body',
	              'id'          => 'body',
	              'value'       => $topic->body,
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