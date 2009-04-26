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

class Evinrude
{
  private $CI;
  private $template;
  var $basepath;
  
  function  __construct() {
    $this->CI=&get_instance();
    $this->template=array();
  }

  function check_incoming_path($path)
  {
    $vroot=realpath($this->basepath);
    $path=$this->basepath.$path;
    $path_php=$path.'.php';
    $path_html=$path.'.html';
    //Check we're not going out our site_data folder
    if(!$real_path=realpath($path)){
      if(!$real_path=realpath($path_php)){
        $real_path=realpath($path_html);
      }
    }
    if(substr($real_path,0,strlen($vroot))!=$vroot){
      return false;
    }else{
      return true;
    }
  }

  function load_content($content)
  {
    if(strpos($content,'/evn__') === 0){
      //We cannot load directly a template base file
      $this->CI->load->view('error');
      return false;
    }
    if(file_exists($this->basepath.$content.'.php')){
      //I'm addressing a php file?
      return get_include_contents($this->basepath.$content.'.php');
    }elseif(file_exists($this->basepath.$content.'.html')){
      //I'm addressing an html file?
      //Parse the html file for template vars and translate them to php
      return $this->parse_html_template_vars(get_include_contents($this->basepath.$content.'.html'));
    }elseif(file_exists($this->basepath.$content.'/index.php')){
      //I'm addressing a subdir? Check an index.php...
      return get_include_contents($this->basepath.$content.'/index.php');
    }elseif(file_exists($this->basepath.$content.'/index.html')){
      //... or check an index.html (and parse the template vars)
      return $this->parse_html_template_vars(get_include_contents($this->basepath.$content.'/index.html'));
    }else{
      //Sorry nothing found
      $this->CI->load->view('error');
      return false;
    }
  }

  function set_template_var($placeholder,$value)
  {
    $this->template[$placeholder]=$value;
  }

  function get_template_var($placeholder,$default_value='')
  {
    if(array_key_exists($placeholder,$this->template)){
      return $this->template[$placeholder];
    }else{
      return $default_value;
    }
  }

  private function parse_html_template_vars($html)
  {
    //Find the template vars code
    $start_tag='<evn:vars>';
    $end_tag='</evn:vars>';
    $start_tag_pos=strpos($html,$start_tag);
    //No starting tag? Exit the function
    if($start_tag_pos===false) return $html;
    $end_tag_pos=strpos($html,$end_tag,$start_tag_pos);
    //No ending tag? It's better to do nothing, so exit the function
    if($end_tag_pos===false) return $html;
    $var_code=substr($html,$start_tag_pos,$end_tag_pos-$start_tag_pos);
    //Strip it from the html
    $html=substr_replace($html,'',$start_tag_pos, $end_tag_pos-$start_tag_pos);
    $lines=explode("\n",$var_code);
    //Get the template vars
    $current_line='';
    $line_count=count($lines);
    $i=0;
    for($i=0;$i<$line_count;$i++){
      $current_line=trim($lines[$i]," \r\n\t");
      $equal_sign_pos=strpos($current_line,'=');
      $var_name=substr($current_line,0,$equal_sign_pos);
      $var_value=substr($current_line,$equal_sign_pos+1);
      $this->set_template_var($var_name,$var_value);
    }
    return $html;
  }
}
?>