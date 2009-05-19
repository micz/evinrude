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
  private $version='1.1-plugins-working';
  private $plugin_autoload_file='_autoload.php';
  private $plugin_main_file='main.php';

  private $CI;
  private $template;
  private $basepath;
  private $pluginspath;
  private $autoload_plugins;
  private $active_plugins;
  private $incoming_path;
  private $current_plugin;
  var $current_content;
  var $file_last_mod_date;
  var $plugins_autoloaded;
  var $using_plugin;
  
  function  __construct()
  {
    $this->CI=&get_instance();
    $this->template=array();
    $this->current_content='';
    $this->basepath=$this->CI->config->item('evn_site_pages_folder');
    $this->pluginspath=$this->CI->config->item('evn_site_plugins_folder');
    $this->autoload_plugins=$this->CI->config->item('evn_autoload_plugins');
    $this->active_plugins=$this->CI->config->item('evn_active_plugins');
    $this->using_plugin=0;
    $this->current_plugin='';
  }

  function get_version()
  {
    return $this->version;
  }

  function set_incoming_path($path)
  {
    $this->incoming_path=$path;
  }

  function check_incoming_path($path='')
  {
    if($path=='')$path=$this->incoming_path;
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

  function content_preload($content)
  {
    //returns $content if we're using a plugin
    if($this->using_plugin){
      $this->file_last_mod_date='';
      return $content;
    }
    $this->current_content=trim($content,'/');
    if(file_exists($this->basepath.$content.'.php')){
      //I'm addressing a php file?
      $this->file_last_mod_date=$this->get_last_mod_date($this->basepath.$content.'.php');
      return get_include_contents($this->basepath.$content.'.php');
    }elseif(file_exists($this->basepath.$content.'.html')){
      //I'm addressing an html file?
      $this->file_last_mod_date=$this->get_last_mod_date($this->basepath.$content.'.html');
      //Parse the html file for template vars and translate them to php
      return $this->parse_html_template_vars(get_include_contents($this->basepath.$content.'.html'));
    }elseif(file_exists($this->basepath.$content.'/index.php')){
      //I'm addressing a subdir? Check an index.php...
      $this->file_last_mod_date=$this->get_last_mod_date($this->basepath.$content.'/index.php');
      return get_include_contents($this->basepath.$content.'/index.php');
    }elseif(file_exists($this->basepath.$content.'/index.html')){
      //... or check an index.html (and parse the template vars)
      $this->file_last_mod_date=$this->get_last_mod_date($this->basepath.$content.'/index.html');
      return $this->parse_html_template_vars(get_include_contents($this->basepath.$content.'/index.html'));
    }else{
      //Sorry nothing found
      return false;
    }
  }

  function autoload_plugins()
  {
    foreach ($this->autoload_plugins as $autop) {
      if(file_exists($this->pluginspath.'/'.$autop.'/'.$this->plugin_autoload_file)){
        include_once($this->pluginspath.'/'.$autop.'/'.$this->plugin_autoload_file);
        $autop_name=$autop.'_auto';
        $this->plugins_autoloaded[$autop]=new $autop_name($this->incoming_path);
      }
    }
  }

  function load_plugin($plugin_name)
  {
    if(file_exists($this->pluginspath.'/'.$plugin_name.'/'.$this->plugin_main_file)){
        include_once($this->pluginspath.'/'.$plugin_name.'/'.$this->plugin_main_file);
        $this->using_plugin=1;
        return new $plugin_name($this->incoming_path);
    }
  }

  function check_using_plugin()
  {
    $incoming_path=trim($this->incoming_path,'/');
    if(array_key_exists($incoming_path,$this->active_plugins)){
      //A full path found!
      $this->current_plugin=$this->active_plugins[$incoming_path];
      return true;
    }else{
      //Look for a partial path (we're calling a subdir of a plugin path)
      foreach($this->active_plugins as $key => $value){
        $cpos=strpos($incoming_path,$key.'/');
        if(($cpos!==false)&&($cpos==0)){
          $this->current_plugin=$value;
          return true;
        }
      }
    }
    $this->current_plugin='';
    return false;
  }

  function get_plugin()
  {
    if($this->current_plugin!=''){
      return $this->current_plugin;
    }
    $incoming_path=trim($this->incoming_path,'/');
    return $this->active_plugins[$incoming_path];
  }

  function get_autoload_plugin_content($plugin_name,$args=array())
  {
    if(is_array($this->plugins_autoloaded)&&array_key_exists($plugin_name,$this->plugins_autoloaded)&&$this->plugins_autoloaded[$plugin_name]!=null){
      return $this->plugins_autoloaded[$plugin_name]->execute($args);
    }else{
      return '';
    }
  }

  private function get_last_mod_date($file)
  {
    return filemtime($file);
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
      $current_line=$lines[$i];
      $equal_sign_pos=strpos($current_line,'=');
      $var_name=trim(substr($current_line,0,$equal_sign_pos)," \r\n\t");
      $var_value=substr($current_line,$equal_sign_pos+1);
      $this->set_template_var($var_name,$var_value);
    }
    return $html;
  }
}

abstract class EvnAncestorPlugin
{
  protected $plugin_config_file='config.php';

  protected $incoming_path;
  protected $config;
  protected $CI;

  function  __construct($incoming_path)
  {
    $this->CI=&get_instance();
    $this->incoming_path=$incoming_path;
    $this->config=array();
  }

  public function load_config()
  {
    $plugin_path=$this->get_plugin_path();
    if(file_exists($plugin_path.$this->plugin_config_file)){
      include_once($plugin_path.$this->plugin_config_file);
      $this->config=$config;
     }
  }

  public function disable_cache()
  {
    $this->CI->output->cache(0);
  }

  public function set_cache($min)
  {
    $this->CI->output->cache($min);
  }

  public function get_plugin_path()
  {
    return $this->CI->config->item('evn_site_plugins_folder').'/'.get_class($this).'/';
  }

  protected function get_uri_elements()
  {
    $inc_segs=$this->CI->uri->segment_array();
    return array_slice($inc_segs,1);
  }
}

abstract class EvnPlugin extends EvnAncestorPlugin
{
  abstract public function activate();
}

abstract class EvnAutoloadPlugin extends EvnAncestorPlugin
{
  abstract public function execute($args=array());

  public function get_plugin_path()
  {
    $real_path=parent::get_plugin_path();
    // Strips the '_auto' from the name
    return substr($real_path,0,strlen($real_path)-6).'/';
  }
}

?>