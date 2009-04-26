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
      return get_include_contents($this->basepath.$content.'.html');
    }elseif(file_exists($this->basepath.$content.'/index.php')){
      //I'm addressing a subdir?
      return get_include_contents($this->basepath.$content.'/index.php');
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
}
?>