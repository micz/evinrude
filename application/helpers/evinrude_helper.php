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

function content_preload($content)
{
  $CI=&get_instance();
  return $CI->evinrude->content_preload($content);
}

function content_publish($content)
{
  echo $content;
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

function set_template_var($placeholder,$value)
{
  $CI=&get_instance();
  $CI->evinrude->set_template_var($placeholder,$value);
}

function get_template_var($placeholder,$default_value='')
{
  $CI=&get_instance();
  return $CI->evinrude->get_template_var($placeholder,$default_value);
}

function evn_style_url()
{
  $CI=&get_instance();
  return base_url().'graphic/'.$CI->config->item('evn_template').'/';
}

function evn_active_page($link_name='',$only_last_level=0)
{
  $CI=&get_instance();
  $content_array=explode('/',$CI->evinrude->current_content);
  if(!$only_last_level&&(in_array($link_name,$content_array))){
    return true;
  }elseif($only_last_level&&($content_array[count($content_array)-1]==$link_name)){
    return true;
  }else{
    return false;
  }
}

function get_last_mod_date($file,$format="d/m/Y H:i:s")
{
  return date($format, filemtime($file));
}

function tpl_load_base_file($tpl_file)
{
  $CI=&get_instance();
  $CI->load->view($tpl_file);
}

function tpl_load_header()
{
  tpl_load_base_file('header');
}

function tpl_load_footer()
{
  tpl_load_base_file('footer');
}

function tpl_load_sidebar()
{
  tpl_load_base_file('sidebar');
}

function tpl_load_error()
{
  tpl_load_base_file('error');
}
?>