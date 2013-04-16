<?php get_header(); ?>
	
<div id="content" class="archive <?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">	
	<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
<div id="content-loop" class="<?php if(get_option('smartblog_content_layout') == 'Layout #1') { echo('layout1-content-loop'); }?>">
	<?php if ( have_posts() ) : ?>
<div id="cse" style="width: 644px;">Loading</div>

	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	  <script type="text/javascript"> 
	     function parseQueryFromUrl () {
		   var queryParamName = "s";
	       var search = window.location.search.substr(1);
	 	   var parts = search.split('&');
		    for (var i = 0; i < parts.length; i++) {
		      var keyvaluepair = parts[i].split('=');
		     if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
	      return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
		 }
	  }
return '';
 }
		google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
		google.setOnLoadCallback(function() {
			var customSearchOptions = {};
			var customSearchControl = new google.search.CustomSearchControl(
			  '013455458792431772096:WMX-725798303', customSearchOptions);
			customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
			var options = new google.search.DrawOptions();
			options.setAutoComplete(true);
			customSearchControl.draw('cse', options);
			var queryFromUrl = parseQueryFromUrl();
			if (queryFromUrl) {
			  customSearchControl.execute(queryFromUrl);
			}
		  }, true);
		</script>
<?php endif; ?>        
<?php wp_reset_query(); ?>			
	<div class="clear"></div>
	</div><!--end #content-loop-->	
	<div class="clear"></div>			
</div>
<!--end #content-->	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
