<?php get_header(); ?>

	<div class="titlebar">
		<div class="container">
			<div class="row">
				<h1 class="title text-center">404</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<article id="post-404" class="col-sm-12 text-center">
				<h2 class="text-center"><?php _e( 'Page not found', 'collado' ); ?></h2>
				<span><a href="<?php echo home_url(); ?>"><?php _e( 'Return home', 'collado' ); ?> <i class="fas fa-arrow-right"></i></a></span>
			</article>
		</div>
	</div>

<?php get_footer(); ?>
