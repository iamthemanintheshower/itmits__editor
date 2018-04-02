/*
Plugin Name: itmits - editor
Plugin URI: http://www.imthemanintheshower.com/editor
Description: add a editor to your website
Version: 0.1
Author: imthemanintheshower
Author URI: http://www.imthemanintheshower.com
License: MIT - https://opensource.org/licenses/mit-license.php
*/
/*
Copyright 2017 https://github.com/iamthemanintheshower

Permission is hereby granted, free of charge, to any person obtaining a copy of 
this software and associated documentation files (the "Software"), to deal in 
the Software without restriction, including without limitation the rights to use, 
copy, modify, merge, publish, distribute, sublicense, and/or sell copies 
of the Software, and to permit persons to whom the Software is furnished 
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
DEALINGS IN THE SOFTWARE.
*/
var mouseover_div = '';
var current_field_id = '';
$(document).ready(function(){
    $( ".ed-cst-fld" ).attr('contenteditable','true');
    $( ".ed-cst-fld" ).attr('onblur','_saveText(this)');

    $("div").contextmenu(function(e) {
        e.preventDefault();
        var field_id = $(this).data('field_id');
        if(typeof field_id != "undefined" && field_id === mouseover_div){
            current_field_id = field_id;
            var values = {field_id: field_id};

            $.post(  pluginUrl + "admin-uihsdw/public_html/index.php", values)
            .done(function( data ) {
                jQuery('#editor_popup').show();
                jQuery('#text_editor').val(data.file_content);
                scrollTextareaToText('text_editor', field_id);
            })
            .fail(function( data ) {
                console.log( "FAIL: " );
                console.log( data );
            });
        }
    });

    $('div').mouseover(function() {
        var field_id = $(this).data('field_id');
        mouseover_div = field_id;
    });

    jQuery('body').on('click', '#editor__discard_changes', function () {
        jQuery('#editor_popup').hide();
        jQuery('#text_editor').val('');
    });

    jQuery('body').on('click', '#editor__save', function () {

        var values = {field_id: current_field_id, page_code: jQuery('#text_editor').val()};

        $.post(  pluginUrl + "admin-uihsdw/public_html/index.php", values)
        .done(function( data ) {
            console.log(data);
            jQuery('#editor_popup').hide();
            jQuery('#text_editor').val('');
        })
        .fail(function( data ) {
            console.log( "FAIL: " );
            console.log( data );
        });
    });
});

function _saveText(obj_this){
    if($(obj_this).attr('contenteditable') === 'true'){

        var values = {HTML_tag_identifier: $(obj_this).data('field_id'), HTML_tag_string: $(obj_this).html()};

        $.post(  pluginUrl + "admin-uihsdw/public_html/index.php", values)
        .done(function( data ) {
            console.log(data);
        })
        .fail(function( data ) {
            console.log( "FAIL: " );
            console.log( data );
        });
    }
}

function scrollTextareaToText(text_editor, text) {
    var textarea = document.getElementById(text_editor);
    var text_position = jQuery('#' + text_editor).val().indexOf(text);

    textarea.focus();
    textarea.selectionStart = text_position;
    textarea.selectionEnd = text_position + text.length;

    var line_height = jQuery('#' + text_editor).css('line-height').replace('px', '');
    var lines_count = textarea.scrollHeight / line_height;
    var chars_in_line = jQuery('#' + text_editor).val().length / lines_count;
    var line_number = Math.floor(text_position / chars_in_line);

    jQuery('#' + text_editor).scrollTop( line_number * line_height );
};
