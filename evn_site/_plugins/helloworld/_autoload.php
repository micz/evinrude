<?
class helloworld extends EvnAutoloadPlugin{
  function execute($args=array())
  {
    return '<div id="autop">Hello world!! I\'m an autoloaded <a href="http://code.google.com/p/evinrude/wiki/Plugins">plugin</a>!!</div>';
  }
}
?>