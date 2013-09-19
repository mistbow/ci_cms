<div class="content-unit">
<?php echo form_open('/topic/create'); ?>
<table>
	<tr>
		<td>
			<?php echo form_input('title'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo form_textarea('content') ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_submit('submit', '发表', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>