<?php
/*
Template Name Posts: New Post Template
*/
?>
<?php get_header(); ?>
<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">
	<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
	<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
<h1 class="post_title entry-title"><?php the_title(); ?></h1>		
		<div class="entry-meta">
		<div class="author-gravatar">
	<?php echo get_avatar( get_the_author_email(), '35' ); ?>
		</div>
	<?php _e('by ', 'themejunkie'); ?><span class="vcard"><span class="fn"><?php the_author_posts_link(); ?></span></span> <span class="meta-sep">|</span> <?php _e('', 'themejunkie'); ?> <span class="meta-date updated"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr> | </span> <span class="meta-date"><?php if( get_the_modified_date() != get_the_date()) echo ' Updated: ' . get_the_modified_date() . ' | '; ?></span>
		<span class="entry-comment">
	<?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
		</span>
		</div> 
		<div class="entry entry-content">
			<?php if(get_option('smartblog_integrate_singletop_enable') == 'on') echo (get_option('smartblog_integration_single_top')); ?>		
			<?php the_content(); ?>           
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>		
			<?php if(get_option('smartblog_integrate_singlebottom_enable') == 'on') echo (get_option('smartblog_integration_single_bottom')); ?>
		</div> <!--end .entry-->
        <div class="clear"></div>
        </div> <!--end #post-->
		<div style="clear:both; margin-left: 119px; margin-bottom: -3px;">
			<a style="color: #aaa" href="http://www.builtlean.com/advertising-policy/" rel="nofollow"><small>Advertisement</small></a>
		</div>
		<div style="float:left; clear:left; margin:5px 0 15px 0;">
    <!--/* isocket Javascript Tag v2.0 */-->
    <script type='text/javascript'>
	   var m3_u = (location.protocol=='https:'?'https://d.adsbyisocket.com/ajs.php':'http://d.adsbyisocket.com/ajs.php');
	   var m3_r = Math.floor(Math.random()*99999999999);
	   if (!document.MAX_used) document.MAX_used = ',';
	   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
	   document.write ("?zoneid=4067&block=1");
	   document.write ('&cb=' + m3_r);
	   if (document.MAX_used != ',') document.write ("&exclude=" + document.MAX_used);
	   document.write (document.charset ? '&charset='+document.charset : (document.characterSet ? '&charset='+document.characterSet : ''));
	   document.write ("&loc=" + escape(window.location));
	   if (document.referrer) document.write ("&referer=" + escape(document.referrer));
	   if (document.context) document.write ("&context=" + escape(document.context));
	   if (document.mmm_fo) document.write ("&mmm_fo=1");
	   document.write ("'><\/scr"+"ipt>");
			</script><noscript><a href='http://d.adsbyisocket.com/ck.php?n=aab52486&cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://d.adsbyisocket.com/avw.php?zoneid=4067&cb=INSERT_RANDOM_NUMBER_HERE&n=aab52486' border='0' alt='' /></a></noscript>
		</div>	
		<div class="related_p">
    <?php related_posts(); ?>
		</div>
		<div class="clear"></div>
	<?php if ( ! comments_open() ) : ?>
<!-- WE JUST HIDE IT FOR LATER USE :) -->
		<div class="comments-closed" style="display:none">
			<h3>Comments Are Now Closed</h3>
			<p>We close comments periodically on articles that generate more comments and questions than we can effectively moderate.  If you are a first time visitor looking to lose fat &amp; improve your health, we highly recommend reading our free <a href="http://www.builtlean.com/how-to-get-a-lean-body/" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| get lean guide link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked get lean guide', 'comment rules| get lean guide',, false]);">Get Lean Guide</a>.  If you have a question, we encourage you to join our <a href="http://www.facebook.com/builtlean" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| facebook link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked facebook link', 'comment rules| facebook link',, false]);">BuiltLean Facebook Community</a> where thousands of fans can help you.  Thank you for visiting our website!</p>
		</div>
<?php endif; ?>

			

	<?php if(get_option('smartblog_show_post_comments') == 'on') comments_template( '', true ); ?>

</div><!--end #content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
