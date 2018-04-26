<?php get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<div class="titlebar">
			<div class="container">
				<div class="row">
					<h1 class="title text-center"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>

		<article <?php post_class(); ?>>
			<div class="container">
				<div class="row">
					
					<div class="col-sm-12">
						<?php the_content(); ?>
					</div>
					<div class="col-sm-12">
						<small><strong>Category:</strong> <?php the_category( ', ' ); ?></small>
					</div>
					<div class="col-sm-12">
						<?php edit_post_link('Edit', '<p>', '</p>', '', 'btn btn-success edit'); ?>
					</div>

				</div>
			</div>
		</article>

	<?php endwhile; ?>
	
	<?php else: ?>
		<article>
			<h1><?php _e( 'Sorry, nothing to display.', 'collado' ); ?></h1>
		</article>
	<?php endif; ?>

<?php get_footer(); ?>
