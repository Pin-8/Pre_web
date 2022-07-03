
<?php 

$post_url = isset($post_url) ? $post_url : "/";

$total_paginas = ceil($total / 10); 
$max_paginas = 5;

if ($pag > $max_paginas-2) {
  $pagina_inicio = $pag - 2;
  $pagina_final = $pag + 2;
} else {
  $pagina_inicio = 1;
  $pagina_final = $max_paginas;
}

if ($pag >= $total_paginas) {
  $pagina_inicio = $pag-4;
  $pagina_final = $total_paginas;
}

if ($pagina_inicio < 1) $pagina_inicio = 1;
if ($pagina_final > $total_paginas) $pagina_final = $total_paginas;

if ($pag > $total_paginas - 2) {
  $cantidad_items = ($pagina_final - $pagina_inicio) + 1;
  $pagina_inicio = $pagina_inicio - (5-$cantidad_items);
}

if ($pagina_inicio < 1) $pagina_inicio = 1;
if ($pagina_final > $total_paginas) $pagina_final = $total_paginas;

?>

<div class="paginador">
  <a href="<?php echo ($pag == 1) ? 'javascript:void(0)' : $url.'/1'.$post_url; ?>" class="<?php echo ($pag == 1) ? 'disabled' : '' ?>">
    <<
  </a>
  <a href="<?php echo ($pag == 1) ? 'javascript:void(0)' : $url.'/'.($pag-1).$post_url; ?>" class="<?php echo ($pag == 1) ? 'disabled' : '' ?>">
    <
  </a>
  
  <?php for ($i = $pagina_inicio; $i <= $pagina_final; $i++) { ?>
    <a href="<?php echo $url.'/'.$i.$post_url; ?>" class="<?php echo ($i == $pag) ? 'active' : '' ?>">
      <?php echo $i; ?>
    </a>
  <?php } ?>

  <a href="<?php echo ($pag == $total_paginas) ? 'javascript:void(0)' : $url.'/'.($pag+1).$post_url; ?>" class="<?php echo ($pag == $total_paginas) ? 'disabled' : '' ?>">
    >
  </a>
  <a href="<?php echo ($pag == $total_paginas) ? 'javascript:void(0)' : $url.'/'.$total_paginas.$post_url; ?>" class="<?php echo ($pag == $total_paginas) ? 'disabled' : '' ?>">
    >>
  </a>
</div>