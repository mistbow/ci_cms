<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>

<div class="jumbotron">
    <ul>
    	<?php if(count($category)) : foreach($category as $key => $subject) : ?>
    	<li><?php echo anchor('/$key', $subject['name']);?></li>
    	<?php endforeach; ?>
    	<?php endif; ?>
    </ul>
</div>