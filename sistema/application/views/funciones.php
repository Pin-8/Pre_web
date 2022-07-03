<?php 

function foto_uploader($data) { ?> 

  <?php 

  $label = isset($data["label"]) ? $data["label"] : "";
  $nombre = isset($data["nombre"]) ? $data["nombre"] : "";
  $carpeta = isset($data["carpeta"]) ? $data["carpeta"] : "";
  $item = isset($data["item"]) ? $data["item"] : "";

  ?>

  <label class="form-label" for="imagen_qr">Foto de Imagen QR</label>
  <div class="contenedor-imagen">
    <?php if ($item == "") { ?>
      <input class="form-control foto-uploader" data-nombre="<?php echo $nombre; ?>" data-carpeta="<?php echo $carpeta ?>" type="file" accept="image/png, image/gif, image/jpeg"  />
    <?php } else { ?>
      <div class="container-imagen">
        <img src="<?php echo $item; ?>">
        <div onclick="borrar_imagen(this)" class="borrar-imagen"><span class="nav-link-icon"><span class="fas fa-times"></span></span></div>
      </div>
      <input class="form-control foto-uploader dn" data-nombre="<?php echo $nombre ?>" data-carpeta="<?php echo $carpeta ?>" type="file" accept="image/png, image/gif, image/jpeg"  />
      <input type="hidden" id="hidden_<?php echo $nombre ?>" name="<?php echo $nombre ?>" value="<?php echo $item ?>">
    <?php } ?>
<?php }

?>