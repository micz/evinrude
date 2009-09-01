<? if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* Copyright 2011 Evinrude
* This file is part of Evinrude.
* Evinrude is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Evinrude is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Evinrude; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code for Evinrude is available at https://github.com/micz/evinrude
* Contact Mic at m [at] micz [dot] it
*
*/
//------------------------------------------------=
//-------       USER EDITABLE OPTIONS       ------=
//------------------------------------------------=
//-- Active theme name
$config['evn_active_theme']='default';
//-- Caching option
//Number of minutes before the cache is refreshed.
//If set equal to 0 the caching is disabled.
//WARNING: system/application folder must be writeable.
$config['evn_cache_minutes']=0;
//------------------------------------------------=
//------------------------------------------------=


//------------------------------------------------=
//-------              PLUGINS               -----=
//------------------------------------------------=
//Plugins are located in the /evn_site/_plugins directory (as defined below)
//Any plugin is contained in its own directory (named as the plugin name)
//More info at http://code.google.com/p/evinrude/wiki/Plugins
//------------------------------------------------=
//-- Active Plugins
//Use it this way: $config['evn_active_plugins'] = array('myfirsturl'=>'myfirstplugin','mysecondurl/pluginsubdir'=>'asecondplugin');
//In every values pair the first is the path and the second is the plugin name. DO NOT USE TRAILING SLASHES!
$config['evn_active_plugins']=array('demoplugin'=>'helloworld');
//------------------------------------------------=
//-- Autoloaded plugins
//Use it this way: $config['evn_autoload_plugins'] = array('myfirstautoloadplugin','asecondautoloadplugin');
$config['evn_autoload_plugins']=array('helloworld');
//------------------------------------------------=
//------------------------------------------------=



//------------------------------------------------=
//--- CHANGE ONLY IF YOU KNOW WHAT YOU'RE DOING --=
//------------------------------------------------=
//Content and plugins files path (relative to www/index.php)
$config['evn_site_pages_folder']='./evn_site/_pages/';
$config['evn_site_plugins_folder']='./evn_site/_plugins/';
//Themes files folder (must be in document root)
$config['evn_themes_folder']='evn_themes/';
//Admin Dashboard url path
$config['evn_admin_path']='admin';
//------------------------------------------------=
//------------------------------------------------=
?>