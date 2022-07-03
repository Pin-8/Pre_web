<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("abstract_model.php");

class Entradas_Model extends Abstract_Model {
  
  function __construct() {
    parent::__construct("entradas");
  }

  function buscar($conf = array()) {

    $limit = isset($conf["limit"]) ? $conf["limit"] : 0;
    $offset = isset($conf["offset"]) ? $conf["offset"] : 10;
    $id_categoria = isset($conf["id_categoria"]) ? $conf["id_categoria"] : 0;
    $filter = isset($conf["filter"]) ? $conf["filter"] : "";
    
    $sql = "SELECT SQL_CALC_FOUND_ROWS E.*, ";
    $sql.= "DATE_FORMAT(E.fecha_creacion, '%H:%i %d/%m/%Y') as fecha_creacion_es,";
    $sql.= "IF(C.nombre IS NULL, 'Ninguna', C.nombre) as nombre_categoria ";
    $sql.= "FROM entradas E ";
    $sql.= "LEFT JOIN categorias C ON (C.id = E.id_categoria) ";
    $sql.= "WHERE 1 = 1 ";
    if (!empty($id_categoria)) $sql.= "AND E.id_categoria = '$id_categoria' ";
    if (!empty($filter)) $sql.= "AND E.titulo LIKE '%$filter%' ";
    $sql.= "ORDER BY E.fecha_creacion DESC ";
    $sql.= "LIMIT $limit,$offset ";
    $q = $this->db->query($sql);
    
    $q_total = $this->db->query("SELECT FOUND_ROWS() AS total");
    $total = $q_total->row();
    
    return array(
      "results"=>$q->result(),
      "total"=>$total->total,
    );
  } 


  function save($data) {

    if ($data["id"] == 0) $data['fecha_creacion'] = date("Y-m-d H:i:s");
    $data['fecha_actualizacion'] = date("Y-m-d H:i:s");

    $id = parent::save($data);
    return $id;
  }

}