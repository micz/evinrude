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
      }else{  //Nothing found
        return $this->config['lang']['event_not_found'];
      }
    }
  }

  private function show_main_page()
  {
    $this->move_datafile_to_past();
    set_template_var('title',$this->config['page_title_main']);
    set_template_var('title_separator',$this->config['page_title_separator']);
    $out_buffer='';
    $permalinks=$this->load_permalinks();
    //Get next events info
    $next_buffer=$this->get_folder_files_content($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/',$permalinks);
    if(($next_buffer!='')&&($next_buffer!=false)){
      $out_buffer.='<h2>'.$this->config['title_next'].'</h2>'.$next_buffer;
    }
    //Get past events info
    $past_buffer=$this->get_folder_files_content($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['past_events_folder'].'/',$permalinks);
    if(($past_buffer!='')&&($past_buffer!=false)){
      $out_buffer.='<h2>'.$this->config['title_past'].'</h2>'.$past_buffer;
    }
    if($out_buffer==''){  //No events!
      $out_buffer=$this->config['lang']['no_events'];
    }
    return $out_buffer;
  }

  private function get_datafile_from_permalink($permalink)
  {
    if($permadata=@file_get_contents($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['permalink_index_file'])){
      $permadata=str_replace("\r","\n",$permadata)."\n";
      $startp=strpos($permadata,'::'.$permalink.'::')+strlen('::'.$permalink.'::');
      $filename=trim(substr($permadata,$startp,strpos($permadata,"\n",$startp)-$startp)," \n\r\t");
      if($filename!=''){
        if($output=$this->get_event_html($this->get_past_events_path().$filename,$permalink,1)){
          return $output;
        }elseif($output=$this->get_event_html($this->get_next_events_path().$filename,$permalink,1)){
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

  private function load_permalinks()
  {
    $perma_array=array();
    if($permadata=@file($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['permalink_index_file'])){
      foreach ($permadata as $line_num => $line){
        $line=trim(substr($line,2),"\r\n ");
        $line_data=explode('::',$line);
        $perma_array[$line_data[1]]=$line_data[0];
      }
      return $perma_array;
    }else{
      return false;
    }
  }

  private function move_datafile_to_past()
  {//Moves an event file from the next folder to the past folder if needed
    $next_folder=$this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/';
    $past_folder=$this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['past_events_folder'].'/';
    $current_time=time();
    foreach(array_diff(scandir($next_folder),array('.','..')) as $file){
      $parts=explode('.',$file);                // pull apart the name and dissect by period
      if(is_array($parts)&&count($parts)>1){    // does the dissected array have more than one part
        $extension = end($parts);               // set to we can see last file extension
        if($extension == "txt" OR $extension == "TXT"){    // is extension ext or EXT ?
          $file_time=mktime(0,0,0,substr($file,4,2),substr($file,6,2)+1,substr($file,0,4));
          if($file_time<$current_time){
            @unlink($past_folder.$file);
            @rename($next_folder.$file,$past_folder.$file);
          }else{
            return;
          }
        }
      }
    }
    return;
  }

  private function get_event_html($datafile_path,$permalink,$single=0)
  {
    if($elements_value=$this->CI->evinrude->parse_datafile($datafile_path,$this->config['element_tags'])){
      $elements_value['item_permalink']=$permalink;
      if($single){
        $tpl_file='event_single.php';
      }else{
        $tpl_file='event_for_list.php';
      }
      $output_buffer=$this->get_template($this->get_plugin_path().$this->config['template_folder'].'/'.$tpl_file,$elements_value);
      return $output_buffer;
    }else{
      return false;
    }
  }

  private function get_past_events_path()
  {
    return $this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['past_events_folder'].'/';
  }

  private function get_next_events_path()
  {
    return $this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/';
  }

  private function get_folder_files_content($folder_path,$permalinks)
  {
    if(!is_dir($folder_path))return false;
    $out_buffer='';
    foreach(array_diff(scandir($folder_path),array('.','..')) as $file){
      $parts=explode('.',$file);                // pull apart the name and dissect by period
      if(is_array($parts)&&count($parts)>1){    // does the dissected array have more than one part
        $extension = end($parts);               // set to we can see last file extension
        if($extension == "txt" OR $extension == "TXT"){    // is extension ext or EXT ?
           $out_buffer.=$this->get_event_html($folder_path.$file,$permalinks[$file]);
        }
      }
    }
    return $out_buffer;
  }
}
?>