<?php $this->load->view('admin/components/page_head'); ?>
  <body style="padding-top: 70px;">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>">6bey</a>
          </div>
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><?php echo anchor('admin/page', 'pages'); ?></li>
                <li><?php echo anchor('admin/page/order', 'order pages'); ?></li>
                <li><?php echo anchor('admin/article', 'news articles'); ?></li>
                <li><?php echo anchor('admin/user', 'users'); ?></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </nav>
      
      <div class="container">
        <div class="row">
            <!-- Main column -->
            <div class="col-md-9">
                <h2>page</h2>
            </div>
            <!-- Sidebar -->
            <div class="col-md-3">
                <section>
                    <?php echo mailto('117064092@qq.com', '<i class="icon-user"></i> 117064092@qq.com'); ?><br>
                    <?php echo anchor('admin/user/logout', '<i class="icon-off"></i> logout'); ?>
                </section>
            </div>
        </div>
    </div>
    
<?php $this->load->view('admin/components/page_tail'); ?>