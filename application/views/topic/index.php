<?php foreach($topics as $topic) : ?>
<div class="media">
	<span class="label label-info pull-right" style="margin-top:5px;">
		<?php echo anchor('/topic/show/'.$topic->id, $topic->replies_count, 'style="color:white;"'); ?>
	</span>
  <a class="pull-left" href="<?php echo "/user/show/".$topic->user->id;?>">
    <img class="media-object" src="<?php echo  $topic->user->userInfo->avatar;?>" width="48" height="48" alt="...">
  </a>
  <div class="media-body">
    <h4 class="media-heading">
    	<?php echo anchor('/topic/show/'.$topic->id, $topic->title); ?>
    </h4>
    <?php echo time_ago($topic->created_at) 
    			. ' by ' . $topic->user->username; ?>
    <?php 
    	if(isset($topic->reply_user)) {
    		echo  ' | 最后回复 '.time_ago($topic->replied_at)
				.' by '.$topic->reply_user->username; 
		} 
	?>
  </div>
</div>
<?php endforeach; ?>
<div style="text-align:center;">
	<div class="pagination pagination-large">
		<?php echo $links;?>
	</div>
</div>