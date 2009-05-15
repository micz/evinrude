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
<!-- sidebar START -->
<div id="sidebar">
<!-- sidebar north START -->
<div id="northsidebar" class="sidebar">
<div class="widget">
<h3></h3>
<ul>
  <li><a href="<?=site_url()?>"<?=evn_active_page()?' class="active"':''?>>Main</a></li>
  <li><a href="<?=site_url('a_file')?>"<?=evn_active_page('a_file')?' class="active"':''?>>File php</a></li>
  <li><a href="<?=site_url('an_html_file')?>"<?=evn_active_page('an_html_file')?' class="active"':''?>>File html</a></li>
  <li><a href="<?=site_url('subdir')?>"<?=evn_active_page('subdir')?' class="active"':''?>>Subdir php</a>
  <ul><li><a href="<?=site_url(array('subdir','subfile'))?>"<?=evn_active_page(array('subdir','subfile'),1)?' class="active"':''?>>Subfile</a></li></ul></li>
  <li><a href="<?=site_url('subdir2')?>"<?=evn_active_page('subdir2')?' class="active"':''?>>Subdir html</a></li>
  <li><a href="<?=site_url('demoplugin')?>"<?=evn_active_page('demoplugin')?' class="active"':''?>>Demo plugin</a>
  <ul><li><a href="<?=site_url(array('demoplugin','subdir'))?>"<?=evn_active_page(array('demoplugin','subdir'),1)?' class="active"':''?>>Subdir</a></li></ul></li>
</ul>
</div>
</div>
<!-- sidebar north END -->
</div>
<!-- sidebar END -->