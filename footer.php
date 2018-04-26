	<footer>

		<div class="container">
			<div class="row">
				<div class="col-sm-12"><hr></div>
				<?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-widget-1' ); ?>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-widget-2' ); ?>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-widget-3' ); ?>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-widget-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-widget-4' ); ?>
				<?php endif; ?>
				<div class="col-sm-12"><hr></div>
			</div>

			<p class="copyright text-center">
				<small>&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.</small>
			</p>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
