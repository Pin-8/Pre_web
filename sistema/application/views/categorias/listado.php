<?php $this->load->view('header'); ?>

<div class="tar mb20">
  <a href="/sistema/categorias/detalle/0" class="btn btn-sm btn-primary px-4 guardar" type="button"><span>Nueva Categoria</span></a>
</div>

<div class="card-header d-flex justify-content-between mb10 pl0 pr0">
  <h5 class="mb-0">Categorias</h5>
</div>
<div class="dd" id="nestable">
    <ol class="dd-list lista-padre">
    	<?php foreach ($resultados as $c) { ?>
	        <li class="dd-item" data-id="<?php echo $c->id ?>">
              <div class="dd-handle dd3-handle">
                <i class="fas fa-arrows-alt"></i>
              </div>
              <div class="dd3-content">
                <?php echo $c->nombre ?>
                <a class="eliminar_categoria ml10" href="javascript:void(0)" data-id="<?php echo $c->id; ?>"><span class="pl5 nav-link-icon iconito pr8"><span class="fas fa-times"></span></span></a>
                <a href="/sistema/categorias/detalle/<?php echo $c->id ?>"><span class="nav-link-icon iconito"><span class="fas fa-pencil-alt"></span></span></a> 
              </div>
	            <?php if (sizeof($c->hijos) > 0) cargar_hijos($c->hijos); ?>
	        </li>
    	<?php } ?>
    </ol>
</div>

<?php
	function cargar_hijos($hijos) { ?>
		<ol class="dd-list">
			<?php foreach ($hijos as $h) { ?>
		    	<li class="dd-item" data-id="<?php echo $h->id ?>">
            <div class="dd-handle dd3-handle">
              <i class="fas fa-arrows-alt"></i>
            </div>
            <div class="dd3-content">
              <?php echo $h->nombre ?>
              <a class="eliminar_categoria ml10" href="javascript:void(0)" data-id="<?php echo $h->id; ?>"><span class="pl5 nav-link-icon iconito pr8"><span class="fas fa-times"></span></span></a>
              <a href="/sistema/categorias/detalle/<?php echo $h->id ?>"><span class="nav-link-icon iconito"><span class="fas fa-pencil-alt"></span></span></a> 
            </div>
		    	</li>
		    	<?php if (sizeof($h->hijos) > 0) cargar_hijos($h->hijos); ?>
		    <?php } ?>
		</ol>
	<?php }
 ?>



<?php $this->load->view('footer'); ?>
<script type="text/javascript">
  $(document).ready(function(){

    var updateOutput = function(e){
      var list   = e.length ? e : $(e.target),output = list.data('output');

      $.ajax({
        "url":"/sistema/categorias/guardar_categorias",
        "type": "post",
        "dataType": "json",
        "data": {
          "lista": list.nestable('serialize'),
        },
      });
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('#nestable3').nestable();

    $(".eliminar_categoria").click(function(e) {
      var id = $(e.currentTarget).attr("data-id");
      console.log(id);
      
      $.ajax({
        "url":"/sistema/categorias/delete",
        "type": "post",
        "data": {
          "id": id,
        },
        success:function(r){
          location.reload();
        }
      });
    });


  });
</script>