<?php
	
// Do not delete these lines

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'themejunkie') ?></p>

<?php return; } ?>

<?php $comments_by_type = &separate_comments($comments); ?>    

<!-- You can start editing here. -->

<div id="comments">

<?php if ( have_comments() ) : ?>

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

		<h3><?php comments_number(__('No Responses', 'themejunkie'), __('One Response', 'themejunkie'), __('% Responses', 'themejunkie') );?> <?php _e('to', 'themejunkie') ?> &#8220;<?php the_title(); ?>&#8221;</h3>

		<ol class="commentlist">
	
			<?php wp_list_comments('avatar_size=35&callback=custom_comment&type=comment'); ?>
		
		</ol>    

		<div class="navigation">
			<div class="left"><?php previous_comments_link() ?></div>
			<div class="right"><?php next_comments_link() ?></div>
			<div class="clear"></div>
		</div><!-- /.navigation -->
	<?php endif; ?>
		    
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    		
        <h3 id="pings"><?php _e('Trackbacks/Pingbacks', 'themejunkie') ?></h3>
    
        <ol class="pinglist">
            <?php wp_list_comments('type=pings&callback=list_pings'); ?>
        </ol>
    	
	<?php endif; ?>
    	
<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->
			<p class="nocomments"><?php _e('No comments yet.', 'themejunkie') ?></p>

		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e('Comments are closed.', 'themejunkie') ?></p>

		<?php endif; ?>

<?php endif; ?>

<?php if ( ! comments_open( $post_id )) : ?>
<div class="comments-closed">
	<h4>Comments Are Closed</h4>
	<p>Comments are closed 30 days after an article is published (See our <a href="http://www.builtlean.com/comment-policy/" target="_blank" rel="nofollow">Comment Policy</a>).  If you are a first time visitor looking to lose fat &amp; improve your health, we highly recommend reading our free <a href="http://www.builtlean.com/how-to-get-a-lean-body/" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| get lean guide link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked get lean guide', 'comment rules| get lean guide',, false]);"><b>Get Lean Guide</b></a>.  If you have a question, we encourage you to join our <a href="http://www.facebook.com/builtlean" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| facebook link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked facebook link', 'comment rules| facebook link',, false]);"><b>BuiltLean Facebook Community</b></a> where thousands of fans can help you.  Thank you for visiting our website!</p>
</div>
<?php endif; ?>

</div><!-- /#comments_wrap -->

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

	<h3><?php comment_form_title( __('Leave a Comment', 'themejunkie'), __('Leave a Reply to %s', 'themejunkie') ); ?></h3>
	
	<div class="info-block">
		<p><strong><a href="http://www.builtlean.com/comment-policy/" target="_blank" rel="nofollow">Comment Rules</strong></a> &ndash; If you have a lengthy personal fitness question, or one that is not related to the article, please post it to our <a href="http://www.facebook.com/builtlean" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| facebook link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked facebook link', 'comment rules| facebook link',, false]);">BuiltLean Facebook Community Page</a> where we have thousands of fitness enthusiasts who can help you.  If you are new to BuiltLean, we recommend checking out our free <a href="http://www.builtlean.com/how-to-get-a-lean-body/" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| get lean guide link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked get lean guide', 'comment rules| get lean guide',, false]);">Get Lean Guide</a>, which can help answer many of your questions. We're excited for you to join the conversation!</p>
	</div>
	
	<div class="cancel-comment-reply">
		<small><?php cancel_comment_reply_link(); ?></small>
	</div><!-- /.cancel-comment-reply -->

	<?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

		<p><?php _e('You must be', 'themejunkie') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'themejunkie') ?></a> <?php _e('to post a comment.', 'themejunkie') ?></p>

	<?php else : //No registration required ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( $user_ID ) : //If user is logged in ?>

			<p><?php _e('Logged in as', 'themejunkie') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'themejunkie') ?>"><?php _e('Logout', 'themejunkie') ?> &raquo;</a></p>

		<?php else : //If user is not logged in ?>

			<p>
				<input type="text" name="author" class="txt" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				<label for="author"><?php _e('Name', 'themejunkie') ?> <?php if ($req) ?> (<?php _e('Required', 'themejunkie'); ?>) <?php ; ?></label>
			</p>

			<p>
				<input type="text" name="email" class="txt" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				<label for="email"><?php _e('Mail (will not be published)', 'themejunkie') ?> <?php if ($req) ?> (<?php _e('Required', 'themejunkie'); ?>) <?php ; ?></label>
			</p>

			<p>
				<input type="text" name="url" class="txt" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<label for="url"><?php _e('Website', 'themejunkie') ?></label>
			</p>

		<?php endif; // End if logged in ?>

		<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'themejunkie'); ?>: <?php echo allowed_tags(); ?></p>-->

		<p><textarea name="comment" id="comment" rows="10" cols="50" tabindex="4"></textarea></p>

		<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment', 'themejunkie') ?>" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

		</form><!-- /#commentform -->

	<?php endif; // If registration required ?>

	<div class="fix"></div>

</div><!-- /#respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
