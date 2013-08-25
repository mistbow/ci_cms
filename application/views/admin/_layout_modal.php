<?php $this->load->view('admin/components/page_head'); ?>

<body style="background: #555;">

    <div class="modal show" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Log in</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            &copy; <?php echo date('Y'); ?> <?php echo $meta_title; ?>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php $this->load->view('admin/components/page_tail'); ?>