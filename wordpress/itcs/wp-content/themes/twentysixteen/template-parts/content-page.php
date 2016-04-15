<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (get_field('itcs_inner_title')) { ?>
		<div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
			<a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
		</div>
	<?php } ?><!-- .entry-header -->

	<?php
		the_content();
	?>
</article><!-- #post-## -->
