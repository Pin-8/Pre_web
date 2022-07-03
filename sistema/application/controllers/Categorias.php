<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/General.php';

class Categorias extends General {

  function __construct(){
    parent::__construct();
    $this->load->model("categorias_model","modelo");
  }

  function listado($pag = 1) {
    
    $limit = ($pag - 1) * 10;

    $res = $this->modelo->get_categorias_arbol();

    $this->load->view("categorias/listado", array(
      "resultados"=>$res,
    ));
  }

  function detalle($id = 0){

    if ($id > 0) {
      $data = $this->modelo->get($id);
    } else {
      $data = new stdClass();
      $data->nombre = "";
      $data->id_padre = 0;
    }

    $categorias = $this->modelo->get_categorias_select();
    
    $this->load->view("categorias/detalle", array(
      "id"=>$id,
      "categoria"=>$data,
      "categorias"=>$categorias,
    ));
  }

  function guardar_categorias(){
    $filtros = parent::get_post("lista", array());
    $this->actualizar_categorias($filtros, 0);
  }

  function actualizar_categorias($categorias, $id_padre){
    $orden = 0;
    foreach ($categorias as $h) {
      $id_categoria = $h["id"];
      $sql = "UPDATE categorias SET orden = '$orden', id_padre = '$id_padre' WHERE id = '$id_categoria' ";
      $this->db->query($sql);

      if (isset($h["children"])) $this->actualizar_categorias($h["children"], $id_categoria);
      $orden++;
    }
  }

}
