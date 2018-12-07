<?php
	$image = get_field('image');
?>	

<section class="chambers-card chambers-card-<?php echo $count ?> hidden">	

	<div class="two-columns">

		<div class="column-1 image-block">
			<p>
				<?php if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</p>
		</div>	

		<div class="column-2 prices-block">	

			<p class="less-padding two-columns">
				<span>At your site:</span>  
				<span>£<?php the_field ('price_at_your_site') ?> per month</span> 
			</p>

			<p class="two-columns">
				<span>At our site:</span>  
				<span>£<?php the_field ('price_at_our_site_daily') ?> per day<br/>£<?php the_field ('price_at_our_site_weekly') ?> per week
				</span>
			</p>

			<p>
			<a href="mailto:sales@sharetree.co.uk?subject=Enquiry regarding <?php the_field( 'short_description' ); ?>">
				<button>Enquire now<span class="dashicons dashicons-admin-users"></span></button>
			</a>
</p>

		</div>	

	</div>

	<p><?php the_field( 'short_description' ); ?></p>
	<p><?php the_field( 'detailed_description' ); ?></p>


</section>



