<?php $this->load->view('components/page_head'); ?>
<body>
<?php $this->load->view('components/page_nav'); ?>
<div class="container">
	<div class="alert alert-info">
    	<a href="/">6bey又一次蛋疼的改版界面了</a>
	</div> 
    <div class="row">
    	<div class="span9">
    		<div class="content-unit">
    			<?php $this->load->view('components/page_sort'); ?>
				<?php echo $yield; ?>
			</div><!-- end content-unit -->
		</div> <!-- end span9 -->
		<div class="span3 sidebar">
			<?php $this->load->view('components/page_sidebar'); ?>
		</div><!-- end span3 -->
	</div><!-- end row-->
</div><!-- end container -->
<?php $this->load->view('components/page_tail'); ?>