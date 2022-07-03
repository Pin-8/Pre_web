<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once("abstract_model.php");

class Usuarios_Web_Model extends Abstract_Model {
  
  function __construct() {
    parent::__construct("usuarios_web");
  }

  function get_by_data($conf = array()){
    $email = isset($conf["email"]) ? $conf["email"] : "";
    $password = isset($conf["password"]) ? $conf["password"] : "";

    $password = md5($password);

    $sql = "SELECT * FROM usuarios_web ";
    $sql.= "WHERE password = '$password' ";
    $sql.= "AND (email = '$email' OR nombre_usuario = '$email') ";
    $sql.= "LIMIT 0,1 ";
    $q = $this->db->query($sql);

    if ($q->num_rows() == 0) return FALSE;
    else return $q->row();    
  }

  function buscar($conf = array()) {

    $limit = isset($conf["limit"]) ? $conf["limit"] : 0;
    $offset = isset($conf["offset"]) ? $conf["offset"] : 10;
    $estado = isset($conf["estado"]) ? $conf["estado"] : 0;
    $filter = isset($conf["filter"]) ? $conf["filter"] : "";
    $busqueda = isset($conf["busqueda"]) ? $conf["busqueda"] : "";
    
    $sql = "SELECT SQL_CALC_FOUND_ROWS UW.*, ";
    $sql.= "DATE_FORMAT(UW.fecha_nac, '%H:%i %d/%m/%Y') as fecha_nac_es ";
    $sql.= "FROM usuarios_web UW ";
    $sql.= "WHERE 1 = 1 ";
    if ($estado >= 0) $sql.= "AND UW.estado = '$estado' ";
    if (!empty($filter)) $sql.= "AND UW.nombre_usuario LIKE '%$filter%' ";
    if (!empty($busqueda)) $sql.= "AND (email = '$busqueda' OR nombre_usuario = '$busqueda') ";
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

    if ($data["id"] == 0) $data['fecha_registro'] = date("Y-m-d H:i:s");
    $data['fecha_ultima_act'] = date("Y-m-d H:i:s");

    if (isset($data['fecha_nac']) && empty($data['fecha_nac'])) unset($data['fecha_nac']);

    if (isset($data['password']) && !empty($data['password'])) {
      $data['password'] = md5($data['password']);
    } else {
      unset($data['password']);
    }

    $id = parent::save($data);
    return $id;
  }

  function check_password($conf = array()){
    $password = isset($conf["password"]) ? $conf["password"] : "";
    $id = isset($conf["id"]) ? $conf["id"] : "";

    $password = md5($password);

    $sql = "SELECT * FROM usuarios_web ";
    $sql.= "WHERE password = '$password' ";
    $sql.= "AND id = $id ";
    $sql.= "LIMIT 0,1 ";
    $q = $this->db->query($sql);

    if ($q->num_rows() == 0) return FALSE;
    else return $q->row();    
  }


}