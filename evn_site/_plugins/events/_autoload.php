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

class events_auto extends EvnAutoloadPlugin{

  function execute($args=array())
  {
    $this->load_config();
    $event_data=$this->get_event_data();
    if($elements_value=$this->CI->evinrude->parse_datafile($event_data[0],$this->config['element_tags'])){
      $elements_value['item_permalink']=$event_data[1];
      return $this->get_template($this->get_plugin_path().$this->config['template_folder'].'/event_banner.php',$elements_value);
    }else{
      return '';
    }
  }

  private function get_event_data()
  {
    $out_buffer[0]='';
    $out_buffer[1]='';
    $folder_path=$this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['next_events_folder'].'/';
    foreach(array_diff(scandir($folder_path),array('.','..')) as $file){
      $parts=explode('.',$file);            // pull apart the name and dissect by period
      if(is_array($parts)&&count($parts)>1){    // does the dissected array have more than one part
        $extension = end($parts);           // set to we can see last file extension
        if($extension == "txt" OR $extension == "TXT"){    // is extension ext or EXT ?
          $out_buffer[1]=$this->get_single_permalink($file);
          $out_buffer[0]=$folder_path.$file;
          return $out_buffer;
        }
      }
    }
  }

  private function get_single_permalink($file)
  {
    if($permadata=@file_get_contents($this->get_plugin_path().$this->config['data_folder'].'/'.$this->config['permalink_index_file'])){
      $permadata=str_replace("\r","\n",$permadata)."\n";
      $endp=strpos($permadata,'::'.$file."\n");
      $permalen=strlen($permadata);
      $startp=$permalen-strpos(strrev($permadata),'::',$permalen-$endp);
      return trim(substr($permadata,$startp,$endp-$startp)," \n\r\t");
    }else{
      return '';
    }
  }
}
?>