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

class redirect extends EvnPlugin{

  function activate()
  {
    $args=$this->get_uri_elements();
    if(count($args)==0){  //No permalink passed
      return $this->show_error_page();
    }else{  //Calling a correct permalink
      if($final_url=$this->get_url_from_permalink($args[0])){
        return $final_url;
      }else{  //Nothing found
         return $this->show_error_page();
      }
    }
  }

  private function show_error_page() {
    return 'Sorry, redirect URL not found.';
  }

  private function get_url_from_permalink($permalink)
  {
    if($permadata=@file_get_contents($this->get_plugin_path().'permalink.txt')){
      $permadata=str_replace("\r","\n",$permadata)."\n";
      $startp=strpos($permadata,'::'.$permalink.'::')+strlen('::'.$permalink.'::');
      $final_url=trim(substr($permadata,$startp,strpos($permadata,"\n",$startp)-$startp)," \n\r\t");
      if($final_url!=''){
        header('HTTP/1.0 301 Moved Permanently');
        header('Location: '.$final_url);
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
}
?>