$(function()
{

$('#side-menu').metisMenu();

$('#toggler').on('click', function(){
	if( $('#side').is(':visible') ) {
		$('#side').hide();
//		$('#main').animate({ 'margin-left': '0px' }, 50);
		$('#side').removeClass('col-sm-3 col-md-2 sidebar');
//		$('.col-sm-9').toggleClass('col-sm-9 col-sm-12');
		$('#main').addClass('col-sm-12 col-md-12').removeClass('col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2');
	}
	else {
		$('#side').show();
//		$('#side').animate({ 'width': '210px' }, 50);
		$('#side').addClass('col-sm-3 col-md-2 sidebar');
//		$('#main').animate({ 'margin-left': '220px' }, 50);
//		$('.col-sm-12').toggleClass('col-sm-12 col-sm-9');
		$('#main').removeClass('col-sm-12 col-md-12').addClass('col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2');
	}
});

});
