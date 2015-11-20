<?php
/*
Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<div class="container mainWrap">
  <div class="row">
    <div class="col-sm-12">
      <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
      <div class="row entry" id="post-<?php the_ID(); ?>">
        <div class="col-sm-12">
          <h1><?php the_title(); ?></h1>
        </div>
        <div class="col-sm-6">
          <div class="entry" id="post-<?php the_ID(); ?>">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="mapWrap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3051.2557793142482!2d-74.05791099999999!3d40.114303!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x48c48abb1f7d30c5!2sKinetic+Knowledge!5e0!3m2!1sen!2sus!4v1400782809854" frameborder="0" style="border:0"></iframe>
          </div>
          <div class="entry-content">
            <ul class="contact">
              <li>
                <address>
                  <i class="fa fa-map-marker"></i>
                  <p>620 Harris Ave. 
                  <br>Brielle, NJ 08730
                  </p>
                </address>
              </li>
              <li>
                <i class="fa fa-phone"></i>
                <p>(732) 722 5915</p>
              </li>
              <li>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:contact@kineticknowledge.com">contact@kineticknowledge.com</a></p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <?php endwhile; endif; ?>
    </div><!-- col-sm-12 -->
  </div>
</div>
<?php get_footer(); ?>