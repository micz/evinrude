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