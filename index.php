<?php get_header(); ?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$post_format = et_pb_post_format(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height    = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_pb_post_main_image';
					$titletext = get_the_title();
					$alttext   = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
					$thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
					$thumb     = $thumbnail["thumb"];

					et_divi_post_format_content();

					if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
						if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
							printf(
								'<div class="et_main_video_container">
									%1$s
								</div>',
								et_core_esc_previously( $first_video )
							);
						elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
							<a class="entry-featured-image-url" href="<?php the_permalink(); ?>">
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

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<style>

.container--loader .logo {
  height: 10vh;
  padding: 3vh;
  box-sizing: border-box;
  animation: pulseSVG infinite 5s ease-in-out;
}

.container--loader .logo svg {
  width: 100%;
  height: 100%;
}

.container--loader {
  display: grid;
  place-content: center;
  background-image: linear-gradient(150deg, #f90008, #ffb71b, #2ed9c4, #3f72a3, #6b49a9);
  height: 100vh;
  background-size: 400% 400%;
  animation: bg_redpeg 15s ease infinite;
  -moz-animation: bg_redpeg 15s ease infinite;
  animation: bg_redpeg 15s ease infinite;
}
@keyframes bg_redpeg {
    0%{background-position:50% 0%}
    50%{background-position:50% 100%}
    100%{background-position:50% 0%}
}
@-moz-keyframes bg_redpeg {
    0%{background-position:50% 0%}
    50%{background-position:50% 100%}
    100%{background-position:50% 0%}
}
@keyframes bg_redpeg {
    0%{background-position:50% 0%}
    50%{background-position:50% 100%}
    100%{background-position:50% 0%}
}


.container--loader .cube {
  transform-style: preserve-3d;
  animation: spin 12s infinite linear;
  position: relative;
  width: 15vh;
  height: 15vh;
  top: 50%;
  left: 50%;
  margin-left: -50px;
  margin-top: -50px;
}

.container--loader .cube div {
   width: 15vh;
   height: 15vh;
   line-height: 15vh;
   text-align: center;
   box-shadow: inset 0px 0px 0px 3px rgba(255, 255, 255, 1);
   display: block;
   position: absolute;

}

.container--loader .cube div.top {
  transform: rotateX(90deg); 
  margin-top: -7.5vh;
  animation: pulse 0.5s infinite ease-out;
}

.container--loader .cube div.right {
  transform: rotateY(90deg); 
  margin-left: 7.5vh;
  animation: pulse 0.75s infinite ease-out;  
}

.container--loader .cube div.bottom {
   transform: rotateX(-90deg); 
  margin-top: 7.5vh;
  animation: pulse 1s infinite ease-out;  
}

.container--loader .cube div.left {
   transform: rotateY(-90deg); 
  margin-left: -7.5vh;
  animation: pulse 1.25s infinite ease-out;  
}

.container--loader .cube div.front {
   transform: translateZ(7.5vh);
  animation: pulse 1.5s infinite ease-out;  
}

.container--loader .cube div.back {
  transform: translateZ(-7.5vh) rotateX(180deg);
  animation: pulse 1.75s infinite ease-out;  
}

@keyframes spin {
  0% {transform: rotateX(27deg) rotateY(44deg);}
  100% {transform: rotateX(387deg) rotateY(404deg);}
}

@keyframes pulse {
  0% {background-color: transparent;}
  80% {background-color: rgba(255,255,255,0.4);}
  100% {background-color: transparent;}
}

@keyframes pulseSVG {
  0% {fill: transparent;}
  70% {fill: rgba(255,0,0,0.4);}
  100% {fill: transparent;}
}

.container--loader .spinner {
  margin: 100px auto;
  width: 50px;
  height: 40px;
  text-align: center;
  font-size: 10px;
}

.container--loader .spinner > div {
  background-color: rgba(255,255,255,0.8);
  height: 100%;
  width: 6px;
  display: inline-block;
  
  animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.container--loader .spinner .rect2 {
  animation-delay: -1.1s;
}

.container--loader .spinner .rect3 {
  animation-delay: -1.0s;
}

.container--loader .spinner .rect4 {
  animation-delay: -0.9s;
}

.container--loader .spinner .rect5 {
  animation-delay: -0.8s;
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% { transform: scaleY(0.4) }  
  20% { transform: scaleY(1.0) }
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% { 
    transform: scaleY(0.4);
    transform: scaleY(0.4);
  }  20% { 
    transform: scaleY(1.0);
    transform: scaleY(1.0);
  }
}
</style>

<div class="container--loader">
  
  <div class="container--spinner">
    
    <div class="wrapper--cube">
    
      <div class="cube">
        <div class="top"></div>
        <div class="right">
          
        </div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="front">
          <div class="logo">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 87.65 217.19"><path d="M36.918 216.648c-7.61-1.363-10.428-2.86-10.998-5.848-.278-1.46-.786-8.278-1.13-15.153-.342-6.875-.846-13.288-1.119-14.25-.44-1.555.338-1.75 6.984-1.75 8.145 0 22.423-2.368 24.043-3.988.683-.683-3.037-1.014-11.438-1.018-16.057-.008-28.912-2.052-33.364-5.308-1.709-1.25-2.196-7.568-6.285-81.588C.283 27.515-.54 7.17.313 6.144 2.08 4.014 13.656 1.794 29.59.529 51.815-1.235 82.724 1.633 86.942 5.85c1.22 1.22.988 12.213-1.685 79.856-1.705 43.143-3.307 79.482-3.559 80.756-.478 2.411-6.988 6.106-10.888 6.178-4.263.08-4.51.995-5.525 20.48-.567 10.882-1.451 19.395-2.094 20.17-2.452 2.954-17.666 4.898-26.273 3.358z"/></svg>
          </div>
        </div>
        <div class="back">
          
        </div>
      </div>

    
      <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
      </div>
  </div>
    
</div>
<?php

get_footer();
