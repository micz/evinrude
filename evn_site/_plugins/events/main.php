<? if (!defined('BASEPATH')){ header("HTTP/1.1 301 Moved Permanently"); header('Location: /');exit; }
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

class events extends EvnPlugin{

  function  __construct($incoming_path) {
    parent::__construct($incoming_path);
    $this->CI->load->helper('file');
    $this->load_config();
  }
  
  function activate()
  {
    $args=$this->get_uri_elements();
    if(count($args)==0){  //Calling the main plugin page
      return $this->show_main_page();
    }else{  //Calling a single event
      if($datafile=$this->get_datafile_from_permalink($args[0])){
        return $datafile;
      }else{
        return $this->config['lang']['event_not_found'];
      }
    }
  }

  function show_main_page()
  {
    return 'This will be the events plugin main page.';
    //Get next events info

    //Get past events info
    
  }

  function get_datafile_from_permalink($permalink)
  {
    if($permadata=read_file($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['permalink_index_file'])){
      $permadata=str_replace("\r\n","\n",$permadata)."\n";
      $startp=strpos($permadata,$permalink.'::')+strlen($permalink.'::');
      $filename=trim(substr($permadata,$startp,strpos($permadata, "\n",$startp))," \n\r\t");
      if($filename!=''){
        if($output=$this->parse_datafile($this->get_past_events_path().$filename)){
          return $output;
        }elseif($output=$this->parse_datafile($this->get_next_events_path().$filename)){
          return $output;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function move_datafile_to_past()
  {//To be implemented

  }

  function parse_datafile($datafile_path)
  {
    if($output=read_file($datafile_path)){
      //To be implemented
      return $output;
    }else{
      return false;
    }
  }

  function get_past_events_path()
  {
    return $this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['past_events_folder'].'/';
  }

  function get_next_events_path()
  {
    return $this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/';
  }

}
?>