<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php 
$isNews = false;
$isSW = false;
$isCW = false;
$isSEM = false;
$cats = get_the_category();
foreach ($cats as $cat) {
  #echo $cat->cat_name;
  #echo "<br>";
  
  if ($cat->cat_name == 'NEWS') : $isNews = true; endif;
  if ($cat->cat_name == 'SUMMER &amp; WINTER SCHOOLS') : $isSW = true; endif;
  if ($cat->cat_name == 'CONFERENCES &amp; WORKSHOPS') : $isCW = true; endif;
  if ($cat->cat_name == 'SEMINARS') : $isSEM = true; endif;
}

if ($isNews) : echo "<script>window.setCurrentMenu('NEWS');</script>"; endif;
if ($isSW || $isCW) : echo "<script>window.setCurrentMenu('EVENTS');</script>"; endif;
if ($isSEM) : echo "<script>window.setCurrentMenu('SEMINARS');</script>"; endif;
?>

<?php if ($isNews) { ?>
<h1 class="news-title"><?php the_title(); ?></h1>
<div><?php the_content(); ?></div>
<?php } else if ($isSW || $isCW || $isSEM) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <?php if ($isSW) { ?><a href style="text-decoration: none !important; cursor: text !important;">Summer & Winter Schools</a> <?php } ?>
    <?php if ($isCW) { ?><a href style="text-decoration: none !important; cursor: text !important;">Conferences & Workshops</a> <?php } ?>
    <?php if ($isSEM) { ?><a href style="text-decoration: none !important; cursor: text !important;">Seminars</a> <?php } ?>
  </div>
  
  <div style="padding-left: 25px; padding-right: 25px;">
      <h3 style="text-align: center;font-size: 16px;color: #ae1831;"><?php the_title(); ?></h3>
      
      <p class="big_red_title"><?php if ($isSEM) : echo 'Abstract'; else : echo 'Brief Introduction'; endif; ?></p>
      <p><?php the_field('itcs_event_intro'); ?></p>
      
      <p class="big_red_title">Time</p>
      <p><?php if ($isSEM) : echo get_field('itcs_event_date_start') . " " . get_field('itcs_event_time_start') . " ~ " . (get_field('itcs_event_date_start') == get_field('itcs_event_date_end') ? '' : get_field('itcs_event_date_end')) . " " . get_field('itcs_event_time_end'); else : echo get_field('itcs_event_date_start') . " ~ " . get_field('itcs_event_date_end'); endif; ?>

      <p class="big_red_title"><?php if ($isSEM) : echo 'Speaker'; else : echo 'Lecturers'; endif; ?></p>
      <p><?php the_field('itcs_event_lecturer') ?></p>
      
      <p class="big_red_title"><?php if ($isSEM) : echo 'Room'; else : echo 'Venue'; endif; ?></p>
      <p><?php the_field('itcs_event_venue') ?></p>
      
      <?php if (!$isSEM) { ?>
      <p class="big_red_title">Application and Registration</p>
      <?php if (get_field('itcs_event_application_url')) : echo ("<a href='" . get_field('itcs_event_application_url') . "' target='_blank'>" . get_field('itcs_event_application') . "</a>"); ?>
      <?php else : the_field('itcs_event_application'); endif; ?>
      
      <p class="big_red_title">Program</p>
      <p><?php the_field('itcs_event_schedule') ?></p>
      
      <p class="big_red_title">Contact Us</p>
      <p><a href="/index.php/people/administrative-assistant/" target="_blank"><?php the_field('itcs_contact_us'); ?></a></p>
      
      <p class="big_red_title">Directions to ITCS</p>
      <p><a href="/index.php/about-us/contact-us/" target="_blank">View Direction Page</a></p>
      
      <?php } ?>
  </div>
<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
