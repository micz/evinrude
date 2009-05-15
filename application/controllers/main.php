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

class Main extends Controller {

  private $view_data;
  private $incoming_path;

  function  __construct() {
		parent::__construct();
    $this->view_data=array();
    $this->view_data['error']=0;
    $this->view_data['content']='';
    $cache_min=$this->config->item('evn_cache_minutes');
    if($cache_min>0)$this->output->cache($cache_min);
	}
	
	function _remap($method)
  {
    $this->incoming_path=$this->uri->uri_string();
    $this->evinrude->set_incoming_path($this->incoming_path);
    $this->evinrude->autoload_plugins();
    //Check if we have to use a plugin
    if($this->evinrude->check_using_plugin($this->incoming_path)){
      $this->plugin($this->evinrude->get_plugin_name($this->incoming_path));
      return;
    }
    if($method=='error'){
      $this->$method();
      return;
    }
    $this->index();
  }
	
	function index()
	{
    if($this->evinrude->check_incoming_path()){
      $this->view_data['content']=$this->incoming_path;
    }else{
      $this->view_data['error']=1;
      $this->output->set_status_header('404');
    }
		$this->load->view('main',$this->view_data);
	}

  function plugin($plugin_name)
  {
    $this->evinrude->current_content=trim($this->incoming_path,'/');
    $active_plugin=&$this->evinrude->load_plugin($plugin_name);
    $this->view_data['content']=$active_plugin->activate();
    $this->load->view('main',$this->view_data);
  }

  function error()
  {
    $this->output->set_status_header('404');
    $this->view_data['error']=1;
		$this->load->view('main',$this->view_data);
  }
}