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