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
?>
<h1><?= $this->config['lang']['form_title']?></h1>
<?if($is_sent){
    if(!$is_sent_error){
      ?><div class="mf_error_msg"><?= $this->config['lang']['form_sent_msg']?></div><?
    }else{
      ?><div class="mf_error_msg"><?= $this->config['lang']['form_sent_msg_error']?></div><?
    }
}
if($is_sent_mandatory_error!=''){?>
 <div class="mf_error_msg"><?= $is_sent_mandatory_error?></div>
<?}?>
<div class="mf_form">
<form name="evnmailform" method="POST" action="<?=$this->CI->uri->uri_string()?>">
  <input type="hidden" value="1" id="form_sent" name="form_sent"/>
  <?=$form?>
  <input type="submit" value="<?=$this->config['lang']['btnsend']?>" name="btnsend" id="btnsend"/>
</form>
</div>
<div class="mf_footer_msg"><?= $this->config['lang']['mandatory_note']?></div>