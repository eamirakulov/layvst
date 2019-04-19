<?php
$qodef_blog_type = 'standard';
succulents_qodef_include_blog_helper_functions('lists', $qodef_blog_type);
$qodef_holder_params = succulents_qodef_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php succulents_qodef_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php do_action('succulents_qodef_before_main_content'); ?>
    <div class="<?php echo esc_attr($qodef_holder_params['holder']); ?>">
        <?php do_action('succulents_qodef_after_container_open'); ?>
        <div class="<?php echo esc_attr($qodef_holder_params['inner']); ?>">

       <style type="text/css">
       	#featured {
       		padding-bottom: 15px;
       		margin-bottom: 25px;
       		border-bottom: 1px dotted #000;
       	}
       </style>
	<div id="featured">
	<?php
	$q_args = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'relation' => 'OR',
				array(
				'key' => 'post_featured_position',
				'compare' => 'EXISTS'
				),
				array(
					'key' => 'post_featured_position',
					'compare' => 'NOT EXISTS'
				)
			),
			array(
				'relation' => 'AND',
				'key' => 'is_post_featured',
				'compare' => '=',
				'value' => 1
				)
			)
		);
		query_posts($q_args);

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="featured-thumb" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center; background-size: cover; height: 300px; width: 100%;"></div>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title();/*3*/ ?></a></h2>
		<p><?php the_excerpt(); ?></p>
		<p><a href="<?php the_permalink(); ?>">continue reading</a></p>
		<?php endwhile; ?> <?php wp_reset_query(); /*4*/ ?>
		</div>
            <?php succulents_qodef_get_blog($qodef_blog_type); ?>
        </div>
        <?php do_action('succulents_qodef_before_container_close'); ?>
    </div>
<?php do_action('succulents_qodef_blog_list_additional_tags'); ?>
<?php get_footer(); ?>