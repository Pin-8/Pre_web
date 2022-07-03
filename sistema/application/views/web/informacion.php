<?php $this->load->view('header'); ?>

<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0">Información Web</h5>
</div>

<form name="informacion_web">

  <label class="form-label">Redes Sociales</label>
  <div class="row">
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fab fa-youtube"></i></span>
        <input class="form-control" value="<?php echo $informacion->youtube ?>" name="youtube" type="text" placeholder="Youtube" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fab fa-facebook"></i></span>
        <input class="form-control" value="<?php echo $informacion->facebook ?>" name="facebook" type="text" placeholder="Facebook" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fab fa-linkedin"></i></span>
        <input class="form-control" value="<?php echo $informacion->linkedin ?>" name="linkedin" type="text" placeholder="Linkedin" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fab fa-instagram"></i></span>
        <input class="form-control" value="<?php echo $informacion->instagram ?>" name="instagram" type="text" placeholder="Instagram" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fab fa-twitter"></i></span>
        <input class="form-control" value="<?php echo $informacion->twitter ?>" name="twitter" type="text" placeholder="Twitter" />
      </div>
    </div>
  </div>

  <label class="form-label">Información General</label>
  <div class="row">
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-home"></i></span>
        <input class="form-control" value="<?php echo $informacion->direccion_uno ?>" name="direccion_uno" type="text" placeholder="Direccion 1" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-home"></i></span>
        <input class="form-control" value="<?php echo $informacion->direccion_dos ?>" name="direccion_dos" type="text" placeholder="Direccion 2" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-phone"></i></i></span>
        <input class="form-control" value="<?php echo $informacion->telefono_uno ?>" name="telefono_uno" type="text" placeholder="Telefono 1" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-phone"></i></i></span>
        <input class="form-control" value="<?php echo $informacion->telefono_dos ?>" name="telefono_dos" type="text" placeholder="Telefono 2" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-clock"></i></span>
        <input class="form-control" value="<?php echo $informacion->horario_uno ?>" name="horario_uno" type="text" placeholder="Horario 1" />
      </div>
    </div>
    <div class="col-lg-3">
      <div class="input-group mb-3"><span class="input-group-text"><i class="fas fa-clock"></i></span>
        <input class="form-control" value="<?php echo $informacion->horario_dos ?>" name="horario_dos" type="text" placeholder="Horario 2" />
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="mb-3">
        <label class="form-label">Texto Footer</label>
        <textarea class="form-control" name="texto_footer" rows="3"><?php echo $informacion->texto_footer ?></textarea>
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3">
        <?php 
          foto_uploader(array(
            "item"=>$informacion->imagen_qr,
            "label"=>"Foto de Imagen QR",
            "nombre"=>"imagen_qr",
            "carpeta"=>"web"
          )); 
        ?>
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3">
        <?php 
          foto_uploader(array(
            "item"=>$informacion->imagen_data_fiscal,
            "label"=>"Foto de Imagen Fiscal",
            "nombre"=>"imagen_data_fiscal",
            "carpeta"=>"web"
          )); 
        ?>
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


    $(".guardar").click(function() {

      var form = document.forms.namedItem("informacion_web");
      var formData = new FormData(form);
      formData.append('id', "1");
      formData.append('imagen_data_fiscal', $("#hidden_imagen_data_fiscal").val());
      formData.append('imagen_qr', $("#hidden_imagen_qr").val());

      $.ajax({
        url:'/sistema/web/save',
        type:'POST',
        data:formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
          location.href="/sistema/web/informacion"
        }
      });      


    });
  });

</script>