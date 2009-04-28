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
//Preload the user content, so we can set the needed template vars
$ext_content=load_content($content);
?>
<html>
<head>
<title>Welcome to Evinrude<?=get_template_var('title')?></title>
<?=meta('Content-type','text/html; charset=utf-8','equiv');?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>graphic/style.css" media="screen" />
</head>
<body>
<div id="wrapper">
<div id="evn_logo"><img src="<?=evn_img_url('evinrude_logo.png')?>" alt="Evinrude" title="Evinrude"></div>
<h1>Welcome to Evinrude!</h1>
<div id="left">
<?tpl_load_master_file('sidebar')?>
</div><div id="main">
<p><?
if($error){
  tpl_load_master_file('error');
}else{
  //output the user content
  echo $ext_content;
}
?></p>
</div>
<div id="footer">
<?tpl_load_master_file('footer');?>
</div>
</div>
</body>
</html>