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
/*
Plugin Name: MailForm
Plugin URI: http://code.google.com/p/evinrude/wiki/Plugins
Description: Lets set a redirect URL for a given path.
Version: 1.0
Author: Mic
Author URI: http://micz.it/
*/

class mailform extends EvnPlugin{

  function  __construct($incoming_path){
    parent::__construct($incoming_path);
    $this->CI->output->cache(0);
  }

  function activate()
  {
    $this->load_config();
    $out_buffer='';
    $template_data=array();
    if($this->CI->input->post('form_sent')){
      $formdata=$this->_get_form_items();
      $template_data['is_sent_mandatory_error']='';
      //Check all the mandatory items
      foreach ($formdata as $formitem){
        if(($formitem[3]=='1')&&($this->CI->input->post($formitem[1])=='')){
          if($template_data['is_sent_mandatory_error']!='')$template_data['is_sent_mandatory_error'].='<br/>';
          $template_data['is_sent_mandatory_error'].=@sprintf($this->config['lang']['mandatory_field_error'],$formitem[0]);
        }
      }
      if($template_data['is_sent_mandatory_error']==''){
        $template_data['is_sent']=1;
        $template_data['is_sent_error']=!$this->send_mail($formdata);
      }
    }
    $template_data['form']=$this->_get_form();
    $out_buffer.=$this->get_template($this->get_plugin_path().'template.php',$template_data);
    return $out_buffer;
  }

  private function _get_form_items()
  {
     if($formdata=@file_get_contents($this->get_plugin_path().'form.txt')){
      $out_buffer=array();
      if($formdata=='')return false;
      $formdata=str_replace("\r","\n",$formdata);
      $lines=explode("\n",$formdata);
      foreach($lines as $line){
        $dataline=explode('::',$line);
        if(count($dataline)<4)continue;
        $out_buffer[]=$dataline;
      }
      return $out_buffer;
    }else{
      return false;
    }
  }

  private function _get_form()
  {
    $out_buffer='';
    if($formdata=$this->_get_form_items()){
      if(!$formdata)return false;
      foreach($formdata as $dataline){
        if($dataline[2]!='textarea'){
          $out_buffer.=$this->config['pre_form_item'].$dataline[0].($dataline[3]=='1'?'*':'').' <input type="'.$dataline[2].'" name="'.$dataline[1].'" id="'.$dataline[1].'" value="'.$this->CI->input->post($dataline[1]).'"/>'.$this->config['post_form_item'];
        }else{
          $out_buffer.=$this->config['pre_form_item'].$dataline[0].($dataline[3]=='1'?'*':'').' <textarea name="'.$dataline[1].'" id="'.$dataline[1].'">'.$this->CI->input->post($dataline[1]).'</textarea>'.$this->config['post_form_item'];
        }
      }
      return $out_buffer;
    }else{
      return false;
    }
  }

  private function send_mail($formdata='')
  {
    $this->CI->load->library('email');
    $this->CI->email->from($this->config['mailfrom'],$this->config['mailfrom_name']);
    $this->CI->email->to($this->config['mailto']);
    $this->CI->email->subject($this->config['mailsubject']);
    $mail_message='';
    if($formdata=='')$formdata=$this->_get_form_items();
    foreach($formdata as $formitem){
      $mail_message.=$formitem[0].'= '.$this->CI->input->post($formitem[1])."\r\n";
    }
    $mail_message.="\r\n\r\n".$this->config['lang']['mail_message_footer'];
    $this->CI->email->message($mail_message);
    return $this->CI->email->send();
  }
}
?>