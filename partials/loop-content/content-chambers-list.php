<?php
	$file = get_field('pdf');
?>	

<section class="chambers-list chambers-list-table">	

	<h2 class="title"><?php the_title(); ?></h2>
	<p class="pdf"> 
		<?php if( $file ): ?>
			<a href="<?php echo $file['url']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri();?>/images/pdf-icon.png" alt="View PDF"></a>
		<?php endif; ?>	
	</p>

	<div class="data-section">

		<div class="column-1">
			<p class="less-padding two-columns volume">
				<span>Volume:</span>
				<span><?php the_field ('volume_ltrs') ?> litres</span>
			</p>
			<p class="less-padding two-columns temperature">
				<span>Temperature range:</span> 
				<span><?php the_field ('temperature_range_low') ?>&#8451; - <?php the_field ('temperature_range_high') ?>&#8451;</span>
			</p>
		</div>

		<div class="column-2">
			<p class="less-padding two-columns humidity">
				<span>Humidity range:</span> 

				<?php if ( get_field ('humidity_range_low') == 'N/A' ) : ?>
					<span>N/A</span>
				<?php else: ?>
					<span><?php the_field ('humidity_range_low') ?>%RH - <?php the_field ('humidity_range_high') ?>%RH</span>
				<?php endif; ?>
				
			</p>
			<p class="two-columns ramp-rate">
				<span>Ramp rate:</span> 
				<span><?php the_field ('ramp_rate') ?>&#8451;/min</span>
			</p>
		</div>	

	</div>		

	<button class="read-more" id="chamber-<?php echo $count; ?>">
		Reveal details<span class="dashicons dashicons-arrow-right-alt2"></span>
	</button>

</section>

<?php include( locate_template( 'partials/loop-content/content-chambers-card.php' ) ); ?>


