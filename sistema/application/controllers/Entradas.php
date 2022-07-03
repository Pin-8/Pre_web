<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/General.php';

class Entradas extends General {

  function __construct(){
    parent::__construct();
    $this->load->model("entradas_model","modelo");
  }

  function listado($pag = 1, $id_categoria = 0) {
    
    $filter = $this->get_get("filter", "");
    $limit = ($pag - 1) * 10;

    $res = $this->modelo->buscar(array(
      "limit"=>$limit,
      "offset"=>10,
      "id_categoria"=>$id_categoria,
      "filter"=>$filter,
    ));

    $this->load->model("Categorias_Model");
    $categorias = $this->Categorias_Model->get_categorias_select();


    $this->load->view("entradas/listado", array(
      "resultados"=>$res['results'],
      "total"=>$res['total'],
      "pag"=>$pag,
      "categorias"=>$categorias,
      "id_categoria"=>$id_categoria,
    ));
  }

  function detalle($id = 0){

    if ($id > 0) {
      $data = $this->modelo->get($id);
    } else {
      $data = new stdClass();
      $data->titulo = "";
      $data->path = "";
      $data->descripcion = "";
      $data->precio = 0;
    }

    $this->load->model("Categorias_Model");
    $categorias = $this->Categorias_Model->get_categorias_select();

    $this->load->view("entradas/detalle", array(
      "id"=>$id,
      "entrada"=>$data,
      "categorias"=>$categorias,
    ));
  }

}
