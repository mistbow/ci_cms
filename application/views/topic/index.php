<div class="panel panel-default">
	<div class="panel-heading">当前话题</div>
	<div class="panel-body">
		<?php foreach($topics as $topic) : ?>
		<div class="media">
			<span class="label label-info pull-right" style="margin-top:5px;">
				<?php echo anchor('/topic/show/'.$topic->id, $topic->replies_count); ?>
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
		<div><?php echo $links;?></div>
	</div> <!-- end panel-body -->
</div> <!-- end panel panel-success -->