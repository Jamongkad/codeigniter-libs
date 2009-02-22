<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * j!Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 * also a friendly fork of CodeIgniter.
 *
 * @package		j!gniter
 * @author		Mathew Wong
 * @copyright	        Copyright (c) 2007, YGiraffe, Inc.
 * @license		http://www.jignitor.com/user_guide/license.html
 * @link		http://www.jigniter.com
 * @date                February 22, 2008
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Templater Class
 *
 * This is a nice wrapper class built on top of the original CI loader. 
 *
 * @package	j!Igniter
 * @subpackage	Loader
 * @category	Views
 * @author		Mathew Wong
 */
 class Templater {
  
  var $JI;
  var $folder = 'snippets';
  var $header = 'header';
  var $main_layout = 'layout';
  var $footer = 'footer';
  var $template = array();  
   
  public function __construct(){
   $this->JI = CI_Base::get_instance();
   $this->JI->load->library('parser');
   log_message('debug','Templater Class Initialized');
  }

  public function title($title = ''){
   $this->template['title'] = $title; 
   return $this; 
  }

  public function header($header = '', $data = '') {
   $this->template['header'] = $this->JI->load->view("$this->folder/$header",$data,TRUE);
   return $this;
  }

  public function content($content = '',$data = '',$parse = false){
   if($parse != false)
    $this->template['content'] = $this->JI->parser->parse($content,$data);
   else
    $this->template['content'] = $this->JI->load->view($content,$data,TRUE);
    
    return $this;
  }

  public function haml($content = '') {
      $parser = new HamlParser();
      //$this->template['content'] = $parser->setFile(APPPATH.'/views/'.$content);
      echo $parser->setFile(APPPATH.'/views/'.$content);
      //return $this;
  }

  public function footer($footer = '',$data = '') {
   $this->template['footer'] = $this->JI->load->view("$this->folder/$footer",$data,TRUE);  
   return $this;
  }

  public function partial($view,$data = '') {
   print $this->JI->load->view($view,$data);
  }  
   
  public function render($over_ride = FALSE) {
   if($over_ride == FALSE) $this->check_values(); 
   $this->JI->load->view($this->main_layout,$this->template);
   return $this;
  }
  
  private function check_values() {
   (!empty($this->header)) ? $this->template['header'] = $this->JI->load->view("$this->folder/$this->header",'',TRUE) : ''; 
   (!empty($this->footer)) ? $this->template['footer'] = $this->JI->load->view("$this->folder/$this->footer",'',TRUE) : '';  
   return $this;
  }

  private function reset() { 
   $this->folder = '';
   $this->header = '';
   $this->main_layout = '';
   $this->footer = '';
   $this->template = array();  
   return $this;
  } 
 }
?>
