<?php get_header(); ?>

	<div class="titlebar">
		<div class="container">
			<div class="row">
				<h1 class="title text-center"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="col-sm-3 mb-3">
					<?php the_post_thumbnail('large', array( 'class' => 'img-fluid')); ?>
				</div>
				<div class="col-sm-9">
			<?php else: ?>
				<div class="col-sm-12">						
			<?php endif; ?>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>					
					<?php edit_post_link('Edit', '<p>', '</p>', '', 'btn btn-success edit'); ?>
				</article>
			<?php endwhile; ?>

			<?php else: ?>
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'collado' ); ?></h2>
				</article>
			<?php endif; ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
