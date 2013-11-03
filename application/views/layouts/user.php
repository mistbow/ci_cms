<?php $this->load->view('components/page_head'); ?>
<body>
<?php $this->load->view('components/page_nav'); ?>
<div class="container">
	<div class="alert alert-info">
    	<a href="/">6bey又一次蛋疼的改版界面了</a>
	</div> 
    <div class="row">
    	<?php echo $yield; ?>
	</div><!-- end row-->
</div><!-- end container -->
<?php $this->load->view('components/page_tail'); ?>