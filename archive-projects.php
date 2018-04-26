<?php get_header(); ?>

	<div class="titlebar">
		<div class="container">
			<div class="row">
				<h1 class="title text-center">Projects</h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<aside class="col-sm-3">
				<div class="p-3 mb-3 bg-light">
					<h4>Project Types: </h4>
					<?php $terms = get_terms([
						'taxonomy' => 'project-category',
						'hide_empty' => false,
					]); ?>
					<ul class="project-types">
					<?php foreach ($terms as $term ) : $term_link = get_term_link( $term, 'project-category' ); ?>
						<li><a href="<?php echo $term_link; ?>"> <?php echo $term->name; ?> </a></li>
					<?php endforeach; ?>
					</ul>
				</div>
			</aside>

			<div class="col-sm-9">
				<ul class="list-unstyled">
					<?php get_template_part('loop-projects'); ?>
				</ul>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
