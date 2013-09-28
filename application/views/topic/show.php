<div class="content-unit">
	<div class="media"style="margin:10px 0 10px 20px;">
	  <a class="pull-right" href="<?php echo "/user/show/".$topic->user->id;?>" style="margin-right:40px;margin-bottom:10px;">
	    <img class="media-object" src="<?php echo $topic->user->userInfo->avatar; ?>" width="48" height="48" alt="...">
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

<?php if($topic->replies_count != 0): ?>
<div class="content-unit">
	
	<div class="media">
	  共<?php echo $topic->replies_count; ?>条回复
	</div>
	
	<?php if(count($topic->replies) > 0) : foreach($topic->replies as $reply): ?>
		<div class="media">
		  <a class="pull-left" href="<?php echo "/user/show/".$reply->user->id;?>">
		    <img class="media-object" src="<?php echo $reply->user->userInfo->avatar;?>" width="48" height="48" alt="...">
		  </a>
		  <div class="media-body">
		    <h4 class="media-heading">
		    	<?php echo $reply->user->username . ' 回复于 ' . time_ago($reply->created_at); ?>
		    </h4>
		    	<?php echo $reply->body; ?>
		  </div>
		</div>
	<?php endforeach; ?>
	<?php endif; ?>
	
</div>
<?php endif; ?>


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
            )); ?>
        </td>
    </tr>
    <tr>
		<td><?php echo form_submit('submit', '回复', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>