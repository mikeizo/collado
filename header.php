<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

	<link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/touch.png" rel="apple-touch-icon-precomposed">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header class="header">

		<div class="sub-header">
			<div class="container">
				<div class="sub-header-text text-right">
					<div>
						<i class="fas fa-map-marker-alt"></i> 
						<a href="https://www.google.com/maps/place/2+Holland+Ave,+White+Plains,+NY+10603/data=!4m2!3m1!1s0x89c295b7f11e3c1d:0x665a4247777e2d4e?sa=X&ved=0ahUKEwjnv52oouLZAhVCnFkKHU_uBAQQ8gEIKDAA" target="_blank">
							2 Holland Avenue,  White Plains, NY 10603
						</a>
					</div>
					<div><i class="fas fa-phone"></i> <a href="tel:19143327658">914.332.7658</a></div>
					<div><i class="fas fa-envelope"></i> <a href="mailto:info@collado-eng.com">info@collado-eng.com</a></div>
				</div>
			</div>
		</div>
		
		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<a class="navbar-brand logo" href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Collado Engineering" class="img-responsive">
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbar-menu">
					<?php collado_nav(); ?>
				</div>
			</div>
		</nav>

	</header>
	