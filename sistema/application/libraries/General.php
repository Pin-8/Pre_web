<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

  function save() {
    $this->modelo->save($_POST);
  }

  function delete() {
    $id = $this->get_post("id", 0);
    if ($id == 0) return FALSE;
    $this->modelo->delete($id);
  }

  function get_post($clave,$default = "") {
    $value = $this->input->post($clave);
    if ($value === FALSE) return $default;
    else return ($value);
  }

  function get_get($clave,$default = "") {
    $value = $this->input->get($clave);
    if ($value === FALSE) return $default;
    else return ($value);
  }

  function save_image() {

    $carpeta = $this->get_post("carpeta", "");
    if (!empty($_FILES)) {
      $nombre_file = "uploads/$carpeta/".$_FILES["files"]["name"];

      //Subimos el archivo
      $target_dir = "uploads/$carpeta/";
      $target_file = $target_dir . basename($_FILES["files"]["name"]);
      move_uploaded_file($_FILES["files"]["tmp_name"], $target_file);    
    } 


    echo json_encode(array(
      "src"=>$nombre_file,
    ));
  }

  function delete_image(){
    $nombre = $this->get_post("nombre", "");
    $id = $this->get_post("id", "");
    $data["id"] = $id;
    $data[$nombre] = "";
    $this->modelo->save($data);
  }

  function change_property(){
    $data = array();
    $data['id'] = $this->get_post("id", 0);
    $data['table'] = $this->get_post("table", "");
    $data['property'] = $this->get_post("property", "");
    $data['value'] = $this->get_post("value", "");
    $id = $this->modelo->change_property($data);
    echo json_encode(array(
      "error"=>0,
      "id"=>$id,
    ));
  }


}
