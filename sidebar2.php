<div id="sidebar" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('right'); } else { echo('left'); } ?>">
	

<?php if ( is_active_sidebar('sidebar') ) :  ?>
		<?php dynamic_sidebar('sidebar'); ?>
	<?php endif; ?>
	<div id="stickyadd">
    <div style="clear:both; padding: 0 0 5px 119px;">
      <a href="http://www.builtlean.com/advertising-policy/" rel="nofollow" style="color: #aaa"><small>Advertisement</small></a>
   </div>
<!--/* isocket Javascript Tag v2.0 */--><script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://d.adsbyisocket.com/ajs.php':'http://d.adsbyisocket.com/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=4066&block=1");
   document.write ('&cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&exclude=" + document.MAX_used);
   document.write (document.charset ? '&charset='+document.charset : (document.characterSet ? '&charset='+document.characterSet : ''));
   document.write ("&loc=" + escape(window.location));
   if (document.referrer) document.write ("&referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript> href='http://d.adsbyisocket.com/ck.php?n=a73c7009&cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://d.adsbyisocket.com/avw.php?zoneid=4066&cb=INSERT_RANDOM_NUMBER_HERE&n=a73c7009' border='0' alt='' /></a></noscript> 
	
	<div class="clear"></div>
    </div>
</div><!--end #sidebar-->