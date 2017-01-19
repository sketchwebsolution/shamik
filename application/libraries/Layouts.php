<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  

class Layouts {
    
  private $ci;
    
  private $title = NULL;
 
  private $metadesc = NULL;
    
  public function __construct() 
  {
    $this->ci =& get_instance();
  }
    
  public function set_title($title)
  {
    $this->title = $title;
  }
 
   public function set_meta($metadesc)
  {
    $this->metadesc = $metadesc;
  }

  public function render($view_name, $params = array(), $layout = 'landing')
  { 
      
    $view_content = $this->ci->load->view($view_name, $params, TRUE);
  
    $this->ci->load->view('Layouts/' . $layout, array(
      'content' => $view_content,
      'title' => $this->title,
      'metadesc' => $this->metadesc,
    ));
  }
    

  

}


