<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	  <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $site_name; ?></a>
		</div> <!-- navbar-header -->

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">学习社区</a></li>
				<li class="active"><a href="#">习题精讲</a></li>
				<li class="active"><a href="#">问答社区</a></li>
				<li class="active"><a href="#">大题库</a></li>
				
			</ul>
		
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" href="http://www.6bey.com/active/message">
      					<span class="glyphicon glyphicon-envelope"></span> 站内信
      					<span class="badge badge-info msg_num"></span>
      				</a>
      			</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">乐天 <b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="#">个人资料</a></li>
					  <li><a href="#">个人空间</a></li>
					  <li><a href="#">我的习题集</a></li>
					  <li class="divider">&nbsp;</li>
					  <li><?php echo anchor('user/logout', '退出'); ?></li>
					</ul>
				</li>
			</ul>
		</div> <!-- end collapse navbar-collapse navbar-ex1-collapse -->

	</div> <!-- end container -->
</nav>