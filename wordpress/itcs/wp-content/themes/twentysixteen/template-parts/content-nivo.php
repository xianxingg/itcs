<?php
$query = new WP_Query("category_name=slides&orderby=date&order=desc");
if ($query->have_posts()) { ?>

<div class="" id="intro" style="margin-top:0.5em; min-height: 286px;">
  <div class="slider-wrapper theme-default">
    <div class="nivoSlider" id="slider">
      <?php 
        while ($query->have_posts()):
          $query->the_post();
        
        if (get_field('itcs_link_url')){
          echo "<a data-nivo='1' target='_blank' href='" . get_field('itcs_link_url') . "'>";
          echo the_post_thumbnail(array(940, 310));
          echo "</a>";
        } else {
          echo the_post_thumbnail(array(940, 310));
        }
        
        endwhile; 
      ?>
  </div>
</div>

<script>
  $(window).load(function() {
    $('#slider').nivoSlider({
      pauseTime: 4000
    });
  });
</script>

<?php } ?>