/*
 * Evinrude specific functions
 */
// pajx() is used to call a plugin ajax capability
function pajx(plugin_name,plugin_type,args)
{
  $.ajax({url:uajx,type:'POST',dataType:'script',data:'pn='+plugin_name+'&pt='+plugin_type+'&args='+args});
}