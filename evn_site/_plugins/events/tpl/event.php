<h3><?=$title?></h3>
<p><b><?=$date?><br/>
<?=$location?></b></p><p>
</p><p><?=$desc?></p>
<?if(trim($dl_link)!=''){?><p><a href="<?=$dl_link?>" title="<?=$this->config['download_title_text']?>"> <?=$this->config['download_anchor_text']?></a><?}?>