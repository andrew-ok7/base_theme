<?php get_header(); ?>
<div class="main">
  <div class="container wrap">
    <div class="row">
      <div class="col-sm-12">
        <!-- Carousel
        ================================================== -->
        <div id="myCarousel" class="carousel slide" style="margin: 0 auto">
          <div class="carousel-inner">
          <?php
            $args = array('post_type' => 'slide', 'posts_per_page' => 99, 'order' => 'DESC');
            $loop = new WP_Query($args);
            $i = 1;
            while ($loop->have_posts()) : $loop->the_post(); 
            $sliderData = get_post_meta($post->ID, 'slides_slider', TRUE); 
            $slidesImageUrl = $sliderData['slides_imageurl'];
           
            $sliderImgInfo   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "slider" );
            $sliderImgUrl    = $sliderImgInfo[0];

            //caption for slides
            if (isset($sliderData['slides_caption'])) {  
              if (isset($sliderData['slides_imageurl'])) {
              $slidesCaption  = '<div class="container"><div class="carousel-caption"><h3>' . $sliderData['slides_caption'] . '</h3></div></div>'; 
              } else {
              $slidesCaption  = '<div class="container"><div class="carousel-caption"><h3>' . $sliderData['slides_caption'] . '</h3></div></div>'; 
              }
            }
            ?>
            <div class="item <?php if($i == 1){ echo 'active';}?>">
            <a href="<?php echo $slidesImageUrl; ?>">
              <div class="imgSlideWrap"><img class="img-responsive" src="<?php echo $sliderImgUrl; ?>" alt="<?php echo $i;?> slide"></div>
              <?php if ($sliderData['slides_caption']!= '') { echo $slidesCaption; } ?>
            </a>
            </div>
            <?php $i++;endwhile;wp_reset_query(); ?>   
          </div>
          <!-- Indicators -->
          <ol class="carousel-indicators">
          <?php
            $args = array('post_type' => 'slide', 'posts_per_page' => 99, 'order' => 'ASC');
            $loop = new WP_Query($args);
            $i = 1;
            while ($loop->have_posts()) : $loop->the_post(); 
          ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i-1; ?>" class="<?php if($i == 1){ echo 'active';}?>"></li>
          <?php $i++;endwhile;wp_reset_query(); ?>
          </ol>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div><!-- /.carousel -->
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home 1') ) :  endif; ?>
      </div><!-- /.col-lg-12 -->
    </div>
    <div class="row">
      <div class="col-lg-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home 2') ) :  endif; ?>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home 3') ) :  endif; ?>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home 4') ) :  endif; ?>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home 5') ) :  endif; ?>
      </div><!-- /.col-lg-3 -->
    </div>
  </div>
</div>
<?php get_footer(); ?>