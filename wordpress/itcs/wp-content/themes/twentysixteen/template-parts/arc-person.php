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
$visitors = array("visitors", "visiting-professor");
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

  <?php # VISITORS ?>
  <?php if (in_array($slug, $visitors)) { ?>
  <tr>
    <td style="width: 250px; padding: 15px;">
      <?php the_post_thumbnail(); ?>
    </td>
    <td style="width: 10px;">&nbsp;</td>
    <td style="width: 700px;">
      <h2><?php the_field('itcs_person_name_acd') ?></h2>
      <p><?php the_field('itcs_person_title_acd') ?></p>
      <p><?php the_field('itcs_person_from_acd') ?></p>
      
      <p class="special-format-date"><strong>Visiting: </strong><span id="itcs_visit_date_from" data-dt="<?php the_field('itcs_visit_date_from') ?>"></span> ~ <span id="itcs_visit_date_to" data-dt="<?php the_field('itcs_visit_date_to') ?>"></span></p>
      <p><strong>Homepage: </strong><a href="<?php the_field('itcs_person_homepage_acd') ?>" target="_blank"><?php the_field('itcs_person_homepage_acd') ?></a></p>
    </td>
  </tr>  
  
  <?php # ACADEMICAL PERSON ?>
  <?php } else if (in_array($slug, $academics)) { ?>
  <tr>
    <td style="width: 250px; padding: 15px;">
      <?php the_post_thumbnail(); ?>
    </td>
    <td style="width: 10px;">&nbsp;</td>
    <td style="width: 700px;">
      <h2><?php the_field('itcs_person_name_acd') ?></h2>
      <p><?php the_field('itcs_person_title_acd') ?></p>
      <p><?php the_field('itcs_person_from_acd') ?></p>
      
      <p><strong>Interests: </strong><?php the_field('itcs_academic_interest_acd') ?></p>
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

<script>
  for (var i = 0; i < $(".special-format-date").length; i ++) {
    var p = $(".special-format-date")[i];
    var dtSpan1 = $(p).find("span").eq(0), dtSpan2 = $(p).find("span").eq(1);
    var dt1 = moment(dtSpan1.attr("data-dt")), dt2 = moment(dtSpan2.attr("data-dt"));
    var formatString1 = "MMM D, YYYY", formatString2 = "MMM D, YYYY";
      
    if (dt1.year() === dt2.year()) {
      formatString1 = "MMM D";
      if (dt1.month() === dt2.month()) {
        formatString2 = "D, YYYY";
      }
    }
    
    dtSpan1.html(dt1.format(formatString1));
    dtSpan2.html(dt2.format(formatString2));
  }
</script>
  
<?php get_footer(); ?>