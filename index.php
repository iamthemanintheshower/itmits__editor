<?php
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

include( plugin_dir_path( __FILE__ ) . 'admin-uihsdw/_include-asdwe/-functions.php');
include( plugin_dir_path( __FILE__ ) . 'frontend-haskjd/_include-uashd/-functions.php');

global $editor_plugin_dir_url;
$editor_plugin_dir_url = plugin_dir_url( __FILE__ );


add_action('init', 'init_functions');
add_action('wp_print_scripts', 'pluginUrl_inline_script');
add_action('wp_head', 'add__editor_popup');

function add_styles_scripts(){
    wp_enqueue_style( 'editor', plugin_dir_url( __FILE__ ) . '/frontend-haskjd/public_html/css/editor.css' );
    wp_enqueue_script('editor-script', plugin_dir_url( __FILE__ ) . '/admin-uihsdw/public_html/js/editor-script.js', array(), null, true); //
}

function init_functions(){
    if(is_user_logged_in()){
        add_action('wp_enqueue_scripts', 'add_styles_scripts');
    }
}

function pluginUrl_inline_script(){
    global $editor_plugin_dir_url;
    echo "<script type='text/javascript'>".PHP_EOL;
        echo 'var pluginUrl = "' . $editor_plugin_dir_url . '";'.PHP_EOL;
    echo "</script>";
}

function add__editor_popup() {
    if(is_user_logged_in()){
        echo '<div data-id="editor_popup" id="editor_popup"><textarea id="text_editor"></textarea><div id="text_editor__footer"><button id="editor__discard_changes">Discard changes</button><button id="editor__save">Save</button></div></div>';
    }

}
