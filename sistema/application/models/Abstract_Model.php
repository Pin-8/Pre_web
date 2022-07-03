<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abstract_model extends CI_Model {
  
  private $total = 0;
  public $db = "";

  function __construct($tabla) {
    parent::__construct();
    $this->tabla = $tabla;
    $this->db = $this->load->database("default", TRUE);
  }

  function change_property($data) {
    $id = isset($data["id"]) ? $data["id"] : 0;
    $table = isset($data["table"]) ? $data["table"] : 0;
    $property = isset($data["property"]) ? $data["property"] : 0;
    $value = isset($data["value"]) ? $data["value"] : 0;

    $sql = "UPDATE $table SET $property = '".$value."' WHERE id = '".$id."' ";
    $this->db->query($sql);
    return $id;
  }

  function get($id) {

    $query = $this->db->get_where($this->tabla,array("id"=>$id));

    $row = $query->row(); 
    $this->db->close();
    return $row;
  }  

  function delete($id) {
    //Actualizar: QUE EL USUARIO ESTE LOGEADO PARA BORRAR
    $sql = "DELETE FROM $this->tabla WHERE id = '$id' ";
    echo $sql;
    $this->db->query($sql);
  }
    


  function save($data){
    if ($data["id"] == 0) {
      $data = $this->limpiar_campos($data,$this->tabla);
      $this->db->insert($this->tabla,$data);
      $id = $this->db->insert_id();
      $this->db->close();
      if (!isset($id)) return -1;
      else return $id;
    } else {
      $data = $this->limpiar_campos($data,$this->tabla);
      $this->db->where("id",$data["id"]);
      $this->db->update($this->tabla,$data);
      $aff = $this->db->affected_rows();
      $this->db->close();
      return $aff;
    }
  }

  public function limpiar_campos($obj = null,$tabla = "") {
    if ($obj === FALSE || empty($obj) || is_null($obj)) return;
    if (empty($tabla)) return;
    $campos = $this->db->list_fields($tabla);
    foreach($obj as $key => $value) {
      if (!in_array($key, $campos)) {
        if (is_object($obj)) unset($obj->{$key});
        else if (is_array($obj)) unset($obj[$key]);
      } else {
        if ($tabla == "articulos" || $tabla == "inm_propiedades" || $tabla == "rubros" || $tabla == "usuarios") {
          // SACAMOS LAS COMILLAS
          if (is_object($obj)) {
            //$obj->{$key} = str_replace("\"", "", $obj->{$key});
            $obj->{$key} = str_replace("'", "", $obj->{$key});
          } else if (is_array($obj)) {
            //$obj[$key] = str_replace("\"", "", $obj[$key]);
            $obj[$key] = str_replace("'", "", $obj[$key]);
          }
        }
      }
    }      
    return $obj;
  }

      
}