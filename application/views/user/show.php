<div class="content-unit">
	<div class="pull-right" style="text-align:center;">
      <a href="<?php echo anchor("/user/show/$user->id", $user->username); ?>">
      	<img src="<?php echo $user->userInfo->avatar; ?>" 
      		style="width:120px;height:120px;">
      </a>
    </div>

	<ul class="userinfo">
		<li>
			<label>ID</label>
			<span><?php echo $user->id; ?></span>
		</li>
		<li>
			<label>用户名</label>
			<span><?php echo $user->username; ?></span>
		</li>
		<li>
			<label>邮箱</label>
			<span><?php echo $user->email; ?></span>
		</li>
		<li>
			<label>注册时间</label>
			<span><?php echo $user->userInfo->created_on; ?></span>
		</li>
		<li>
			<label>学校</label>
			<span><?php echo $user->userInfo->school; ?></span>
		</li>
		<li>
			<label>标签</label>
			<span><?php echo $user->userInfo->tagline; ?></span>
		</li>
	</ul>	
</div>