<? if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Copyright 2009 Evinrude
* This file is part of Evinrude.
* Evinrude is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Evinrude is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Vanilla; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code for Evinrude is available at https://github.com/micz/evinrude
* Contact Mic at m [at] micz [dot] it
*
*/

class Main extends Controller {

  private $view_data;
  private $incoming_path;

  function  __construct() {
		parent::__construct();
    $this->evinrude->basepath=$this->config->item('evn_site_data_folder');
    $this->view_data=array();
    $this->view_data['error']=0;
    $this->view_data['content']='';
	}
	
	function _remap()
  {
    $this->incoming_path=$this->uri->uri_string();
    $this->index();
  }
	
	function index()
	{
    if($this->evinrude->check_incoming_path($this->incoming_path)){
      $this->view_data['content']=$this->incoming_path;
    }else{
      $this->view_data['error']=1;
    }
		$this->load->view('main',$this->view_data);
	}
}