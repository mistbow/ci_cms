<?php $this->load->view('components/page_head'); ?>
<body style="background: #555;">

    <div class="modal show" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
<?php $this->load->view($subview); // Subview is set in controller ?>
          <div class="modal-footer">
            &copy; <?php echo date('Y'); ?> <?php echo $meta_title; ?>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $this->load->view('components/page_head'); ?>