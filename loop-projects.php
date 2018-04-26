<?php
	
	// Paginationi page number
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	// Sort projects by title ascending
	$args = array(
		'post_type' => 'projects',
		'orderby'=> 'title', 
		'order' => 'asc',
		'posts_per_page' => get_option('posts_per_page'),
		'paged' => $paged
	);

	if (get_queried_object()->slug):
		$args['tax_query'] = array(
			array(
				'taxonomy'	=> 'project-category',
				'field'		=> 'slug',
				'terms'		=> get_queried_object()->slug
			),
		);
	endif;

	$query = new WP_Query($args);
?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>

	<li class="media">
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('thumbnail', array( 'class' => 'img-fluid mr-4 mb-4')); ?>
			</a>
		<?php endif; ?>
		
		<div class="media-body">
			<h2 class="mb-2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php //collado_excerpt(true); ?>
			<?php edit_post_link('Edit', '<p>', '</p>', '', 'btn btn-success edit'); ?>
		</div>
	</li>

	<?php // Check if last post
		if($wp_query->current_post +1 != $wp_query->post_count) : ?>
		<hr>
	<?php endif; ?>

<?php endwhile; ?>

<?php else: ?>
	<article>
		<h2><?php _e( 'Coming Soon', 'collado' ); ?></h2>
	</article>
<?php endif; ?>

<?php get_template_part('pagination'); ?>