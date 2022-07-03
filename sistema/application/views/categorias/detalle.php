<?php $this->load->view('header'); ?>

<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0"><?php echo ($id == 0) ? "Nueva" : "Editar" ?> Categoria</h5>
</div>

<div class="mb-3">
  <label class="form-label" for="categoria_nombre">Nombre</label>
  <input class="form-control" value="<?php echo $categoria->nombre; ?>" id="categoria_nombre" type="text" placeholder="Nombre de la categoria" />
</div>

<label class="form-label">Categoria Padre</label>
<select class="form-select" id="categoria_id_padre">
  <option value="0">Ninguna</option>
  <?php foreach ($categorias as $c) { ?>
    <option <?php echo ($c->id == $categoria->id_padre) ? 'selected' : '' ?> value="<?php echo $c->id ?>"><?php echo $c->nombre; ?></option>
  <?php } ?>
</select>

<div class="align-items-right fr mt20">
  <button class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Guardar</span></button>
</div>

<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  
  $( document ).ready(function() {

    $(".guardar").click(function() {
      var nombre = $("#categoria_nombre").val();
      var id_padre = $("#categoria_id_padre").val();

      if (nombre == "") {
        alert ("Por favor ingrese un nombre");
        $("#categoria_nombre").focus();
        return false;
      }

      var formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('id_padre', id_padre);
      formData.append('id', "<?php echo $id; ?>");

      $.ajax({
        url:'/sistema/categorias/save',
        type:'POST',
        data:formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
          location.href="/sistema/categorias/listado"
        }
      });      


    });
  });

</script>