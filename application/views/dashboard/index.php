<?php echo '<pre>' . print_r($this->session->userdata, TRUE) . '</pre>'; ?>
<h1>Welcome to 6bey web site</h1>

<p>This is a web site to help you study happily</p>

<ul class="nav navbar-nav">
    <li><?php echo anchor('user/login', 'login'); ?></li>
    <li><?php echo anchor('user/logout', 'logout'); ?></li>
    <li><?php echo anchor('user/register', 'register'); ?></li>
</ul>