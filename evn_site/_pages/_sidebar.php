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
