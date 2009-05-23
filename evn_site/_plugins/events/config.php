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
// General plugin configuration
// Files and Dirs
$config['data_folder']='data';
$config['next_events_folder']='next';
$config['past_events_folder']='past';
$config['permalink_index_file']='permalink.txt';
$config['template_folder']='tpl';

// HTML elements
$config['page_title_main']='Events';
$config['page_title_separator']=' :: ';
$config['title_next']='Next Events';
$config['title_past']='Past Events';
$config['title_abstract']='Events';
$config['download_icon_url']='';
$config['download_anchor_text']='Download the brochure';
$config['download_title_text']='Download the brochure';

//Various
$config['element_tags']=array('title','dl_link','date','location','desc');

// Lang definitions
$config['lang']['event_not_found']='Sorry, the requested event is not present in the archive.';
$config['lang']['no_events']='The are no events in the archive.';
?>