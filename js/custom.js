	$(document).ready(function() {
				////////////////////////////////////
				// Initiate sticky add
				////////////////////////////////////

				$('.container').stickem();
				
		
				///////////////////////////////
				// hover on blog
				//////////////////////////////
				
					var singleValues = jQuery(".blog a").html();
					if (singleValues == 'Articles &amp; Videos'){
						jQuery(".blog").addClass('menu_item_hovered_blog');
						jQuery(".blog a").css('font-weight','bold');
					}
					if(jQuery(".blog").hasClass('current_page_item')) {
						jQuery(".blog ul").remove();
					}
				
					jQuery('.sub-menu1 ul').removeClass('sub-menu1').addClass('sub-menu2');
					
					jQuery('#menu-blog li').hover(function() {
						jQuery(this).addClass('menu_item_hovered2');
						jQuery(this).children('ul').slideDown(100);
					}, function() {
						jQuery(this).removeClass('menu_item_hovered2');
						jQuery(this).children('ul').slideUp(200);
					});
					
					
					jQuery('#menu-blog-2 li').hover(function() {
						jQuery(this).addClass('menu_item_hovered2');
						jQuery(this).children('ul').slideDown(100);
					}, function() {
						jQuery(this).removeClass('menu_item_hovered2');
						jQuery(this).children('ul').slideUp(200);
					});
					
					
					jQuery('#menu-hover li').hover(function() {
						var selected = jQuery(this).children("a").text();
						/*alert(selected);*/
						if (selected == 'Articles & Videos'){
							jQuery(this).addClass('menu_item_hovered3');
							}
						else {
							jQuery(this).addClass('menu_item_hovered4');
							}
						jQuery(this).children('#menu-hover li > ul.sub-menu1').slideDown(100);
					}, function() {
						jQuery(this).removeClass('menu_item_hovered4');
						jQuery(this).removeClass('menu_item_hovered3');
						jQuery(this).children('#menu-hover li > ul.sub-menu1').slideUp(200);
					});

//end DOCUMENT READY
});
