<div class="content-unit">
<?php echo form_open('/problem/create'); ?>
<table>
	<tr>
		<td>
			<?php echo form_input('title'); ?>
		</td>
	</tr>
	<tr>
		<td>
			
			<?php 
				$data = array(
	              'name'        => 'body',
	              'id'          => 'body',
	              'cols' => 100,
	            );
			
				echo form_textarea($data) 
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo form_input('score') ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_submit('submit', '发表', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>