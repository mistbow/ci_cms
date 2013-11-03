<?php $this->load->view('components/page_head'); ?>
<body>
<?php $this->load->view('components/page_nav'); ?>
<div class="container">
    <div class="row">
    	<?php echo $yield; ?>
	</div><!-- end row-->
</div><!-- end container -->
<?php $this->load->view('components/page_tail'); ?>
