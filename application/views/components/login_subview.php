<div class="modal-header">
	<h3><?php echo $login; ?></h3>
</div>
<div class="modal-body">
<?php echo validation_errors(); ?>
<?php echo form_open();?>
<table class="table">
	<tr>
		<td><?php echo $email; ?></td>
		<td><?php echo form_input('email'); ?></td>
	</tr>
	<tr>
		<td><?php echo $username; ?></td>
		<td><?php echo form_input('username'); ?></td>
	</tr>
	<tr>
		<td><?php echo $password; ?></td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>