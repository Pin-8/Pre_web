<?php $this->load->view('header'); ?>

<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0"><?php echo ($id == 0) ? "Nuevo" : "Editar" ?> Traductor</h5>
</div>


<form name="usuarios_web">
  <div class="row">
    <div class="col-lg-12 col-12">
      <div class="mb-3">
        <label class="form-label" for="usuarios_web_nombre_usuario">Nombre de Usuario</label>
        <input class="form-control" name="nombre_usuario" value="<?php echo $usuario_web->nombre_usuario; ?>" id="usuarios_web_nombre_usuario" type="text" placeholder="Nombre de Usuario" />
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="mb-3">
        <label class="form-label" for="usuarios_web_nombre">Nombre</label>
        <input class="form-control" name="nombre" value="<?php echo $usuario_web->nombre; ?>" id="usuarios_web_nombre" type="text" placeholder="Nombre" />
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="mb-3">
        <label class="form-label" for="usuarios_web_apellido">Apellido</label>
        <input class="form-control" name="apellido" value="<?php echo $usuario_web->apellido; ?>" id="usuarios_web_apellido" type="text" placeholder="Apellido" />
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="mb-3">
        <label class="form-label" for="usuarios_web_fecha_nac">Fecha de Nacimiento</label>
        <input class="form-control" name="fecha_nac" value="<?php echo $usuario_web->fecha_nac; ?>" id="usuarios_web_fecha_nac" type="date" />
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="mb-3">
        <label class="form-label" for="usuarios_web_dni">DNI</label>
        <input class="form-control" name="dni" value="<?php echo $usuario_web->dni; ?>" id="usuarios_web_dni" type="number" />
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3">
        <?php 
          foto_uploader(array(
            "item"=>$usuario_web->foto_perfil,
            "label"=>"Foto de Perfil",
            "nombre"=>"foto_perfil",
            "carpeta"=>"usuarios_web"
          )); 
        ?>
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3 mt20">
        <label class="form-label">Descripcion</label>
        <textarea class="form-control" name="descripcion" name="usuarios_web_descripcion" id="usuarios_web_descripcion"><?php echo $usuario_web->descripcion; ?></textarea>
      </div>
    </div>
  </div>

  <label class="form-label">Información de Contacto</label>
  <div class="row">
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input class="form-control" value="<?php echo $usuario_web->email ?>" name="email" id="usuarios_web_email" type="text" placeholder="Email" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-home"></i></span>
        <input class="form-control" value="<?php echo $usuario_web->direccion ?>" name="direccion" id="usuarios_web_direccion" type="text" placeholder="Direccion" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-phone"></i></i></span>
        <input class="form-control" value="<?php echo $usuario_web->telefono ?>" name="telefono" type="text" id="usuarios_web_telefono" placeholder="Telefono" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-clock"></i></span>
        <input class="form-control" value="<?php echo $usuario_web->localidad ?>" name="localidad" type="text" id="usuarios_web_localidad" placeholder="Localidad" />
      </div>
    </div>    
  </div>

  <label class="form-label">Cambiar Contraseña</label>
  <div class="row">
    <div class="col-lg-6">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input class="form-control" name="password" id="usuarios_web_repetir_password" type="text" placeholder="Contraseña" />
      </div>
    </div>
    <div class="col-lg-6">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-key"></i></span>
        <input class="form-control" name="repetir_password" id="usuarios_web_repetir_password_dos" type="text" placeholder="Repetir Contraseña" />
      </div>
    </div>   
  </div>

</form>


<div class="align-items-right fr mt20">
  <button class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Guardar</span></button>
</div>

<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  
  $( document ).ready(function() {

    var MyEditor = "";
    ClassicEditor
            .create( document.querySelector('#usuarios_web_descripcion'))
            .then( editor => {
              MyEditor = editor;
            })


    $(".guardar").click(function() {
      var nombre = $("#usuarios_web_nombre").val();
      var apellido = $("#usuarios_web_apellido").val();

      var password = $("#usuarios_web_repetir_password").val();
      var password_dos = $("#usuarios_web_repetir_password_dos").val();

      //console.log(verificacion_path);
      //#return false;

      if (nombre == "") {
        alert ("Por favor ingrese un nombre");
        return false;
      }

      if (apellido == "") {
        alert ("Por favor ingrese un apellido");
        return false;
      }

      if (password != password_dos) {
        alert ("Las contraseñas deben coincidir");
        return false;
      }


      var form = document.forms.namedItem("usuarios_web");
      var formData = new FormData(form);
      formData.append('foto_perfil', $("#hidden_foto_perfil").val());
      formData.append('descripcion', MyEditor.getData());
      formData.append('id', "<?php echo $id; ?>");

      $.ajax({
        url:'/sistema/usuarios_web/save',
        type:'POST',
        data:formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
          location.href="/sistema/usuarios_web/listado"
        }
      });      


    });
  });

</script>