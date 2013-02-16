jQuery(document).ready(function(){var a="#tag-cloud";var b=jQuery("#tag-cloud").height();jQuery(".inside ul li:last-child").css("border-bottom","0px");jQuery(".tabs").each(function(){jQuery(this).children("li").children("a:first").addClass("selected")});jQuery(".inside > *").hide();jQuery(".inside > *:first-child").show();jQuery(".tabs li a").click(function(a){var b=jQuery(this).attr("href");jQuery(this).parent().parent().children("li").children("a").removeClass("selected");jQuery(this).addClass("selected");jQuery(this).parent().parent().parent().children(".inside").children("*").hide();jQuery(".inside "+b).fadeIn(500);a.preventDefault()})})
jQuery(document).ready(function(){if(jQuery().superfish){jQuery(".nav ul").superfish({delay:200,animation:{opacity:"show",height:"show"},speed:"fast",dropShadows:true})}if(jQuery(".quotes").length){fadeArgs=new Object;fadeArgs.animationtype="fade";fadeArgs.speed="normal";if(tj_innerfade_settings.can_fade=="true"){fadeArgs.timeout=tj_innerfade_settings.timeout}else{fadeArgs.timeout=1e7}fadeArgs.type="random_start";fadeArgs.containerheight="120px";jQuery(".quotes").innerfade(fadeArgs)}});jQuery(document).ready(function(){jQuery("#primary-nav .nav li ul").each(function(){li_width=jQuery(this).parent("li").width();li_width=li_width/2;li_width=100-li_width-15;jQuery(this).css("margin-left",-li_width)})})

/*
jQuery(document).ready(function(){
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
});
*/