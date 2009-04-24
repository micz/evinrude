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
?>
<html>
<head>
<title>Welcome to Evinrude</title>
<?=meta('Content-type','text/html; charset=utf-8','equiv');?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>graphic/style.css" media="screen" />
</head>
<body>
<h1>Welcome to Evinrude!</h1>
<p><?if($error){
  $this->load->view('error');
}else{
  load_content($content);
}
?></p>
<p><br/>2009 &copy; <a href="http://code.google.com/evinrude/">Evinrude</a><br/>Page rendered in {elapsed_time} seconds</p>
</body>
</html>