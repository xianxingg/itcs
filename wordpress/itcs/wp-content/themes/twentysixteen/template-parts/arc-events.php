<?php
/**
 * Template Name: EVENTS
 */

get_header(); ?>

<div class="main-container">
<?php if (get_field('itcs_inner_title')) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
  </div>
<?php } ?>

<?php
global $post;
$slug = $post->post_name;
$cat = '';
if ($slug == 'conferences-workshops'): $cat = 'conferences_workshops';
elseif ($slug == 'seminars') : $cat = 'seminars';
elseif ($slug == 'summer-winter-schools'): $cat = 'summer_winter_schools'; endif;
?>

<?php


  echo '    <ul style="margin-top: 30px;">';



  # 需要定义的字段
  $category_name = $cat;
  $show_posts = 10;

  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $permalink = 'Post name'; // Default, Post name

  //Know the current URI
  $req_uri =  $_SERVER['REQUEST_URI'];  

  //Permalink set to default
  if($permalink == 'Default') {
  $req_uri = explode('paged=', $req_uri);

  if($_GET['paged']) {
  $uri = $req_uri[0] . 'paged='; 
  } else {
  $uri = $req_uri[0] . '&paged=';
  }
  //Permalink is set to Post name
  } elseif ($permalink == 'Post name') {
  if (strpos($req_uri,'page/') !== false) {
  $req_uri = explode('page/',$req_uri);
  $req_uri = $req_uri[0] ;
  }
  $uri = $req_uri . 'page/';

  }

  //Query
  
  $wp_query = new WP_Query(
    array(
      "showposts" => $show_posts,
      "category_name" => $category_name,
      "paged" => $paged,
      "meta_key" => "itcs_general_order_evt",
      "orderby" => array( "meta_value_num" => "desc", "date" => "desc")
    )
  );
  
  $cat = get_category_by_slug($category_name);
  $poststs = get_posts("numberposts=-1&category=" . $cat->term_id);
  $count_posts = count($poststs);
  

  while ($wp_query->have_posts()) : $wp_query->the_post(); 
  ?>

  <!-- 自定义循环内容区域 -->
  
      <li>
				<div style="display: block;">
          <span style="display: block; clear: both;"><?php if (get_field('itcs_event_date_start') == get_field('itcs_event_date_end')) : echo str_replace("-", "/", get_field('itcs_event_date_start')); else : echo str_replace("-", "/", get_field('itcs_event_date_start')) . " ~ " . str_replace("-", "/", get_field('itcs_event_date_end')); endif; ?></span>
					<span style="width: 700px; overflow: hidden; padding-left: 20px;"><a href="<?php the_permalink(); ?>" target="_self"><?php the_title(); ?></a></span>
				</div>
			</li>
      
  <!-- end:自定义循环内容区域 -->

  <?php endwhile;?>
  <nav>
  <?php previous_posts_link('« ') ?>
  <?php
  $count_post = ceil($count_posts / $show_posts);

  if ($count_post > 1) {
  for($i = 1; $i <= $count_post ; $i++) { ?>
  <a <?php if($req_uri[1] == $i) { echo 'class=active_page'; } ?> href="<?php echo $uri . $i; ?>" rel="external nofollow" ><?php echo $i; ?></a>
  <?php }}
  ?>
  <?php next_posts_link(' »') ?>
  </nav>

  <?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset


  echo '</ul>';

?>
</div>

<?php get_footer(); ?>