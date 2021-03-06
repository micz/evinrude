<? if (!defined('BASEPATH')){ header("HTTP/1.1 301 Moved Permanently"); header('Location: /');exit; }
/*
* Copyright 2009 - 2015 Evinrude
* This file is part of Evinrude.
* Evinrude is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Evinrude is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Evinrude; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code for Evinrude is available at https://github.com/micz/evinrude
* Contact Mic at m [at] micz [dot] it
*
*/
/*
Plugin Name: Helloworld
Plugin URI: https://github.com/micz/evinrude/
Description: A demo plugin that uses all the Evinrude plugins' features.
Version: 1.0
Author: Mic
Author URI: http://micz.it/
*/

class helloworld extends EvnPlugin{
  function activate()
  {
    $this->load_config();
    set_template_var('title','This is a Demo Plugin!');
    set_template_var('title_separator',' :: ');
    return '<h2>A Demo Plugin</h2><p>Hello world!!<br/>I\'m a <a href="https://github.com/micz/evinrude/wiki/Plugins">plugin</a> activated on the <code>'.$this->incoming_path.'</code> path!!<br/><br/>'.$this->config['test_config'].'<br/><br/>I have also ajax capabilites: <span id="testme">'.plugin_ajax_link('test me',$this->get_common_name()).'!</span></p>
<p><br/><i>'.$this->util->common_function().'</i></p>';
  }

  function ajax($args=array())
  {
    return '$("#testme").html("<i>this string has been retrieved with an ajax call!</i>");';
  }
}
?>