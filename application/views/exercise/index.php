<div class="zw_class">
	<?php for ($i=0; $i < 3; $i++):?>
	<dl>
		<dt>
			<em>&gt;&nbsp;年级：</em>
			<span>
				<b> 
					<?php if(count($category)) : foreach($category as $key => $subject) : ?>
			    	
					<a href="/<?php echo $key ?>">
						<i>
							<nobr>
								<?php echo $subject['name']; ?>
							</nobr>
						</i>
					</a> 
					<?php endforeach; ?>
			    	<?php endif; ?>
				</b> 
			</span>
		</dt>
	</dl>
	<?php endfor; ?>
</div>