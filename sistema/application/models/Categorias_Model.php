<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("abstract_model.php");

class Categorias_Model extends Abstract_Model {
  
  function __construct() {
    parent::__construct("categorias");
  }

  function get_categorias_arbol($id_padre = 0) {
    $result = array();
    $sql = "SELECT * FROM categorias C ";
    $sql.= "WHERE 1 = 1 ";
    if ($id_padre !== NULL) $sql.= "AND C.id_padre = $id_padre ";
    $sql.= "ORDER BY C.orden ASC ";
    $q = $this->db->query($sql);
    foreach($q->result() as $row) {
      $row->hijos = $this->get_categorias_arbol($row->id);
      $result[] = $row;
    }
    return $result;
  }

  function get_categorias_select($id_padre = 0, $separador = "") {
    $result = array();
    $sql = "SELECT * FROM categorias C ";
    $sql.= "WHERE 1 = 1 ";
    if ($id_padre !== NULL) $sql.= "AND C.id_padre = $id_padre ";
    $sql.= "ORDER BY C.orden ASC ";
    $q = $this->db->query($sql);
    foreach($q->result() as $row) {
      $row->nombre = $separador.$row->nombre;
      $result[] = $row;
      $hijos = $this->get_categorias_select($row->id,$separador."&nbsp;&nbsp;&nbsp;");
      $result = array_merge($result,$hijos);
    }
    return $result;    
  }





}