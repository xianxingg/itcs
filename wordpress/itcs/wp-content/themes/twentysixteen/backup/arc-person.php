<?php
/**
 * Template Name: PEOPLES
 */

get_header(); ?>

<?php if (get_field('itcs_inner_title')) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
  </div>
<?php } ?>

<?php
$academics = array("visitors", "full-time-faculty", "affiliated-professor", "visiting-professor");
$administrative = array("administrative-assistant");

global $post;
$slug = $post->post_name;
$orderby = "itcs_general_order_";
if (in_array($slug, $academics)) $orderby .= 'acd';

# echo "category_name=" . $slug . "&orderby=" . $orderby . "&order=asc";

$query = new WP_Query("category_name=" . $slug . "&orderby=" . $orderby . "&order=asc");

if ($query->have_posts()) { ?>
<div class="row" style="margin-top: 35px; padding-left: 50px; padding-right: 50px;">
  <table class="visitorList">
<?php
while ($query->have_posts()) : 
  $query->the_post();
?>

  <?php # ACADEMICAL PERSON ?>
  <?php if (in_array($slug, $academics)) { ?>
  <tr>
    <td style="width: 250px; padding: 15px;">
      <?php the_post_thumbnail(); ?>
    </td>
    <td style="width: 10px;">&nbsp;</td>
    <td style="width: 700px;">
      <h2><?php the_field('itcs_person_name_acd') ?></h2>
      <p><?php the_field('itcs_person_title_acd') ?></p>
      <p><?php the_field('itcs_person_from_acd') ?></p>
      
      <p><strong>Interests: </strong><?php the_field('itcs_person_interest_acd') ?></p>
      <p><strong>Email: </strong><a href="mailto:<?php the_field('itcs_person_email_acd') ?>"><?php the_field('itcs_person_email_acd') ?></a></p>
      <p><strong>Homepage: </strong><a href="<?php the_field('itcs_person_homepage_acd') ?>" target="_blank"><?php the_field('itcs_person_homepage_acd') ?></a></p>
    </td>
  </tr>  
  
  
  <?php # ADMINISTRATIVE PERSON ?>
  <?php } else if (in_array($slug, $administrative)) { ?>
  <tr>
    <td style="width: 250px; padding: 15px;">
      <?php the_post_thumbnail(); ?>
    </td>
    <td style="width: 10px;">&nbsp;</td>
    <td style="width: 700px;">
      <h2><?php the_field('itcs_person_name_adm') ?></h2>
      <p><?php the_field('itcs_person_office_adm') ?></p>
      <p><?php the_field('itcs_person_email_adm') ?></p>
      <p><?php the_field('itcs_person_phone_adm') ?></p>
      
      <p><strong>Work: </strong><?php the_field('itcs_person_work_adm') ?></p>
    </td>
  </tr>
  <?php } ?>
<?php
endwhile;
}?>
  </table>
</div>

</div>
  
<?php get_footer(); ?>