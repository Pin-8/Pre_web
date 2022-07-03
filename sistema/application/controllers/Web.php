<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/General.php';

class Web extends General {

  function __construct(){
    parent::__construct();
    $this->load->model("web_model","modelo");
  }

  function informacion(){

    $data = $this->modelo->get();

    $this->load->view("web/informacion", array(
      "informacion"=>$data,
    ));
  }

}
