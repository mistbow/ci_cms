<?php $this->load->view('components/page_head'); ?>
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="<?php echo base_url();?>/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
    plugins: 'tiny_mce_wiris',
    toolbar: 'tiny_mce_wiris'
    wirisimagebgcolor: '#FFFFFF',
    wirisimagesymbolcolor: '#000000',
    wiristransparency: 'true',
    wirisimagefontsize: '16',
    wirisimagenumbercolor: '#000000',
    wirisimageidentcolor: '#000000',
    wirisformulaeditorlang: 'es'
 });
</script>
<?php echo $yield; ?>
<?php $this->load->view('components/page_tail'); ?>