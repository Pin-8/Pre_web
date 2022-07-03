<?php $this->load->view('header'); ?>


<?php $filter = isset($_GET["filter"]) ? $_GET["filter"] : ""; ?>
<?php $params = $_SERVER['QUERY_STRING']; ?>
<div class="tar mb20">
  <a href="/sistema/entradas/detalle/0" class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Nueva Entrada</span></a>
</div>
<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0">Entradas</h5>
  <div class="filtros">
    <form>
      <input class="form-control search-input" type="search" value="<?php echo $filter; ?>" name="filter" placeholder="Buscar por titulo..." />

    </form>
    <select class="form-select w300" id="entrada_id_categoria">
      <option value="0">Seleccione una Categoria</option>
      <?php foreach ($categorias as $c) { ?>
        <option <?php echo ($c->id == $id_categoria) ? 'selected' : '' ?> value="<?php echo $c->id ?>"><?php echo $c->nombre; ?></option>
      <?php } ?>
    </select>
  </div>

</div>
<div class="table-responsive scrollbar">
  <table class="table table-hover table-striped overflow-hidden">
    <thead>
      <tr>
        <th class="thimg" scope="col"></th>
        <th scope="col">Titulo</th>
        <th scope="col">Categoria</th>
        <th scope="col">Precio</th>
        <th scope="col">descripcion</th>
        <th scope="col">Fecha de Publicacion</th>

        <th class="text-end" scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultados as $r) { ?>
        <tr class="align-middle">

          <td class="text-nowrap"> 
            <?php if (!empty($r->path)) { ?><img src="<?php echo $r->path ?>"><?php } ?>
          </td>
          <td class="text-nowrap"><?php echo $r->titulo; ?></td>
          <td class="text-nowrap"><?php echo $r->nombre_categoria; ?></td>
          <td class="text-nowrap"><?php echo $r->precio; ?></td>
          <td class="text-nowrap"><?php echo $r->descripcion; ?></td>
          <td class="text-nowrap"><?php echo $r->fecha_creacion_es; ?></td>
          <td class="text-end">
            <a href="/sistema/entradas/detalle/<?php echo $r->id ?>"><span class="nav-link-icon iconito"><span class="fas fa-pencil-alt"></span></span></a> 
            <a class="eliminar_entradas" href="javascript:void(0)" data-id="<?php echo $r->id; ?>"><span class="nav-link-icon iconito pr8"><span class="fas fa-times"></span></span></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php $this->load->view('paginador',array(
  "pag"=>$pag,
  "total"=>$total,
  "url"=>"/sistema/entradas/listado",
  "post_url"=>"/".$id_categoria."/?".$params,
)); ?>

<?php $this->load->view('footer'); ?>

<script type="text/javascript">
  $(document).ready(function(){


    $(".eliminar_entradas").click(function(e) {
      var id = $(e.currentTarget).attr("data-id");
      
      if (window.confirm("¿Realmente desea eliminar la entrada?")) {
        $.ajax({
          "url":"/sistema/entradas/delete",
          "type": "post",
          "data": {
            "id": id,
          },
          success:function(r){
            location.reload();
          }
        });
      }
            
    });

    $("#entrada_id_categoria").change(function(e) {
      var id_categoria_anterior = "<?php echo $id_categoria ?>";
      var id_categoria = $(e.currentTarget).val();
      var pagina = "<?php echo $pag ?>";
      var params = "<?php echo $params ?>";

      if (id_categoria_anterior != id_categoria) {
        pagina = 1;
      }

      location.href="/sistema/entradas/listado/"+pagina+"/"+id_categoria+"/?"+params;

    });

    $("form").submit(function(event) {
      event.preventDefault();
      var filter_viejo = "<?php echo $filter ?> ";
      var filter = $('input[name="filter"]').val();
      var pagina = "<?php echo $pag ?>";
      var id_categoria = $("#entrada_id_categoria").val();

      if (filter_viejo != filter) {
        pagina = 1;
      } 

      var params = "?";
      params += "filter="+filter;

      location.href="/sistema/entradas/listado/"+pagina+"/"+id_categoria+"/"+params;
    });


  });
</script>