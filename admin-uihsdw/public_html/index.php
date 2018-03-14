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

require realpath(__DIR__ . '/../../../../../wp-load.php');

if(!is_user_logged_in){
    return false;
}

if(isset($_POST['HTML_tag_identifier'])
    && isset($_POST['HTML_tag_string'])
    ){

    $HTML_tag_identifier = $_POST['HTML_tag_identifier'];
    $HTML_tag_string = stripslashes_deep(_replaceDivbyBreakRow($_POST['HTML_tag_string']));

    set_theme_mod( 'all_'.$HTML_tag_identifier, $HTML_tag_string ); //# TODO use the right section of drop out the section mechanism if it is unused
}


function _replaceDivbyBreakRow($HTML_tag_string){
    $HTML_tag_string = str_replace('<div>', '<br>', $HTML_tag_string);
    $HTML_tag_string = str_replace('</div>', '', $HTML_tag_string);
    return $HTML_tag_string;
}