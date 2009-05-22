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
    set_template_var('title',$this->config['page_title_main']);
    set_template_var('title_separator',$this->config['page_title_separator']);
    $out_buffer='';
    //Get next events info
    $out_buffer.='<h2>'.$this->config['title_next'].'</h2>';
    $out_buffer.=$this->get_folder_files_content($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/');
    //Get past events info
    $out_buffer.='<h2>'.$this->config['title_past'].'</h2>';
    $out_buffer.=$this->get_folder_files_content($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['past_events_folder'].'/');
    return $out_buffer;
  }

  private function get_datafile_from_permalink($permalink)
  {
    if($permadata=@file_get_contents($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['permalink_index_file'])){
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

  private function move_datafile_to_past()
  {//Moves an event file from the next folder to the past folder if needed
   //TO BE IMPLEMENTED

  }

  private function parse_datafile($datafile_path)
  {
    if($output=@file_get_contents($datafile_path)){
      $elements_value=array();
      foreach($this->config['element_tags'] as $tag){
        $start_tag='<evn:'.$tag.'>';
        $end_tag='</evn:'.$tag.'>';
        $start_tag_pos=strpos($output,$start_tag)+strlen($start_tag);
        //No starting tag? Go to the next tag
        if($start_tag_pos===false) break;
        $end_tag_pos=strpos($output,$end_tag,$start_tag_pos);
        //No ending tag? It's better to do nothing, so go to the next tag
        if($end_tag_pos===false) break;
        $elements_value[$tag]=substr($output,$start_tag_pos,$end_tag_pos-$start_tag_pos);
      }
      $output_buffer='<h3>'.arr_el('title',$elements_value).'</h3>
        <p><b>'.arr_el('date',$elements_value).'<br/>
        '.arr_el('location',$elements_value).'</b></p><p>
        </p><p>'.arr_el('desc',$elements_value).'</p>
        <p><a href="'.arr_el('dl_link',$elements_value).'" title="'.$this->config['download_title_text'].'"> '.$this->config['download_anchor_text'].'</a>';
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

  private function get_folder_files_content($folder_path)
  {
    if(!is_dir($folder_path))return false;
    $out_buffer='';
    if($dh=opendir($folder_path)){
      while(($file=readdir($dh))!==false){
        $parts=explode('.',$file);                // pull apart the name and dissect by period
        if(is_array($parts)&&count($parts)>1){    // does the dissected array have more than one part
          $extension = end($parts);               // set to we can see last file extension
          if ($extension == "txt" OR $extension == "TXT"){    // is extension ext or EXT ?
             $out_buffer.=$this->parse_datafile($folder_path.$file);
          }
        }
      }
      closedir($dh);
    }
    return $out_buffer;
  }
}
?>