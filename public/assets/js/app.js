// remap jQuery to $
(function($){
$(window).bind("load",function(){

// 	$('#slider').nivoSlider({
// 		effect:'random',
// 		pauseTime:4000,
// 		pauseOnHover:false,
// 		controlNav:true
// 	});
//
// 	$("a[rel='inline']").colorbox({transition:"fade"});
// 	$("a[rel='popup']").colorbox({transition:"fade"});

// adds the fading effect when an image is wraped with an anchor tag and a animation class added to it
	$("a.go, a.play, a.zoom, a.view, a.read_more, a.external, a.arrow_left, a.arrow_right, a.read_article, a.zoom_rounded, a.zoom_rounded2").hover(function(){
		$("img", this).stop().animate({ "opacity": 0.3 }, 400);
	}, function() {
		$("img", this).stop().animate({ "opacity": 1 }, 250);
	});
// adds the project name in portfolio option 2

//	$("ul#inline li a img").each(function(){
//		 var alt = $(this).attr("alt");
//		 $(this).parent().before('<span class="inline">'+alt+'</span>')
//	});


});
})(this.jQuery);
