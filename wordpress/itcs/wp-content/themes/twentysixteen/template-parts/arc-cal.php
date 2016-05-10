<?php
/**
 * Template Name: CALENDAR
 */

get_header(); ?>

<div class="main-container">
<?php if (get_field('itcs_inner_title')) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
  </div>
<?php } ?>

<div id='calendar' style="margin-top:3em;"></div>


<script type='text/javascript'>
  $(document).ready(function() {
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,agendaDay'
      },
      editable: true,
      timeFormat: 'H:mm{ - H:mm}',
      events: [
          
<?php
$query = new WP_Query("category_name=conferences_workshops,summer_winter_schools,course&orderby=itcs_event_time_start&order=desc");

if ($query->have_posts()) {
  while ($query->have_posts()) :
    $query->the_post();
    
    $cat = get_the_category();
    $isCourse = false;
    foreach ($cat as $acat) {
      if ($acat->cat_name == "COURSE"): $isCourse = true; endif;
    }
    
    echo "{title: '" . get_the_title();
    if (get_field('itcs_event_venue')) : echo " - " . get_field('itcs_event_venue'); endif;
    echo "', start: '" . get_field('itcs_event_date_start') . " " . get_field('itcs_event_time_start') . ":00', end: '" .get_field('itcs_event_date_end') . " " . get_field('itcs_event_time_end') . ":00', url: '";
    if ($isCourse): echo "#"; else : echo get_the_permalink(); endif;
    echo "', className: 'seminar-type-1', allDay: false}, \n";
  endwhile;
}?>

      ]
    });
    
  });
</script>

<?php get_footer(); ?>