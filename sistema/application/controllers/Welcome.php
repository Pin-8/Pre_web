<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$this->load->view('inicio');
	}

  function check() {
    $nombre = $this->input->post("nombre");
    $password = $this->input->post("password");

    $password = md5($password);

    $sql = "SELECT * FROM usuarios_panel WHERE email = '$nombre' AND password = '$password' ";
    $q = $this->db->query($sql);
    if ($q->num_rows() == 0) {
      echo json_encode(array(
        "error"=>1,
        "mensaje"=>"Los datos ingresados no son correctos",
      ));
      exit;
    } else {
      $row = $q->row();
      if (session_status() === PHP_SESSION_NONE) { session_start(); }
      $_SESSION['id'] = $row->id;
      echo json_encode(array(
        "error"=>0,
        "id"=>"1",
      ));
    }
  }

  function salir(){
    session_start(); 
    session_destroy();
    session_unset();  
    echo json_encode(array(
      "error"=>0,
    ));
  }
}
