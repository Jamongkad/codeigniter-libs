<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
/**
* Html Class
*
* This class allows one to express html dom structures
* in a idiomatic manner.
*
*/

class Html {    

 public function __call($method, $args) {
  return $this->htmlize($method, $args[0], (isset($args[1])? $args[1] : false ));
 }
 
 private function htmlize($method, $contents, $style=false) { 
  return $this->sprintf2("<%method %style> %contents </%method>", array(
        'method' => $method,
        'contents' => (is_array($contents) ? $this->dissect($contents) : $contents),
        'style' => $style
   ));
 }
 
 private function sprintf2($str, $vars, $char = '%') {
   if(is_array($vars)) {
     uksort($vars, array($this, 'cmp'));
     
     foreach($vars as $k => $v){
       $str = str_replace($char . $k, $v, $str);
     }

   }

   return $str;
 }

 private function cmp($a, $b) {
   return strlen($b) - strlen($a);
 }

 private function dissect($arr) {
   $map = new Map();
   return xM(fx('$x'))->join($arr);
 }
}

function p($contents) {
 $name = __FUNCTION__;
 return createDOM($name,$contents);
}

function div($contents) {
 $name = __FUNCTION__;   
 return createDOM($name,$contents);
}

function span($contents) {
 $name = __FUNCTION__;   
 return createDOM($name,$contents);  
}

//In python this could have been a decorator function.
function createDOM($name,$contents) {
  $html = new Html();   
  return $html->$name($contents);
}
?>
