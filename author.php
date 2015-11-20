<?php get_header(); ?>
<div class="container mainWrap">
<div class="row">

    <div id="content">
    <div class="col-sm-8">
      <?php
      $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
      ?>
      <h1><?php echo $curauth->user_firstname . ' ' . $curauth->user_lastname; ?></h1>
      <div class="entry">
        <div class="row">
          <div class="col-sm-1">
            <ul class="social">
              <!-- <li><a href="http://facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li> -->
              <!-- <li><a href="http://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li> -->
              <?php 
                $googleProfile = $curauth->google_profile;
                if ( $googleProfile ) {
                  echo '<li><a href="' . esc_url($googleProfile) . '?rel=author" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
                };
                $linkedInProfile = $curauth->linkedin_profile;
                if ( $linkedInProfile ) {
                  echo '<li><a href="' . esc_url($linkedInProfile) . '?rel=author" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                };
              ?>

              <!-- <li><a href="http://youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a></li> -->
            </ul>
          </div>
          <div class="col-sm-11">
            <div class="entry-content">
              <p><?php echo $curauth->user_description; ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <hr>
            <h2>Most Recent Post:</h2>
            <article class="post">
              <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
              <div class="entry" id="post-<?php the_ID(); ?>">
                <div class="entry-content">
                  <?php the_excerpt(); ?>
                </div>
                <div class="read-more">
                  <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more</a>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
    </div>
  <?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>