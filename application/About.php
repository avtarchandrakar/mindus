<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {





public function index(){ 

  $data['pagename'] = "About Page"; 
  $data['cat_value'] = $this->Main_model->all_events_cat();

  $this->load->view('about', $data);

}
public function best_practice(){ 

  $data['pagename'] = "About Page"; 
  $data['cat_value'] = $this->Main_model->all_events_cat();

  $this->load->view('best_practice', $data);

}

public function strategic_plan(){ 

$data['pagename'] = "About Page"; 
$data['cat_value'] = $this->Main_model->all_events_cat();

$this->load->view('strategic_plan', $data);

}

public function vission(){ 

$data['pagename'] = "About Page"; 
$data['cat_value'] = $this->Main_model->all_events_cat();

$this->load->view('vission', $data);

}
public function photo_gallery(){ 

  $data['pagename'] = "About Page"; 
  $data['cat_value'] = $this->Main_model->all_events_cat();
  
  $this->load->view('photo_gallery', $data);
  
  }
  public function press(){ 

    $data['pagename'] = "About Page"; 
    $data['cat_value'] = $this->Main_model->all_events_cat();
    
    $this->load->view('press', $data);
    
    }
}


?>