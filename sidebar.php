<div id="sidebar" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('right'); } else { echo('left'); } ?>">
	
<div class="optinbox">
      <form action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" onSubmit="_gaq.push(['_setCustomVar', 1, 'newsletter sign up', 'top right opt-in', 1]);_gaq.push(['_trackEvent', 'newsletter', 'sign up', 'top right opt-in']);" method='POST'>
         <input type="hidden" name="infusion_xid" id="infusion_xid" value="7b5c4c539110daaf295e6bf49596ccc0" />
         <input type="hidden" name="infusion_type" id="infusion_type" value="CustomFormWeb" />
         <input type="hidden" name="infusion_name" id="infusion_name" value="New Lead" />

         <div class="optinbox-email">
            <input size="42" type="text" onblur="if (this.value == '') {this.value = 'Enter your email...';}" onfocus="if (this.value == 'Enter your email...') {this.value = '';}" name="Contact0Email" id="Contact0Email" value="Enter your email..." />
         </div>
         <div class="optinbox-submit">
            <input type="submit" name="Submit" value="Submit" />
         </div>
      </form>
      <div class="optinbox-privacy">
         <span>Your email is safe and secure per our <a href="http://www.builtlean.com/privacy-policy/" rel="nofollow" target="_blank">privacy policy</a></span>
      </div>      
</div>


<div class="sidebar-block">


</div>


<!-- 	
  <div id="optinbox">
<div id="signupbox">
		
<div id="sidebar-form">
<form action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" method='POST'>
<input type="hidden" name="infusion_xid" id="infusion_xid" value="7b5c4c539110daaf295e6bf49596ccc0" />
<input type="hidden" name="infusion_type" id="infusion_type" value="CustomFormWeb" />
<input type="hidden" name="infusion_name" id="infusion_name" value="New Lead" />


<table>
                


<tr><td><input size="42" type="text" onblur="if (this.value == '') {this.value = 'Enter your email...';}" onfocus="if (this.value == 'Enter your email...') {this.value = '';}" name="Contact0Email" id="Contact0Email" value="Enter your email..." class="default-input" /></td></tr>




                <tr><td colspan="2"><input style="border:none; margin-left:-16px;" type="image" name="Submit" value="Submit" src="<?php bloginfo('template_url'); ?>/images/btn-optin-submit.png" class="optin-submit"></td></tr>
</table>

              
</form>

<div id="privacy_alt">
<a href="http://www.builtlean.com/privacy-policy/" rel="nofollow" target="_blank">View privacy policy>></a>
</div>



</div>

</div>

</div>

-->

<?php if ( is_active_sidebar('sidebar') ) :  ?>
		<?php dynamic_sidebar('sidebar'); ?>
	<?php endif; ?>

	<div id="stickyadd" class="scroll-element">
    <div style="clear:both; padding: 0 0 5px 119px;">
      <a href="http://www.builtlean.com/advertising-policy/" rel="nofollow" style="color: #aaa"><small>Advertisement</small></a>
   </div>
<div>
<a href="http://www.builtlean.com/how-to-get-a-lean-body" onclick="_gaq.push(['_setCustomVar', 1, 'internal ad', 'bottom right sidebar | get lean guide landing page | only 3 workouts per week', 2]);_gaq.push(['_trackEvent', 'internal ad', 'clicked bottom right sidebar | get lean guide landing page', 'medium rectangle | only 3 workouts per week',, false]);"> <img src="http://www.builtlean.com/wp-content/uploads/2012/06/mediumrectangle1.jpg" width="300" height="250" border="0"></a></div>    
    
	</div>
	<div class="clear"></div>
</div>

	<div class="clear"></div>

</div><!--end #sidebar-->