<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/content', 'nivo' ); ?>

<div class="row">
	<div class="span8">
		<div class="row">
			<div class="span4">				
				<div class="nav-title">
					<a href="/index.php/seminars">SEMINARS</a>
				</div>
				<ul class="news">
					
				<?php
					$query_seminar = new WP_Query(
						array(
							'category_name' => 'seminars',
							'showposts' => 5,
							"meta_key" => "itcs_general_order_evt",
      				"orderby" => array( "meta_value_num" => "desc", "date" => "desc")
						)
					);
					
					if ($query_seminar->have_posts()) {
					while ($query_seminar->have_posts()) : $query_seminar->the_post();
						echo "<dl class='conference-home'><dt>" . str_replace("-", ".", get_field('itcs_event_date_start'));
						if (get_field('itcs_event_date_start') != get_field('itcs_event_date_end')): echo " - " . str_replace("-", ".", get_field('itcs_event_date_end')); endif; 
						echo "</dt><dd><a href='" . get_the_permalink() . "' target='_blank'>" . get_the_title() . "</a></dd></dl>";
					endwhile;
					}
				?>
				
				</ul>
				<div class="more" style="margin:0">
					<a href="/index.php/seminars">MORE  »</a>
				</div>
			</div>

			<div class="span4">
				<div class="nav-title">
					<a href="/index.php/events/conferences-workshops">CONFERENCES &amp; WORKSHOPS</a>
				</div>
				
				<?php
					$query_conf = new WP_Query(
						array(
							'category_name' => 'conferences_workshops',
							'showposts' => 5,
							"meta_key" => "itcs_general_order_evt",
      				"orderby" => array( "meta_value_num" => "desc", "date" => "desc")
						)
					);
					
					if ($query_conf->have_posts()) {
					while ($query_conf->have_posts()) : $query_conf->the_post();
						echo "<dl class='conference-home'><dt>" . str_replace("-", ".", get_field('itcs_event_date_start')) . " - " . str_replace("-", ".", get_field('itcs_event_date_end')) . "</dt><dd><a href='" . get_the_permalink() . "' target='_blank'>" . get_the_title() . "</a></dd></dl>";
					endwhile;
					}
				?>
				<div class="more">
					<a href="/index.php/events/conferences-workshops">MORE  »</a>
				</div>
			</div>
		</div>
	</div>

	<div class="span4">
		<div class="nav-title">
			<a href="/index.php/events/summer-winter-schools">SUMMER &amp; WINTER SCHOOLS</a>
		</div>
		
		<?php
			$query_conf = new WP_Query(
				array(
					'category_name' => 'summer_winter_schools',
					'showposts' => 5,
					"meta_key" => "itcs_general_order_evt",
					"orderby" => array( "meta_value_num" => "desc", "date" => "desc")
				)
			);
			
			if ($query_conf->have_posts()) {
			while ($query_conf->have_posts()) : $query_conf->the_post();
				echo "<dl class='conference-home'><dt>" . str_replace("-", ".", get_field('itcs_event_date_start')) . " - " . str_replace("-", ".", get_field('itcs_event_date_end')) . "</dt><dd><a href='" . get_the_permalink() . "' target='_blank'>" . get_the_title() . "</a></dd></dl>";
			endwhile;
			}
		?>
		<div class="more">
			<a href="/index.php/events/summer-winter-schools">MORE »</a>
		</div>
	</div>

</div>

<div class="text-center" style="text-align: center;">
	<h4 style="display: inline-block;padding: 8px;color: #660022;background: #fff; margin-bottom: 20px; color: #ae1831;">VISITORS</h4>
	<hr style="margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px dotted #660022;margin-top: -35px;">
</div>

<div id="wrap3" class="wrap pc-gundong" style="margin-top: 25px; height: 50px !important;">
	<?php
		$query_visitor = new WP_Query('category_name=visitors&orderby=itcs_general_order_acd&order=desc');
		
		if ($query_visitor->have_posts()) {
			echo "<ul>";
			while ($query_visitor->have_posts()) : $query_visitor->the_post();
			
			echo "<li><a href='" .get_field('itcs_person_homepage_acd') . "' target='_blank' onmouseover=\"Tip('Name：" . get_field('itcs_person_name_acd') . "<br>Uni: " . get_field('itcs_person_from_acd') . "<br>Time: " . get_field('itcs_visit_date_from') . "~" . get_field('itcs_visit_date_to') . "')\" onmouseout=\"UnTip()\">" . get_field('itcs_person_name_acd') ."<br><span class='color_primary'> " . get_field('itcs_visit_date_from') . " </span> </a> </li>";
			
			endwhile;
			echo "</ul>";
		}
	?>
</div>
<script>$('#wrap3').marquee({auto: true,interval: 300000,speed: 500,showNum: 4,stepLen: 4}); $("#wrap3").css("height", "40px");</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wz_tooltip.js"></script>

<?php get_footer(); ?>
