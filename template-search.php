<?php
/*
Template Name: Search Template
*/
?>
<?php get_header(); ?>
<div class="container mainWrap">
  <div class="row">
    <div id="content">
      <div class="col-sm-8">
        <h1>Search Site</h1>
        <div class="entry">
          <div class="row">
            <div class="col-sm-12">
              <div class="entry-content">
                <?php get_search_form(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>