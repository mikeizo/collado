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
					<?php if ( has_post_thumbnail()) :
						$check = true; ?>
						<div class="col-sm-6"> 
							<?php the_post_thumbnail('large', array( 'class' => 'img-fluid') ); ?>
						</div>
					<?php endif; ?>
					
					<div class="col-sm-6">
						<blockquote class="p-4 bg-light">
							<?php if( get_field('name') ):
								 $check = true; ?>
								<h3><?php the_field('name'); ?></h3>
							<?php endif; ?>
							<?php if( get_field('address') ):
								 $check = true; ?>
								<p><strong>Address: </strong><br> <?php the_field('address'); ?></p>
							<?php endif; ?>
							<?php if( get_field('clients') ): 
								$check = true; ?>
								<p><strong>Clients: </strong><br> <?php the_field('clients'); ?></p>
							<?php endif; ?>
							<?php if( get_field('architect') ): 
								$check = true; ?>
								<p><strong>Architect: </strong><br> <?php the_field('architect'); ?></p>
							<?php endif; ?>
							<?php if( get_field('project_size') ): 
								$check = true; ?>
								<p><strong>Project Size: </strong><br> <?php the_field('project_size'); ?></p>
							<?php endif; ?>
							<?php if( get_field('cost') ):
								$check = true; ?>
								<p><strong>Construction Cost: </strong><br> <?php the_field('cost'); ?></p>
							<?php endif; ?>							
						</blockquote>
					</div>

					<?php if(isset($check)): ?>
						<div class="col-sm-12"><hr></div>
					<?php endif; ?>

					<div class="col-sm-12">
						<?php the_content(); ?>
					</div>
					
					<div class="col-sm-12">
						<small><strong>Project Type:</strong> 
						<?php 
							$terms = get_the_terms( $post->ID , 'project-category' );
							$count = count($terms);
							$i = 0;
							if($terms) foreach ($terms as $term):
								$term_link = get_term_link( $term, 'project-category' );
								echo '<a href="' . $term_link . '">' . $term->name . '</a>';
								if(++$i != $count) echo ' | ';
							endforeach;
						?>
						</small>
					</div>
				</div>

				<div class="row">
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
