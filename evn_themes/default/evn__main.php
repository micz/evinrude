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
//Preload the user content, so we can set the needed template vars
/*<img src="<?=evn_img_url('evinrude_logo.png')?>" alt="Evinrude" title="Evinrude">*/
$ext_content=content_preload($content);
tpl_load_header();
?>
<!-- content START -->
<div id="content">
<!-- main START -->
<div id="main"><div class="post"><?
if($error||($ext_content==false)){
  tpl_load_error();
}else{
  //This outputs the user content
  content_publish($ext_content);
}
?></div></div>
<!-- main END -->
<?tpl_load_sidebar();?>
<div class="fixed"></div>
</div>
<!-- content END -->
<?tpl_load_footer();?>