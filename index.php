<?php get_header(); ?>
<div class="container mainWrap">
  <div class="row">
    <div class="col-sm-8">
      <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
      <div class="row entry" id="post-<?php the_ID(); ?>">
        <div class="col-sm-4">
          <div class="thumbnail"><img class="image-responsive" src="http://placehold.it/300x300"></div>
        </div>
        <div class="col-sm-8">
          <article class="post">
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-meta">
              <span class="date"><i class="fa fa-calendar"></i><?php the_time('l, F jS, Y') ?></span>
              <span class="author"><i class="fa fa-user"></i>By <?php the_author_posts_link(); ?></span>
              <!-- <span class="comments"><i class="fa fa-comment"></i><a href="">Comments</a></span> -->
              <span class="entry-categories"><i class="fa fa-tag"></i>Posted in: <?php the_category(',') ?></span>
              <!-- <span class="entry-tags"><i class="fa fa-tags"></i><?php the_tags('Tags: ', ', '); ?></span> -->
            </div>
            <div class="entry-content">
              <?php the_excerpt(); ?>
            </div>
          </article>
        </div>
      </div>
      <?php endwhile; ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="pagination">
            <div class="pull-left"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i>Previous' ) ?></div>
            <div class="pull-right"><?php next_posts_link('Next <i class="fa fa-chevron-right"></i>', 0); ?></div>
          </div>
        </div>
      </div>
      <?php else : ?>
      <div class="row">
        <div class="col-sm-12">
          <h2><?php _e('Not Found'); ?></h2>
        </div>
      </div>
      <?php endif; ?>  
    </div><!-- col-sm-8 -->
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>