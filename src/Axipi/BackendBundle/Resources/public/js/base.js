var current_popup;

tinymce.init({
    file_browser_callback : function(field_name, url, type, win) {
        if(type == 'image') {
            var file = axipi_backend_home + 'file/wysiwyg' + field_name;
            var title = 'Files';

        } else if(type == 'file') {
            var file = axipi_backend_home + 'page/wysiwyg' + field_name;
            var title = 'Pages';

        } else {
            return false;
        }

        current_popup = win;

        tinyMCE.activeEditor.windowManager.open({
            file : file,
            title : title,
            width : 960,
            height : 500,
            resizable : 'yes',
            window : win,
            input : field_name
        });
        window.inputSrc = field_name
        return false;
    },
    height: 500,
    selector: '.wysiwyg',
    entity_encoding : 'raw',
    remove_script_host: true,
    relative_urls: true,
    document_base_url: axipi_core_home,
    visualblocks_default_state: true,
    plugins: 'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen media nonbreaking table contextmenu directionality template paste',
    toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect',
    toolbar2: 'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code',
    toolbar3: 'table | hr removeformat | subscript superscript | charmap | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft',
    menubar: false,
    toolbar_items_size: 'small'
});

function update_image(field_name, src) {
    $('#' + field_name).attr('value', src);
    parent.tinyMCE.activeEditor.windowManager.close(current_popup);
}

function update_file(field_name, href) {
    $('#' + field_name).val(href);
    parent.tinyMCE.activeEditor.windowManager.close(current_popup);
}

$(document).ready(function() {
    // Prevent Bootstrap dialog from blocking focusin
    $(document).on('focusin', function(e) {
        if ($(e.target).closest('.mce-window').length) {
            e.stopImmediatePropagation();
        }
    });

    $('.wysiwyg_image').bind('click', function(event) {
        event.preventDefault();
        var img_reference = $(this).find('img');
        imgField = $(this).data('field_name');
        imgSrc = img_reference.attr('src');
        window.parent.update_image(imgField, imgSrc);
    });

    $('.wysiwyg_link').bind('click', function(event) {
        event.preventDefault();
        window.parent.update_file($(this).data('field_name'), $(this).attr('href'));
    });
});
