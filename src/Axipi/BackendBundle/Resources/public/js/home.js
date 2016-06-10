$(document).ready(function() {
	$('.mdl-layout__drawer .mdl-list').children('li').each(function(index) {
		$(this).children('a').each(function(index) {
			$('#dynamic_home').append('<div class="mdl-cell mdl-cell--2-col"><a href="' + $(this).attr('href') + '"><i class="fa-4x ' + $(this).find('i').attr('class') + '"></i><br>' + $(this).text() + '</a></div>');
		});
	});
});
