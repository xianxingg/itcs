<?php
/**
 * Template Name: TABLE
 */

get_header(); ?>

<?php if (get_field('itcs_inner_title')) { ?>
  <div class="nav-title" style="padding-top: 20px; padding-left: 20px;">
    <a href style="text-decoration: none !important; cursor: text !important;"><?php the_field('itcs_inner_title') ?></a>
  </div>
<?php } ?>

<?php
global $post;
$slug = $post->post_name;
$orderby = "itcs_general_order_";
if ($slug == "research-publications") $orderby .= 'pub';

# echo "category_name=" . $slug . "&orderby=" . $orderby . "&order=asc";

$query = new WP_Query("category_name=" . $slug . "&orderby=" . $orderby . "&order=asc");

if ($query->have_posts()) { ?>
<div class="right" style="float: right; width: 940px;">
  
<?php if ($slug == 'research-publications') { ?>
  <span style="float: left;padding: 0 27px;color: #ae1831;">By Year: </span>
  <ul class="yearList">
    <li><a href='javascript:;' onclick="$('#tb tr').show()">All</a></li>
    <?php 
      global $wpdb;
      $years = $wpdb->get_col( $wpdb->prepare(
        "Select distinct(meta_value) From $wpdb->postmeta Where meta_key = 'itcs_year_pub' Order By meta_value desc"
      ));
      
      if ($years) {
        foreach ($years as $year) {
          echo '<li><a href="javascript:;" onclick="$(\'#tb tr\').eq(0).nextAll().hide(); $(\'.thesis_by_year_' . $year . '\').show();">' . $year . '</a></li>';
        }
      }
    ?>
  </ul>
<?php } ?>

  <table style="margin: 25px;" id="tb" class="researchList">
    <tr><th>Year</th><th>Title</th><th>Author</th><th>Journal</th></tr>
    <?php
    while ($query->have_posts()) : 
      $query->the_post();
      
      echo "<tr class='thesis_by_year_" . get_field('itcs_year_pub') . "'>";
      echo "<td>".get_field('itcs_year_pub')."</td>";
      echo "<td><a href='".get_field('itcs_download_url_pub')."' target='_blank'>".get_field('itcs_title_pub')."</a></td>";
      echo "<td>".get_field('itcs_author_pub')."</td>";
      echo "<td>".get_field('itcs_journal_pub')."</td>";
      echo "</tr>";
    endwhile;}
    ?>
  </table>
</div>

<?php get_footer(); ?>