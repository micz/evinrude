<? if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Copyright 2009 Evinrude
* This file is part of Evinrude.
* Evinrude is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Evinrude is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Evinrude; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code for Evinrude is available at https://github.com/micz/evinrude
* Contact Mic at m [at] micz [dot] it
*
*/

function load_content($content)
{
  $CI=&get_instance();
  return $CI->evinrude->load_content($content);
}

function set_template($placeholder,$value)
{
  $CI=&get_instance();
  $CI->evinrude->template[$placeholder]=$value;
}

function get_include_contents($filename)
{
  if(is_file($filename)){
    ob_start();
    @include($filename);
    $contents=ob_get_contents();
    ob_end_clean();
    return $contents;
  }
  return false;
}

function get_template($placeholder,$default_value='')
{
  $CI=&get_instance();
  if(array_key_exists($placeholder,$CI->evinrude->template)){
    return $CI->evinrude->template[$placeholder];
  }else{
    return $default_value;
  }

}
?>