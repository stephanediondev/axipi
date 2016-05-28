var current_popup;

function mediaSelected(url, width, height) {
	/*var elm = window.top.opener.document.getElementById('mceu_74-inp');
	if(url.indexOf('.swf')) {
		cls = 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000';
		codebase = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0';
		type = 'application/x-shockwave-flash';
		prev = '<object classid="clsid:' + cls + '" codebase="' + codebase + '" width="' + width + '" height="' + height + '" id="prevobject" name="prevname">';
		prev += '<param name="url" value="../../../../' + url + '" />';
		prev += '<embed type="' + type + '" src="../../../../' + url + '" width="' + width + '" height="' + height + '" ';
		prev += '></embed></object>';
		elm.innerHTML = prev;
	} else {
		elm.innerHTML = '<img id="previewImg" src="../../../../' + url + '" border="0" onload="updateImageData();" onerror="resetImageData();" />';
	}*/
	window.top.opener.current_popup.document.getElementById('mceu_74-inp').value = url;
	//window.top.opener.current_popup.document.forms[0].width.value = width;
	//window.top.opener.current_popup.document.forms[0].height.value = height;
	window.close();
}

tinymce.init({
	file_browser_callback : function(field_name, url, type, win) {
		console.log(field_name);
		console.log(url);
		console.log(type);
		console.log(win);
		if(type != 'image') {
			return false;
		}

		current_popup = win;

		tinyMCE.activeEditor.windowManager.open({
			file : axipi_backend_home + 'file?wysiwyg=1&field_name=' + field_name,
			title : 'Medias',
			width : 850,
			height : 425,
			resizable : 'yes',
			window : win,
			input : field_name
		});
		window.inputSrc = field_name
		return false;
	},
	height: 200,
	selector: '.wysiwyg',
	entity_encoding : 'raw',
	remove_script_host: true,
	relative_urls: false,
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
$(document).ready(function() {
	$('.wysiwyg_image').bind('click', function(event) {
		event.preventDefault();
		var img_reference = $(this).find('img');
		imgSrc = img_reference.attr('src');
		imgAlt = img_reference.attr('alt');
		imgField = $(this).data('field_name');
		window.parent.update_image(imgField, imgSrc);
	});
});
