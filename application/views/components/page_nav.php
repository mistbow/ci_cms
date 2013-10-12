<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</a>
          	<a class="brand" href="<?php echo base_url(); ?>">
          		<?php echo $site_name; ?>
          	</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
            	<li class="active"><?php echo anchor('www.6bey.com', '首页'); ?></li>
	        	<li class="active"><?php echo anchor('topic/index', '讨论区'); ?></li>
				<li class="active"><?php echo anchor('ask/index', '问答社区'); ?></li>
				<li class="active"><?php echo anchor('exercise/index', '师兄笔记'); ?></li>
				<li class="active"><?php echo anchor('problem/index', '习题库'); ?></li>
            </ul>
            <?php if(is_array($this->session->userdata) 
				&& isset($this->session->userdata['loggedin']) 
				&& $this->session->userdata['loggedin']) :?>
            <ul class="nav pull-right">
            	<li class="dropdown">
                    <a class="dropdown-toggle" href="http://www.6bey.com//active/message">
                          <span class="glyphicon glyphicon-envelope"></span> 站内信
                          <span class="badge badge-info msg_num"></span>
                        </a>
                  </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">你好,
                   <?php echo $this -> session -> userdata['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/user/show">个人资料</a></li>
                  <li><a href="/user/avatar/">修改头像</a></li>
                  <li><a href="/user/emailsetting/">邮件通知选项</a></li>
                  <li><a href="/user/weibo/">绑定新浪微博</a></li>
                  <li class="divider"></li>
                  <li><a href="/user/logout/">退出</a></li>
                 </ul>
              </li>
            </ul>
            <?php else : ?>
			<ul class="nav pull-right">
				<li><?php echo anchor('user/register', '注册'); ?></li>
				<li><?php echo anchor('qq/login', '登录'); ?></li>
			</ul>
			<?php endif; ?>
                      
          </div>
        </div>
      </div>
</div><!-- end navbar -->