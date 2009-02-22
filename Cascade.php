<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Cascade Class
*
* This class allows the true loading of class libraries.
* None of the nonsense that the Loader class instantiates 
* for us. Thus one can load objects on demand rather than
* preloading them via the Loader class.
*
*/
final class Cascade {
 function __construct() {   
  spl_autoload_register(array('Cascade','_gf_autoload')); 
 }

 public static function _gf_autoload($class) {
  if(!strstr($class,'CI') and !strstr($class, 'PEAR')) { 

   if(file_exists(APPPATH.'libraries/'.$class.EXT))
    require_once(APPPATH.'libraries/'.$class.EXT);                                   
   elseif(file_exists(APPPATH.'models/'.$class.EXT))
    require_once(APPPATH.'models/'.$class.EXT);
   else
    require_once(BASEPATH.'libraries/'.$class.EXT); 

  }
 }
}
?>
