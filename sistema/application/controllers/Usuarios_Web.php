<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/General.php';

class Usuarios_Web extends General {

  function __construct(){
    parent::__construct();
    $this->load->model("usuarios_web_model","modelo");
  }

  function listado($pag = 1, $estado = -1) {

    $filter = parent::get_get("filter", "");
    $limit = ($pag - 1) * 10;

    $res = $this->modelo->buscar(array(
      "limit"=>$limit,
      "offset"=>10,
      "estado"=>$estado,
      "filter"=>$filter,
    ));


    $this->load->view("usuarios_web/listado", array(
      "resultados"=>$res['results'],
      "total"=>$res['total'],
      "pag"=>$pag,
      "id_estado"=>$estado,
    ));
  }

  function detalle($id = 0){

    if ($id > 0) {
      $data = $this->modelo->get($id);
    } else {
      $data = new stdClass();
      $data->id = 0;
      $data->estado = 1;
      $data->nombre = "";
      $data->apellido = "";
      $data->email = "";
      $data->password = "";
      $data->telefono = "";
      $data->direccion = "";
      $data->localidad = "";
      $data->fecha_nac = "0000-00-00";
      $data->idiomas = "";
      $data->foto_perfil = "";
      $data->dni = "";
      $data->cuit = "";
      $data->descripcion = "";
      $data->nombre_usuario = "";
    }

    $this->load->view("usuarios_web/detalle", array(
      "id"=>$id,
      "usuario_web"=>$data,
    ));
  }

  function check(){
    $email = parent::get_post("email");
    $password = parent::get_post("password");

    $r = $this->modelo->get_by_data(array(
      "email"=>$email,
      "password"=>$password,
    ));

    if ($r === FALSE) {
      echo json_encode(array(
        "error"=>1,
        "mensaje"=>"Parametros incorrectos",
      ));
      exit;
    } 

    if ($r->estado == 1) {
      echo json_encode(array(
        "error"=>1,
        "mensaje"=>"Su usuario se encuentra inactivo. Contactese con un Administrador",
      ));
      exit;   
    } elseif ($r->estado == 0) {
      echo json_encode(array(
        "error"=>1,
        "mensaje"=>"Su usuario se encuentra en espera de activación.",
      ));
      exit;   
    }

    echo json_encode(array(
      "error"=>0,
      "id"=>$r->id,
    ));


  }

  function guardar_web(){
    $data = $_POST;

    $r = $this->modelo->buscar(array(
      "busqueda"=>$data["email"],
    ));

    if ($r['results'] > 0) {
      echo json_encode(array(
        "mensaje"=>"Ya existe un usuario con ese nombre o email",
        "error"=>1,
      ));
      exit;
    }

    $id = $this->modelo->save($data);

    echo json_encode(array(
      "error"=>0,
      "id"=>$id,
      "mensaje"=>"Tu registro fue completado correctamente. Un administrador se estara contactando contigo en los proximos días",
    ));

  }

  function actualizar_datos(){


    if (isset($_POST["check_password"])){
      $r = $this->modelo->check_password(array(
        "password"=>$_POST["check_password"],
        "id"=>$_POST["id"],
      ));

      if ($r === FALSE) {
        echo json_encode(array(
          "error"=>1,
          "mensaje"=>"La contraseña ingresada es incorrecta.",
        ));     
        exit;   
      }
    }

    $id = $this->modelo->save($_POST);

    $mensaje = "Los datos se han actualizado correctamente";
    if (isset($_POST["activo"]) && $_POST["activo"] == 0) {
      $mensaje = "Su usuario se ha desactivado correctamente";
    }

    echo json_encode(array(
      "error"=>0,
      "id"=>$id,
      "mensaje"=>$mensaje,
    ));

  }

}
