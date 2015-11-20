<?php get_header(); ?>
<div class="container mainWrap">
  <div class="row">
    <div class="col-sm-8">
      <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
      <div class="row entry" id="post-<?php the_ID(); ?>">
        <div class="col-sm-12">
          <h1><?php the_title(); ?></h1>
        </div>
        <div class="col-sm-12">
          <div class="entry" id="post-<?php the_ID(); ?>">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; endif; ?>
    </div><!-- col-sm-8 -->
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>