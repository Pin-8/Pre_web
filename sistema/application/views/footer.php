          </div>
    </main>
    <?php $url = base_url(); ?>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?php echo $url; ?>/assets/js/jquery.js"></script>
    <script src="<?php echo $url; ?>/assets/js/jquery-ui.js"></script>
    <script src="<?php echo $url; ?>/assets/js/jquery-ui-touch-punch.min.js"></script>
    <script src="<?php echo $url; ?>/assets/js/nestable.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
    <script src="<?php echo $url; ?>/vendors/popper/popper.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/anchorjs/anchor.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/is/is.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/echarts/echarts.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/fontawesome/all.min.js"></script>
    <script src="<?php echo $url; ?>/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?php echo $url; ?>/vendors/list.js/list.min.js"></script>
    <script src="<?php echo $url; ?>/assets/js/theme.js"></script>

    <script type="text/javascript">


      function borrar_imagen(e){

        console.log(e);
        $(e).parent().addClass("dn");
        $(e).parent().next(".form-control").removeClass("dn");
        $(e).parent().parent().find('input[type="hidden"]').val("");

      }

      $( document ).ready(function() {


        $('.foto-uploader').change(function(e) {

          var contenedor = $(e.currentTarget).parent(".contenedor-imagen");
          var nombre = $(e.currentTarget).attr("data-nombre");
          var carpeta = $(e.currentTarget).attr("data-carpeta");


          var formData = new FormData();
          formData.append('files', $(e.currentTarget)[0].files[0]);  
          formData.append('carpeta', carpeta); 
          $.ajax({
            url:'/sistema/'+carpeta+'/save_image',
            type:'POST',
            dataType:'json',
            data:formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success:function(data){
              var src = "/sistema/"+data.src;
              info = `
                <div class="container-imagen">
                  <img src="${src}">
                  <div onclick="borrar_imagen(this)" class="borrar-imagen"><span class="nav-link-icon"><span class="fas fa-times"></span></span></div>
                </div>
                <input class="form-control foto-uploader dn" data-nombre="${nombre}" data-carpeta="${carpeta}" type="file" accept="image/png, image/gif, image/jpeg"  />
                <input type="hidden" id="hidden_${nombre}" name="${nombre}" value="${src}">`;
              contenedor.html(info);
            },
          });  
        });


        $(".borrar-imagen").click(function(e) {

          $(e.currentTarget).parent().addClass("dn");
          $(e.currentTarget).parent().next(".form-control").removeClass("dn");
          $(e.currentTarget).parent().parent().find('.input-hidden-foto').val("");

        });

        $(".cerrar-sesion").click(function(e) {

          $.ajax({
            "url":"/sistema/welcome/salir",
            "success":function(r){
              location.href = "<?php echo $url ?>";
            }
          })

        });


        $(".dropdown-p").click(function(e) {
          $(e.currentTarget).children('.drop-p-content').toggleClass("db");
          $(e.currentTarget).parent('td').toggleClass("vab");
        });

        $(".change_property").click(function(e) {

          var id = $(e.currentTarget).attr("data-id");
          var tabla = $(e.currentTarget).attr("data-table");
          var propiedad = $(e.currentTarget).attr("data-property");
          var valor = $(e.currentTarget).attr("data-value");

          $.ajax({
            "url":"/sistema/"+tabla+"/change_property",
            "type": "post",
            "dataType": "json",
            "data":{
              "id": id,
              "table": tabla,
              "property": propiedad,
              "value": valor,
            },success(r){
              location.reload();
            }
          })

        });


      });

    </script>

  </body>

</html>