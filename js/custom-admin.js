(function($) {

	$(document).ready(function() {
		$('#upload_image_button').click(function() {
			formfield = $('#custom-menu-logo-url').attr('name');
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			return false;
		});

		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#custom-menu-logo-url').val(imgurl);
			tb_remove();
		}
	});
    
	$(document).ready(function() {
		var editor_styles = ace.edit("editor-custom-styles");
    	editor_styles.setTheme("ace/theme/twilight");
    	editor_styles.getSession().setMode("ace/mode/css");
    	editor_styles.setOption("maxLines", 40);

    	var editor_scripts = ace.edit('editor-custom-scripts');
    	editor_scripts.setTheme('ace/theme/twilight');
    	editor_scripts.getSession().setMode('ace/mode/javascript');
    	editor_scripts.setOption("maxLines", 40);

        var editor_footer = ace.edit('editor-custom-footer');
        editor_footer.setTheme('ace/theme/twilight');
        editor_footer.getSession().setMode('ace/mode/html');
        editor_footer.setOption("maxLines", 40);

    	var textarea_styles  = $('<textarea name="custom-styles" style="display:none"></textarea>');
    	var textarea_scripts = $('<textarea name="custom-scripts" style="display:none"></textarea>');
        var textarea_footer = $('<textarea name="custom-footer" style="display:none"></textarea>');

    	$('#material-theme-options').submit(function(evt) {
    		evt.preventDefault();

    		textarea_styles.text(editor_styles.getValue());
    		textarea_scripts.text(editor_scripts.getValue());
            textarea_footer.text(editor_footer.getValue());

    		$(this).append(textarea_styles);
    		$(this).append(textarea_scripts);
            $(this).append(textarea_footer);

    		evt.target.submit();
    	});

        $('.alert.options-updated').fadeOut(10000);
	});

})(jQuery);