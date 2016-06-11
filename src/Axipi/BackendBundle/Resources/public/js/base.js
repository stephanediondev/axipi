var current_popup;

document.addEventListener('mdl-componentupgraded', function(e){
    //In case other element are upgraded before the layout  
    if (typeof e.target.MaterialLayout !== 'undefined') {
        tinymce.init({
            file_browser_callback : function(field_name, url, type, win) {
                if(type == 'image') {
                    var file = axipi_backend_home + 'files/wysiwyg' + field_name;
                    var title = 'Files';

                } else if(type == 'file') {
                    var file = axipi_backend_home + 'pages/wysiwyg' + field_name;
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
            content_css : '../vendor/bootstrap/dist/css/bootstrap.min.css',
            style_formats: [
              { title: 'Headers', items: [
                { title: 'h1', block: 'h1' },
                { title: 'h2', block: 'h2' },
                { title: 'h3', block: 'h3' },
                { title: 'h4', block: 'h4' },
                { title: 'h5', block: 'h5' },
                { title: 'h6', block: 'h6' }
              ] },

              { title: 'Blocks', items: [
                { title: 'p', block: 'p' },
                { title: 'p.lead', block: 'p', classes: 'lead' },
                { title: 'div', block: 'div' },
                { title: 'pre', block: 'pre' }
              ] }
            ],
            plugins: 'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen media nonbreaking table contextmenu directionality template paste',
            toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect',
            toolbar2: 'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code',
            toolbar3: 'table | hr removeformat | subscript superscript | charmap | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft',
            menubar: false,
            toolbar_items_size: 'small'
        });
    }
});

function update_image(field_name, src) {
    $('#' + field_name).val('');
    $('#' + field_name).val(src);
    parent.tinyMCE.activeEditor.windowManager.close(current_popup);
}

function update_file(field_name, href) {
    $('#' + field_name).val('');
    $('#' + field_name).val(href);
    parent.tinyMCE.activeEditor.windowManager.close(current_popup);
}

$(document).ready(function() {
    var notification = document.querySelector('.mdl-js-snackbar');

    $('.mdl-tabs__tab').bind('click', function(event) {
        var href = $(this).attr('href');
        if(href.indexOf('#') != -1) {
            event.preventDefault();
            var parent = $(this).parent().parent();

            parent.find('.mdl-tabs__tab').removeClass('is-active');
            $(this).addClass('is-active');

            parent.find('.mdl-tabs__panel').removeClass('is-active');
            $(href).addClass('is-active');
        }
    });

    $('.mdl-button.toggle').bind('click', function(event) {
        event.preventDefault();

        var href = $(this).attr('href');
        if($(href).is(':visible')) {
            $(href).hide();
        } else {
            $(href).show();
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

    $('.get_location').bind('click', function(event) {
        event.preventDefault();
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    $('input[name="item[attributesChange][latitude]"]').val(position.coords.latitude);
                    $('input[name="item[attributesChange][longitude]"]').val(position.coords.longitude);
                    notification.MaterialSnackbar.showSnackbar({
                        message: 'Done'
                    });
                },
                function(error) {
                    if(error.code == 1) {
                        notification.MaterialSnackbar.showSnackbar({
                            message: 'Permission denied'
                        });
                    } else if(error.code == 2) {
                        notification.MaterialSnackbar.showSnackbar({
                            message: 'Position unavailable'
                        });
                    } else if(error.code == 3) {
                        notification.MaterialSnackbar.showSnackbar({
                            message: 'Timeout'
                        });
                    } else {
                        notification.MaterialSnackbar.showSnackbar({
                            message: 'Unknown error'
                        });
                    }
                },
                {'enableHighAccuracy': true, 'timeout': 30000}
            );
        }
    });

    var $ajaxUploader = $('#ajax-uploader');

    if($ajaxUploader) {
        $ajaxUploader.fileupload({
            url: $ajaxUploader.data('url'),
            singleFileUploads: true,
            autoUpload: true,
            maxFileSize: 20000000,
            getFilesFromResponse: function(data) {
                return data.result;
            },
            submit: function(e, data) {
                data.formData = {
                    parent: $ajaxUploader.data('parent'),
                    component: $ajaxUploader.data('component')
                };
            },
            done: function(e, data) {
                for(var i in data.result) {
                    content = '<div class="mdl-cell mdl-cell--2-col">';
                    content += '<a href="' + data.result[i]['href'] + '"><i class="fa fa-4x fa-' + data.result[i]['icon'] + '"></i><br>' + data.result[i]['title'] + '</a>';
                    content += '</div>';
                    $('#ajax-upload-result').find('.mdl-grid').append(content);
                }
            }
        });
    }
});
