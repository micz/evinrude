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

$config['pre_form_item']='';
$config['post_form_item']='<br/>';
$config['mailto']='evn@example.com';
$config['mailfrom']='evn@example.com';
$config['mailfrom_name']='Evinrude MailForm';
$config['mailsubject']='Web Form';

// Lang definitions
$config['lang']['btnsend']='Send Message';
$config['lang']['form_title']='Contact Us';
$config['lang']['form_sent_msg']='Message sent! Thank you.';
$config['lang']['form_sent_msg_error']='There was an error sending your message!<br/>Please try again in a few minutes.';
$config['lang']['mandatory_field_error']='The %s field is mandatory!';
$config['lang']['mandatory_note']='* This field is mandatory.';
$config['lang']['mail_message_footer']='Mail sent by Evinrude "Mail Form" plugin.';
?>