<div class="modal-header">
	<h3>用户注册</h3>
	<p>欢迎注册6bey学堂,Happy everyday!</p>
</div>
<div class="modal-body">
<?php echo validation_errors(); ?>
<?php echo form_open();?>
<table class="table">
	<tr>
		<td>邮箱</td>
		<td><?php echo form_input('email'); ?></td>
	</tr>
	<tr>
		<td>昵称</td>
		<td><?php echo form_input('username'); ?></td>
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
		<td><span style="padding-right:20px">填写完信息请点击提交</span><?php echo form_submit('submit', '提交', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>
