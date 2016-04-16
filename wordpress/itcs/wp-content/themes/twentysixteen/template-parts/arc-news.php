<?php
/**
 * Template Name: NEWS
 */

get_header(); ?>

<div class="main-container">
<?php if (get_field('itcs_inner_title')) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
  </div>
<?php } ?>

<?php
$query = new WP_Query("category_name=news&orderby=itcs_general_order_news&order=desc");

if ($query->have_posts()) {
  echo '    <ul style="margin-top: 30px;">';
  while ($query->have_posts()) :
    $query->the_post();
?>

      <li>
				<div style="display: block;">
					<span style="width: 700px; overflow: hidden;"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></span>
					<span style="float: right;"><?php the_date(); ?></span>
				</div>
			</li>
      
<?endwhile;
  echo '</ul>';
}
?>
</div>

<?php get_footer(); ?>