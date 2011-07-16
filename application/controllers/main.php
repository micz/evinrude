<? if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright 2011 Evinrude
 * This file is part of Evinrude.
 * Evinrude is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
 * Evinrude is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with Evinrude; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * The latest source code for Evinrude is available at https://github.com/micz/evinrude
 * Contact Mic at m [at] micz [dot] it
 *
 */

class Main extends CI_Controller
{

    private $view_data;
    private $incoming_path;

    function __construct()
    {
        parent::__construct();
        $this->view_data = array();
        $this->view_data['error'] = 0;
        $this->view_data['content'] = '';
        $cache_min = $this->config->item('evn_cache_minutes');
        if ($cache_min > 0)$this->output->cache($cache_min);
    }

    function _remap($method)
    {
        $this->incoming_path = $this->uri->uri_string();
        $this->evinrude->set_incoming_path($this->incoming_path);
        $this->evinrude->autoload_plugins();
        if (in_array($method, array('error', 'ajax', 'admin'))) {
            $this->$method();
            return;
        }
        $this->index();
    }

    function index()
    {
        if ($this->evinrude->check_incoming_path()) {
            $this->view_data['content'] = $this->incoming_path;
        } elseif ($this->evinrude->check_using_plugin()) {
            //Check if we have to use a plugin
            $this->plugin($this->evinrude->get_plugin());
            return;
        } else {
            $this->view_data['error'] = 1;
            $this->output->set_status_header('404');
            $this->view_data['content'] = 'error';
            $this->incoming_path = '';
        }
        $this->load->view('main', $this->view_data);
    }

    function plugin($plugin_name)
    {
        $this->evinrude->current_content = trim($this->incoming_path, '/');
        $active_plugin = &$this->evinrude->load_plugin($plugin_name);
        if ($active_plugin != null) {
            $this->view_data['content'] = $active_plugin->activate();
            $this->load->view('main', $this->view_data);
        } else {
            $this->view_data['content'] = 'error';
            $this->incoming_path = '';
            $this->error();
        }
    }

    function ajax()
    {
        $out_buffer = '';
        if (!$plugin_name = $this->input->post('pn')) {
            $this->output->set_output($out_buffer);
            return;
        }
        if (!$plugin_type = $this->input->post('pt')) {
            $plugin_type = '';
        }
        if ($ser_args = $this->input->post('args')) {
            $plugin_args = unserialize($ser_args);
        } else {
            $plugin_args = array();
        }
        $active_plugin = &$this->evinrude->load_plugin($plugin_name, $plugin_type == 'auto');
        $out_buffer = $active_plugin->ajax($plugin_args);
        $this->output->set_output($out_buffer);
    }

    function error()
    {
        $this->output->set_status_header('404');
        $this->view_data['error'] = 1;
        $this->load->view('main', $this->view_data);
    }

  function admin()
  {
    $evnadm=new EvnAdmin($this->incoming_path);
    $this->view_data=array_merge($evnadm->get_view_data(),$this->view_data);
    $this->load->vars($this->view_data);
		$this->load->view('admin/main');
  }
}
