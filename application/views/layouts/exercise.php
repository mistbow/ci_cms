<?php $this->load->view('components/page_head'); ?>
<body>
<?php $this->load->view('components/page_nav'); ?>
<div class="container">
    <div class="row">
    	<div class="col-md-12">
			<?php echo $yield; ?>
		</div> <!-- end col-md-12 -->
	</div><!-- end row-->
</div><!-- end container -->
<?php $this->load->view('components/page_tail'); ?>