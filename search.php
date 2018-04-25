<!--#Template divi for search results-->
<?php get_header(); ?>
<div class="et_pb_section et_pb_fullwidth_section  et_pb_section_0 et_section_regular et_pb_section_first"><!--#Add slider to the header-->
				
					<div class="et_pb_module et_pb_slider et_pb_slider_no_arrows et_pb_slider_no_pagination mi-slider et_pb_fullwidth_slider_0 et_pb_bg_layout_dark">
				<div class="et_pb_slides">
					<div class="et_pb_slide et_pb_bg_layout_dark et_pb_media_alignment_center et_pb_slide_0 et-pb-active-slide et_pb_section_parallax" data-fix-page-container="on" style="padding-top: 101px;">
				<span class="et_parallax_bg et_pb_parallax_css" style="background-image: url(-----------------------YOUR OWN IMAGE URL-----------------------);"></span>
				
				<div class="et_pb_container clearfix et_pb_empty_slide" style="height: 250px; min-height: 700px;" data-fix-page-container="on">
					<div class="et_pb_slider_container_inner">
						
						<div class="et_pb_slide_description">
							
							<div class="et_pb_slide_content"></div>
							
						</div> <!-- .et_pb_slide_description -->
					</div>
				</div> <!-- .et_pb_container -->
				
			</div> <!-- .et_pb_slide -->
			
				</div> <!-- .et_pb_slides -->
			</div> <!-- .et_pb_slider -->
				
			</div><!--#Close header slider-->
<!--#Page Content-->
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
	<?php if ( have_posts() ) : ?><!-- #Add title to the search -->
		<header class="blog-title">
			<h2><?php printf( __( 'Search rsults for: %s', 'Divi' ), '<span>' . get_search_query() . '</span>' ); ?></span></h2>
			<hr class="results_title_line">
		</header>
	<?php endif; ?><!-- #End Add title to the search-->						
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$post_format = et_pb_post_format(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_pb_post_main_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					et_divi_post_format_content();

					if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
						if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
							printf(
								'<div class="et_main_video_container">
									%1$s
								</div>',
								$first_video
							);
						elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
							</a>
					<?php
						elseif ( 'gallery' === $post_format ) :
							et_pb_gallery_images();
						endif;
					} ?>

				<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
					<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>

					<?php
						et_divi_post_meta();

						if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
							truncate_post( 270 );
						} else {
							the_content();
						}
					?>
				<?php endif; ?>

					</article> <!-- .et_pb_post -->
			<?php
					endwhile;

					if ( function_exists( 'wp_pagenavi' ) )
						wp_pagenavi();
					else
						get_template_part( 'includes/navigation', 'index' );
				else :
					get_template_part( 'includes/no-results', 'index' );
				endif;
			?>
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?> <!-- #Show right sidebar	-->
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>