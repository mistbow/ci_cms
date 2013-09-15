<?php $this->load->view('components/page_head'); ?>
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="<?php echo base_url();?>/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
<?php echo $yield; ?>
<?php $this->load->view('components/page_tail'); ?>