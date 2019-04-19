<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

<div class="articles-grid">
	<div class="row">

<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'posts_per_page' => 1,
  'paged' => $paged,
  'post_type' => 'post'
);
$custom_query = new WP_Query( $args );
?>
          <!----start-------->
<div class="wrap">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

<?php
   while($custom_query->have_posts()) :
      $custom_query->the_post();
?>
       <div>
        <ul>
         <li>
           <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
        <div>
          <ul>
        <div><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
          </ul>
          <ul>
        <p><?php echo the_content(); ?></p>
          </ul>
        </div>
        <div>
          </li>
        </ul>
          </div> <!-- end blog posts -->
       <?php endwhile; ?>
      <?php if (function_exists("pagination")) {
          echo pagination($custom_query->max_num_pages);
      } ?>
</main><!-- #main -->
</div><!-- #primary -->
</div><!-- .wrap -->
          <!----end-------->
	</div>
</div>

<?php get_footer(); ?>