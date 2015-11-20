<div class="container mainWrap">
  <footer>
    <div class="row">
      <div class="col-sm-5">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) :  endif; ?>
      </div>
      <div class="col-sm-4">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) :  endif; ?>
      </div>
      <div class="col-lg-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) :  endif; ?>
      </div>
    </div>
    <div class="row" id="subFooter">
      <div class="col-sm-12">
        <p align="right"><a href="http://Kineticknowledge.com" title="Kinetic Knowledge">responsive web design by Kinetic Knowledge</a> - <a href="/wp-login.php">log in</a></p>
      </div>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.carousel').carousel({
      interval: 8000
    })
  })
</script>

<!-- UI jQuery (For Module #5 and #6) -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js" type="text/javascript"></script>
<!-- Bootstrap Select Tool (For Module #4) -->
<script src="<?php echo get_template_directory_uri(); ?>/switcher/js/bootstrap-select.js"></script>
<!-- Evol Color Picker jQuery (For Module #5 and #6) -->
<script src="<?php echo get_template_directory_uri(); ?>/switcher/js/evol.colorpicker.min.js" type="text/javascript"></script>
<!-- All Scripts & Plugins -->
<script src="<?php echo get_template_directory_uri(); ?>/switcher/js/dmss.js"></script>

<?php wp_footer(); ?>
</body>
</html>