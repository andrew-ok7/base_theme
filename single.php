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
          <article class="post">
            <div class="entry-meta">
              <span class="date"><i class="fa fa-calendar"></i><?php the_time('l, F jS, Y') ?></span>
              <span class="author"><i class="fa fa-user"></i>by <?php the_author_posts_link(); ?></span>
            </div>
            <div class="entry" id="post-<?php the_ID(); ?>">
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </div>
            <hr>
            <div class="entry-meta">
              <?php $cats = get_the_category(); ?>
              <?php if ($cats) { ?>
              <span class="entry-categories">
                <i class="fa fa-tag"></i>Posted in: <?php $sep = ''; foreach($cats as $cat) { echo $sep.'<a href="'.get_category_link($cat->term_id).'">'.$cat->cat_name.'</a>'; $sep = ', '; } ?> 
              </span>
              <?php } ?>
            </div>
          </article>
        </div>
      </div>
      <!--<div class="row">
        <div class="col-sm-12">
          <div class="post-author">
            <div class="col-xs-4">
              <img src="http://placehold.it/200x200" alt="Banner" class="img-responsive img-circle" />
            </div>
            <div class="col-xs-8">
              <h5>About The Author</h5>
              <p>Fusce sit amet luctus magna. Donec nec purus non orci vestibulum hendrerit ut non ligula. Pellentesque aliquet luctus nisi nec tristique. Aliquam eget suscipit est. Suspendisse vehicula consectetur ante et tincidunt. Fusce sit amet velit purus. Praesent lorem ante, eleifend vitae congue eget, consequat ac massa. Mauris rutrum feugiat magna, ac blandit lorem vulputate a. Morbi nec pharetra massa. Morbi sollicitudin iaculis lacus, at varius mi tincidunt ut. Curabitur lobortis suscipit ante, eu suscipit mauris porta vitae.</p>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div> -->
      <div class="row">
        <div class="col-sm-12">
          <?php comments_template(); ?>
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