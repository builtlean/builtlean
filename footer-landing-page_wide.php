	<div class="clear"></div>
		<div id="footer">
		<div class="copyright">		
		<div class="wrap" style="font-size:12px; color:#888; margin-top:10px;">
		<div align="center">
		<img src="http://www.builtlean.com/wp-content/themes/builtlean/images/footer_logo.jpg" width="189" height="25" alt="logo"/>
		</div>
		<p align="center">Copyright &copy; 2013 BuiltLean. All Rights Reserved. <a href="http://www.builtlean.com/privacy-policy/" rel="nofollow">Privacy Policy</a> | <a href="http://www.builtlean.com/terms-of-use" rel="nofollow">Terms of Use</a></p>
		<p align="center">* This website is for informational purposes only and is no way intended as medical counseling, or medical advice.<br /> Results may vary. Proper diet and exercise are necessary to achieve weight loss and muscle definition. <br />Photo testimonials shown are of people who worked very hard to get great results and are not typical.</p>
	<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>												
	</div>
<?php wp_footer(); ?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var $country = jQuery('#country');
				if ($country.val() == 'United States' || $country.val() == 'Canada') {
				jQuery('#stateRequired').html('* State');
			}
				if ($country.length > 0 &#038;& "SELECT" == $country.get(0).tagName) {
				$country.change(function() {
				if ($country.val() == 'United States' || $country.val() == 'Canada') {
				jQuery('#stateRequired').html('* State');
			} else {
			jQuery('#stateRequired').html('State');
			}
		});
			}
		});
			jQuery('#addressLine1, #city, #zipCode, #country, #state').change(function() {
				var $country = jQuery('#country');
				var stateRequired = false;
				if ($country.val() == 'United States' || $country.val() == 'Canada') {
					stateRequired = true;
				}
				Infusion.Ecomm.OrderForms.submitFormUponChangeOnBilling('orderForm', '90b0bbae-fb36-498c-bc57-78625ef4dd90', 'RENDER_ORDER_FORM', stateRequired);

		});

		</script>
		<script type="text/javascript">// <![CDATA[
				jQuery(window).load(function() {
				regula.custom({
				name: "StateRequiredForSpecificCountries",
				defaultMessage: '{label} is required.',
				params: ["countryFieldName"],
				validator: function(params) {
				var validated = true;
				var $countryField = jQuery('#' + params["countryFieldName"]);
				if ($countryField.val() == 'United States' || $countryField.val() == 'Canada') {
				if (jQuery(this).val() == '') {
				validated = false;
			}
			}
				return validated;
			}
			});
				regula.bind();
		jQuery("#orderForm").submit(function() {
				var submittable = true;
			if (jQuery('#proceedToCheckout').val() == 'true') {
				var validationResults = null;
				if (jQuery('#creditCardType').length > 0 &#038;& jQuery('#creditCardType').is(':checked')) {
				validationResults = regula.validate({groups: [regula.Group.customer, regula.Group.creditCard]});
		   } else {
				validationResults = regula.validate({groups: [regula.Group.customer]});
			}
				var allValidationResults  = "";
				for(var i = 0; i < validationResults.length; i++) {
				var validationResult = validationResults[i];
					allValidationResults += validationResult.message + '\n';
			}

			if (allValidationResults.length > 0) {
				submittable = false;
				alert(allValidationResults);
			}
			}
				if (submittable == true) {
					jQuery("#submitted").val(true);
			}
				return submittable;
			});
				Infusion.Ecomm.OrderForms.bindTooltip('tooltip');
		});
		</script>
		<script type="text/javascript" src="https://builtlean.infusionsoft.com/app/webTracking/getTrackingCode?trackingId=9d96bdcd72edfced80f8acc65a54139b"></script>
		<script type='text/javascript' src='http://www.builtlean.com/wp-content/themes/builtlean/includes/js/tabber.js?ver=1.4.2'></script>
			<div id="fb-root"></div>
			  <?php if(!is_page('7607')) { ?>
		<script type="text/javascript">
			 (function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) {return;}
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- removed GA code -->
<?php } ?>
 <script type="text/javascript" src="https://builtlean.infusionsoft.com/app/webTracking/getTrackingCode?trackingId=9d96bdcd72edfced80f8acc65a54139b"></script>

</body>
</html>
