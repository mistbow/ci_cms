<div class="content-unit">
	<div class="media"style="margin:10px 0 10px 20px;">
	  <a class="pull-right" href="<?php echo "/user/show/".$problem->user->id;?>" style="margin-right:40px;margin-bottom:10px;">
	    <img class="media-object" src="<?php echo $problem->user->userInfo->avatar; ?>" width="48" height="48" alt="...">
	  </a>
	  <div class="media-body" style="margin-top:10px;">
	    <h4 class="media-heading">
	    	<b><?php echo $problem->title; ?></b>
	    </h4>
	    <?php echo time_ago($problem->created_at) . " by " . $problem->user->username; ?>
	  </div>
	</div>
	<div style="margin-left:20px;">
		<?php echo $problem->body; ?>
	</div>
<?php if(is_mine($problem->user->id)) : ?>
<div class="tools pull-right">
        
    <a class="likeable" data-count="0" data-id="14457" data-state="" data-type="problem" href="#" onclick="return App.likeable(this);" rel="twipsy" data-original-title="喜欢">
    	<span class="glyphicon glyphicon-heart-empty"></span>
    	<span>喜欢</span>
    </a>
    <a class="icon small_bookmark" data-id="14457" href="#" onclick="return problems.favorite(this);" rel="twipsy" data-original-title="收藏"></a>
    <a class="icon small_edit" href="<?php echo "/problem/edit/".$problem->id;?>" title="修改本帖">
		<span class="glyphicon glyphicon-check"></span>
    </a>
    <a class="icon small_delete" data-confirm="确定要删除么？" data-method="delete" href="<?php echo "/problem/delete/".$problem->id;?>" rel="nofollow" title="删除本帖">
    	<span class="glyphicon glyphicon-trash"></span>
    </a>
</div>

<div class="post_hidden"></div>
<?php endif; ?>

</div><!-- end content-unit-->