<div class="content-unit">
<?php echo form_open('/topic/update'); ?>
<table>
	<tr>
		<td>
			<?php 
				$data = array(
	              'name'        => 'title',
	              'id'          => 'title',
	              'value'       => $topic->title,
	            );
				echo form_input($data); 
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo form_textarea('body') ?>
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
		<td><?php echo form_submit('submit', '发表', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>