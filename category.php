<?php get_header(); ?>

	<div class="titlebar">
		<div class="container">
			<div class="row">
				<h1 class="title text-center">Blog</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="col-sm-12">
				<?php get_template_part('loop'); ?>
				<?php get_template_part('pagination'); ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
