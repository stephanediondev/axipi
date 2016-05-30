$(document).ready(function() {
	$('nav.navbar-default .navbar-nav:first').children('li').each(function(index) {
		$(this).children('a').each(function(index) {
			$('#dynamic_home').append('<div class="col-lg-2 col-sm-3 col-xs-6 text-center"><a class="thumbnail" href="' + $(this).attr('href') + '"><i class="fa-4x ' + $(this).find('i').attr('class') + '"></i><br>' + $(this).text() + '</a></div>');
		});
	});
});
