<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("abstract_model.php");

class Web_Model extends Abstract_Model {
  
  function __construct() {
    parent::__construct("informacion_web");
  }

  function get($id = 0) {
    $sql = "SELECT * FROM informacion_web LIMIT 0,1 ";
    $q = $this->db->query($sql);
    return $q->row();
  }

}