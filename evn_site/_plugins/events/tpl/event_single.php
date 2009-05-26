<h2><?=$title?></h2>
<p><b><?=$date?><br/>
<?=$location?></b></p><p>
</p><p><?=$desc?></p>
<?if(trim($dl_link)!=''){?><p><a href="<?=$dl_link?>" title="<?=$this->config['download_title_text']?>"> <?=$this->config['download_anchor_text']?></a><?}?>
<p><a href="<?=base_url().$this->base_path.'/'.$item_permalink?>">permalink</a></p>
<p><a href="<?=base_url().$this->base_path?>"><?=$this->config['lang']['all_events']?></a></p>
