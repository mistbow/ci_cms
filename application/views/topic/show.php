<div class="content-unit">
	<div class="media"style="margin:10px 0 10px 20px;">
	  <a class="pull-right" href="#" style="margin-right:40px;margin-bottom:10px;">
	    <img class="media-object" src="/img/1.jpg" width="48" height="48" alt="...">
	  </a>
	  <div class="media-body" style="margin-top:10px;">
	    <h4 class="media-heading">
	    	<b><?php echo $topic->title; ?></b>
	    </h4>
	    <?php echo time_ago($topic->created_at) . " by " . $topic->user->username; ?>
	  </div>
	</div>
	<div style="margin-left:20px;">
		<?php echo $topic->body; ?>
	</div>
</br>

</div>


<div class="content-unit">
<?php echo validation_errors(); ?>
<?php 
	$hidden = array(
		'topic_id' => $topic->id
	);
	echo form_open('topic/reply','', $hidden);
?>
<table class="table">
	<tr>
		<td>
			<?php echo form_textarea($data = array(
              'name'        => 'body',
              'id'          => 'body',
              'value'       => $body,
            )); ?>
        </td>
    </tr>
    <tr>
		<td><?php echo form_submit('submit', '回复', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>