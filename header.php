<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
wp_head();
?>
</head>

<body>
<header class="header text-center">	    
	   
<a class="site-title pt-lg-4 mb-0" href="<?php echo home_url(); ?>">
	<?php echo get_bloginfo('name'); ?>
</a>
<div class="container">
  <?php //dynamic_sidebar('sidebar-1'); ?>
  </div>
	    <nav class="navbar navbar-expand-lg navbar-dark" >
		
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
			<div id="navigation" class=" container collapse navbar-collapse flex-row p-0" >
				 <?php 
				if(function_exists('the_custom_logo')) {
					the_custom_logo();
				}
				?>
				<?php
					if(function_exists('the_custom_logo')) {
						$custom_logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($custom_logo_id);
					}
				?>
				<!-- <a href="<?php echo home_url(); ?>"><img class="mb-3 logo" src="<?php echo $logo[0] ?>" alt="logo" ></a>			 -->
				
				<?php
					wp_nav_menu(
						array(
							'menu' => 'primary',
							'container' => '',
							'theme_location' => 'primary',
							'items_wrap' => '<ul class="navbar-nav flex-row text-sm-center text-md-left align-items-center">%3$s</ul>',
							
						)
					);
				?>
			
				
			</div>
			
		</nav>
		
    </header>
<div class="main-wrapper">
    <header class="page-title theme-bg-light text-center gradient py-5">
        <h1 class="heading"><?php the_title(); ?></h1>
    </header>
