<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>  	
	<?php die('You can not access this page directly!'); ?>  
<?php endif; ?>

<?php if(!empty($post->post_password)) : ?>
  	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p>This post is password protected. Enter the password to view comments.</p>
  	<?php endif; ?>
<?php endif; ?>

<?php if($comments) : ?>
<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
  	<ol class="list-group">
    	<?php foreach($comments as $comment) : ?>
  		<li class="list-group-item" id="comment-<?php comment_ID(); ?>">
  			<?php if ($comment->comment_approved == '0') : ?>
  				<p>Your comment is awaiting approval</p>
  			<?php endif; ?>
  			<?php comment_text(); ?>
  			<p class="meta"><?php comment_type(); ?> by <?php comment_author_link(); ?> on <?php comment_date(); ?> at <?php comment_time(); ?></p>
  		</li>
		<?php endforeach; ?>
	</ol>
<?php else : ?>
	<p>No comments yet</p>
<?php endif; ?>

<?php if(comments_open()) : ?>
	<?php if(get_option('comment_registration') && !$user_ID) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>
		<form role="form" class="form-horizontal" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if($user_ID) : ?>
				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
			<?php else : ?>
				<div class="form-group">
          <label for="author" class="col-sm-3 control-label"><small>Name <?php if ($req) echo "(required)"; ?></small></label>
          <div class="col-sm-7">  
            <input type="text" class="form-control" placeholder="Enter name" name="author" id="author" value="<?php echo $comment_author; ?>" size="30" tabindex="1" />
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label"><small>Email <?php if ($req) echo "(required)"; ?></small></label>
          <div class="col-sm-7">  
            <input type="text" class="form-control" placeholder="Enter email (will not be published)" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="30" tabindex="1" />
          </div>
        </div>
        <div class="form-group">
          <label for="url" class="col-sm-3 control-label"><small>Website</small></label>
          <div class="col-sm-7">  
            <input type="text" class="form-control" placeholder="Enter website" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="30" tabindex="1" />
          </div>
        </div>
			<?php endif; ?>
        <div class="form-group">
          <label for="comment" class="col-sm-3 control-label"><small>Comment</small></label>
          <div class="col-sm-7">  
            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-7 col-sm-offset-3">  
            <p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?><br /><?php echo allowed_tags(); ?></small></p>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-7 col-sm-offset-3">  
            <button name="submit" type="submit" id="submit" type="submit" class="btn btn-default">Submit Comment</button>
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
          </div>
        </div>
			<?php do_action('comment_form', $post->ID); ?>
		</form>
	<?php endif; ?>
<?php else : ?>
	<p>The comments are closed.</p>
<?php endif; ?>