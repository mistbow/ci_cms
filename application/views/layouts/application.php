<?php $this->load->view('components/page_head'); ?>
<body>
<?php $this->load->view('components/page_nav'); ?>
<div class="container">
    <div class="row">
    	<div class="col-md-9">
			<?php echo $yield; ?>
		</div> <!-- end col-md-9 -->
		<div class="col-md-3">
			<?php $this->load->view('components/page_sidebar'); ?>
		</div><!-- end col-md-3 -->
	</div><!-- end row-->
</div><!-- end container -->
<?php $this->load->view('components/page_head'); ?>