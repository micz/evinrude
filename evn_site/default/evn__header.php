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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?=meta('Content-type','text/html; charset=utf-8','equiv');?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>Welcome to Evinrude!<?=get_template_var('title')?></title>
<link rel="shortcut icon" href="<?=evn_style_url()?>/img/evinrude_icon.png" />
<!-- style START -->
<!-- default style -->
<style type="text/css" media="screen">@import url(<?=evn_style_url()?>style.css );</style>
<!-- for translations -->
<!--[if IE]>
<link rel="stylesheet" href="<?=evn_style_url()?>/ie.css" type="text/css" media="screen" />
<![endif]-->
<!-- style END -->
<meta name="generator" content="Evinrude CMS <?=$this->evinrude->get_version();?>" />
<script type="text/javascript" src="<?=base_url()?>js/evn.js"></script>
</head>
<body>
<!-- wrap START -->
<div id="wrap">
<!-- container START -->
<div id="container">
<!-- header START -->
<div id="header">
<div id="caption">
<h1 id="title"><a href="<?=base_url();?>">Welcome to Evinrude!</a></h1>
<div id="tagline">A small but powerful CMS</div>
</div>
	<div class="fixed"></div>
</div>
<!-- header END -->