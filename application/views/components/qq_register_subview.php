<div class="modal-header">
	<h3>Log in</h3>
	<p>Please log in using your credentials</p>
</div>
<div class="modal-body">
<?php echo validation_errors(); ?>
<?php 
	$hidden = array('third_user_id' => $third_user_id
		, 'access_token' => $access_token, 'avatar' => $avatar);
	echo form_open('qq/register', $hidden);
?>
<table class="table">
	<tr>
		<td>用户昵称</td>
		<td>
			<?php echo form_input($data = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => $username,
            )); ?></td>
	</tr>
	<tr>
		<td>密码</td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td>密码确认</td>
		<td><?php echo form_password('password_confirmation'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', '确认注册', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>