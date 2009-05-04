<? if (!defined('BASEPATH')){ header('Location: /');exit; }
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
<!-- footer START -->
<div id="footer">
	<a id="gotop" href="#" onclick="goTop(0.5,16);return false;">Top</a>
	<a id="powered" href="http://code.google.com/p/evinrude/">Evinrude CMS</a>
	<div id="copyright">
Powered by <a href="http://code.google.com/p/evinrude/">Evinrude CMS</a> v<?=$this->evinrude->get_version();?><br/>Page rendered in {elapsed_time} seconds</div>
	<div id="themeinfo">
		Graphic based on a <a href="http://www.neoease.com/themes/" rel="nofollow">mg12</a> work</div>
</div>
<!-- footer END -->
</div>
<!-- container END -->
</div>
<!-- wrap END -->
</body>
</html>