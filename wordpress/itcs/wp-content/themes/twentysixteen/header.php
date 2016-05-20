<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>

<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!--<title>Institute of Theoretical Computer Science, SUFE 上海财经大学理论计算机科学研究中心</title>-->
		
<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 - Search Results - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php single_tag_title("", true); ?> - <?php bloginfo('name'); ?></title><?php }?> <?php } ?>


<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" rel=icon>
<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" rel="shortcut icon">


		<link href="<?php echo get_template_directory_uri(); ?>/css/application.css" media="all" rel="stylesheet" type="text/css">
		<link href="<?php echo get_template_directory_uri(); ?>/css/append.css" media="all" rel="stylesheet" type="text/css">
		
		<!--[if lt IE 7]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
		<![endif]-->
		<script src="<?php echo get_template_directory_uri(); ?>/js/application.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/append.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/marquee.js"></script>		
		<script src="<?php echo get_template_directory_uri(); ?>/js/moment-with-locales.min.js"></script>		
		<script src="<?php echo get_template_directory_uri(); ?>/js/underscore-min.js"></script>

	</head>

	<body>
		<div id="header" style="">
			<div class="container">
				<img alt="Logo" src="<?php echo get_template_directory_uri(); ?>/images/logo2.png" style="margin:0px;height:100px ">
					<div style="float: right; display: none;">
					<img src="<?php echo get_template_directory_uri(); ?>/images/search.png" style="width: 31px;margin-top: 19px;margin-right: 30px;">
				</div>
			</div>
		</div>

		<div id="menu" style="">
			<div class="container " style="">
				<div class="navbar" style="background-color:#;margin:0px 0;height:42px;color:white;" id="navbar">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'nav',
								'walker'				 => new itcs_menu_walker()
							) );
						?>
					<?php endif; ?>
        </div>
				
				<style>  
					.navbar .nav > li.dropdown.open > .dropdown-toggle { margin-bottom: -3px !important; }
					.navbar .nav > li > .dropdown-menu:after { left: 40px; }
					.navbar .nav > li > .dropdown-menu:before { left: 39px; }
				</style>
				
				<script>
					$('a.dropdown-toggle').on('click',function(){ 
						if (~$(this).text().trim().indexOf('PEOPLE')) location.href= $(this).attr('href'); 
						else return false;
					});
					
					$(".nav > li").hover(function(){
						if (!$(this).hasClass("open")) $(this).addClass("open");
					}, function(){
						if ($(this).hasClass("open")) $(this).removeClass("open");
					});
				</script>
			</div>
		</div>

		<div class="container ">
