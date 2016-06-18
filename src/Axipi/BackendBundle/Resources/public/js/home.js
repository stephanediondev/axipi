$(document).ready(function() {
    $('.mdl-layout__drawer .mdl-list').children('li').each(function(index) {
        $(this).children('a').each(function(index) {
            var css_class = $(this).find('i').attr('class');
            content = '<div class="mdl-cell mdl-cell--2-col">';
            content += '<a href="' + $(this).attr('href') + '"><i class="' + css_class.replace('fa-lg ', '') + ' fa-3x"></i><br>' + $(this).text() + '</a>';
            content += '</div>';
            $('#dynamic-home').find('.mdl-grid').append(content);
        });
    });
});
