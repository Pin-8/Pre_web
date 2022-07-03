<?php $this->load->view('header'); ?>

<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0"><?php echo ($id == 0) ? "Nueva" : "Editar" ?> Entrada</h5>
</div>

<div class="mb-3">
  <label class="form-label" for="entrada_titulo">Titulo</label>
  <input class="form-control" value="<?php echo $entrada->titulo; ?>" id="entrada_titulo" type="text" placeholder="Titulo de la entrada" />
</div>

<div class="mb-3">

  <div class="mb-3">
    <?php 
      foto_uploader(array(
        "item"=>$entrada->path,
        "label"=>"Foto de Portada",
        "nombre"=>"path",
        "carpeta"=>"entradas"
      )); 
    ?>
  </div>
</div>

<label class="form-label">Categoria</label>
<select class="form-select" id="entrada_id_categoria">
  <option value="0">Ninguna</option>
  <?php foreach ($categorias as $c) { ?>
    <option <?php echo ($c->id == $entrada->id_categoria) ? 'selected' : '' ?> value="<?php echo $c->id ?>"><?php echo $c->nombre; ?></option>
  <?php } ?>
</select>

<div class="mb-3 mt20">
  <label class="form-label">Descripcion</label>
  <textarea class="form-control" name="entrada_descripcion" id="entrada_descripcion"><?php echo $entrada->descripcion; ?></textarea>
</div>



<div class="mb-3">
  <label class="form-label" for="entrada_precio">Precio</label>
  <input class="form-control" value="<?php echo $entrada->precio; ?>" id="entrada_precio" type="text" placeholder="Precio de la entrada" />
</div>

<div class="align-items-right fr">
  <button class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Guardar</span></button>
</div>



<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  
  $( document ).ready(function() {

    var MyEditor = "";
    ClassicEditor
            .create( document.querySelector('#entrada_descripcion'))
            .then( editor => {
              MyEditor = editor;
            })




      

    $(".guardar").click(function() {
      var titulo = $("#entrada_titulo").val();
      var precio = $("#entrada_precio").val();
      var path = $("#entrada_path").val();
      var id_categoria = $("#entrada_id_categoria").val();
      var verificacion_path = $(".container-imagen").hasClass("dn");

      //console.log(verificacion_path);
      //#return false;

      if (titulo == "") {
        alert ("Por favor ingrese un titulo de la entrada");
        return false;
      }

      if (precio == 0) {
        alert ("Por favor ingrese el precio de la entrada");
        return false;
      }

      if (verificacion_path == true && path == "") {
        alert ("Por favor ingrese una foto de portada");
        return false;
      }

      if (id_categoria == 0) {
        alert ("Por favor ingresa una categoria");
        return false;
      }

      if (MyEditor.getData() == "") {
        alert ("Por favor ingrese una descripcion");
        return false;
      }


      var formData = new FormData();
      formData.append('path', $('#hidden_path').val());
      formData.append('titulo', titulo);
      formData.append('precio', precio); // Nombre que pusimos en la base de datos
      formData.append('id_categoria', id_categoria);
      formData.append('descripcion', MyEditor.getData());
      formData.append('id', "<?php echo $id; ?>");

      $.ajax({
        url:'/sistema/entradas/save',
        type:'POST',
        data:formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
          location.href="/sistema/entradas/listado"
        }
      });      


    });
  });

</script>