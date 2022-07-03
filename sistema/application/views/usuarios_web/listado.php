<?php $this->load->view('header'); ?>

<?php $filter = isset($_GET["filter"]) ? $_GET["filter"] : ""; ?>
<?php $params = $_SERVER['QUERY_STRING']; ?>

<div class="tar mb20">
  <a href="/sistema/usuarios_web/detalle/0" class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Nuevo Traductor</span></a>
</div>
<div class="card-header d-flex mb10 pl0 pr0">
  <h5 class="mb-0">Traductores</h5>
  <div class="filtros">
    <form>
      <input class="form-control search-input" type="search" value="<?php echo $filter; ?>" name="filter" placeholder="Buscar por nombre..." />

    </form>
    <select class="form-select w300" id="usuarios_web_id_estado">
      <option value="-1">Seleccione un Estado</option>
      <option <?php echo ($id_estado == 0) ? 'selected' : '' ?> value="0">En Verificacion</option>
      <option <?php echo ($id_estado == 1) ? 'selected' : '' ?> value="1">Inactivo</option>
      <option <?php echo ($id_estado == 2) ? 'selected' : '' ?> value="2">Activo</option>
    </select>
  </div>
</div>
<div class="table-responsive scrollbar">
  <table class="table table-hover table-striped overflow-hidden">
    <thead>
      <tr>
        <th class="thimg" scope="col"></th>
        <th scope="col">Nombre</th>
        <th scope="col">Información Personal</th>
        <th scope="col">Estado</th>
        <th class="text-end" scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultados as $r) { ?>
        <tr class="align-middle">

          <td class="text-nowrap">
            <?php if (!empty($r->foto_perfil)) { ?> <img src="<?php echo $r->foto_perfil ?>"> <?php } ?>
          </td>
          <td class="text-nowrap">
            <b><?php echo $r->nombre." ".$r->apellido; ?></b><br>
            <i><?php echo $r->nombre_usuario; ?></i>
              
          </td>
          <td class="text-nowrap">
            <?php if (!empty($r->email)) { ?> <i class="fas fa-envelope mr5"></i> <?php echo $r->email; ?><br> <?php } ?>
            <?php if (!empty($r->telefono)) { ?> <i class="fas fa-phone mr5"></i> <?php echo $r->telefono; ?><br> <?php } ?>
            <?php if (!empty($r->direccion)) { ?> <i class="fas fa-home mr5"></i> <?php echo $r->direccion; ?>, <?php } ?>
            <?php if (!empty($r->localidad)) { ?> <?php echo $r->localidad; ?><br> <?php } ?>
          </td>
          <td>
            <div class="dropdown-p">
              <?php if ($r->estado == 0) { ?>
                <span class="badge badge rounded-pill d-block p-2 badge-soft-primary">En Verficación<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
                <div class="drop-p-content">
                  <span data-value="1" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>" class="change_property badge badge rounded-pill d-block p-2 badge-soft-secondary">Inactivo<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                  <span data-value="2" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>"class="change_property badge badge rounded-pill d-block p-2 badge-soft-success drop-p">Activo<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </div>
              <?php } elseif ($r->estado == 1) { ?>
                <span class="badge badge rounded-pill d-block p-2 badge-soft-secondary">Inactivo<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                <div class="drop-p-content">
                  <span data-value="0" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>" class="change_property badge badge rounded-pill d-block p-2 badge-soft-primary">En Verficación<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
                  <span data-value="2" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>" class="change_property badge badge rounded-pill d-block p-2 badge-soft-success drop-p">Activo<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </div>
              <?php } elseif ($r->estado == 2) { ?>
                <span class="badge badge rounded-pill d-block p-2 badge-soft-success drop-p">Activo<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                <div class="drop-p-content">
                  <span data-value="1" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>" class="change_property badge badge rounded-pill d-block p-2 badge-soft-secondary">Inactivo<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                  <span data-value="0" data-property="estado" data-table="usuarios_web" data-id="<?php echo $r->id; ?>" class="change_property badge badge rounded-pill d-block p-2 badge-soft-primary">En Verficación<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
                </div>
              <?php } ?>
            </div>

          </span>
          <td class="text-end">
            <a href="/sistema/usuarios_web/detalle/<?php echo $r->id ?>"><span class="nav-link-icon iconito"><span class="fas fa-pencil-alt"></span></span></a> 
            <a class="eliminar_usuario_web" href="javascript:void(0)" data-id="<?php echo $r->id; ?>"><span class="nav-link-icon iconito pr8"><span class="fas fa-times"></span></span></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php $this->load->view('paginador',array(
  "pag"=>$pag,
  "total"=>$total,
  "url"=>"/sistema/usuarios_web/listado",
  "post_url"=>"/".$id_estado."/?".$params,
)); ?>

<?php $this->load->view('footer'); ?>

<script type="text/javascript">
  $(document).ready(function(){


    $(".eliminar_entradas").click(function(e) {
      var id = $(e.currentTarget).attr("data-id");
      
      if (window.confirm("¿Realmente desea eliminar la entrada?")) {
        $.ajax({
          "url":"/sistema/usuarios_web/delete",
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

    $("#usuarios_web_id_estado").change(function(e) {
      
      var id_estado_anterior = "<?php echo $id_estado; ?>";
      var id_estado = $(e.currentTarget).val();
      var pagina = "<?php echo $pag ?>";
      var params = "<?php echo $params ?>";

      if (id_estado_anterior != id_estado) {
        pagina = 1;
      }

      location.href="/sistema/usuarios_web/listado/"+pagina+"/"+id_estado+"/?"+params;

    });

    $("form").submit(function(event) {
      event.preventDefault();
      var filter_viejo = "<?php echo $filter ?> ";
      var filter = $('input[name="filter"]').val();
      var pagina = "<?php echo $pag ?>";
      var id_estado = $("#usuarios_web_id_estado").val();

      if (filter_viejo != filter) {
        pagina = 1;
      } 

      var params = "?";
      params += "filter="+filter;

      location.href="/sistema/usuarios_web/listado/"+pagina+"/"+id_estado+"/"+params;
    });



  });
</script>