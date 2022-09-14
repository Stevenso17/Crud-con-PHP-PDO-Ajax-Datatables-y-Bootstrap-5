<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!--Iconos CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!--JQERY-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--DataTables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!--MIS ESTILOS-->
    <link rel="stylesheet" href="s.css">
    <title>Creacion de usuario</title>
  </head>
  <body>
    <div class="container fondo">
         <h2 class="text-center">Creacion de usuario</h2>
         <h3 class="text-center">www.stevends.com</h3>
         <div class="row">
            <div class="col-2 offset-10">
                <div class="text/center">
                    <button class="btn btn-primary right" id="BtnCrear" onclick="$('#modalUsuario').modal('show');">
                    <i class="bi bi-person-plus"></i>
                    </button>
                </div>
             </div>
        </div>
        <br/>
        <br/>

        <div class="table-responsive">
           <table id="datos_usuario" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Foto de perfil</th>
                    <th>Fecha_Creacion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

           </table>
        </div>
    </div>
<!-- Modal crear -->
<div class="modal" id="modalUsuario" tabindex="-1" role="dialog">
	<form  enctype="multipart/form-data" id="formulario" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Crear Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">X</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="row">
	       	 <div class="col-12 form-group">
	       		<label for="">Ingrese el nombre</label>
	       		<input type="text" class="form-control" required="" name="nombre">
	       	</div>
            <div class="col-12 form-group">
	       		<label for="">Ingrese el apellido</label>
	       		<input type="text" class="form-control" required="" name="apellido">
	       	</div>
               <div class="col-12 form-group">
	       		<label for="">Ingrese el telefono</label>
	       		<input type="text" class="form-control" required="" name="telefono">
	       	</div>
               <div class="col-12 form-group">
	       		<label for="">Ingrese el email</label>
	       		<input type="text" class="form-control" required="" name="email">
	       	</div>
            <div class="col-12 form-group">
	       		<label for="">Seleccione el archivo</label>
	       		<input type="file" class="form-control" required="" name="imagen_usuario"
            id="imagen_usuario">
	       	</div>
	       </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success"><i class="bi bi-save2"></i></button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="bi bi-x-circle-fill"></i></button>
	      </div>
	    </div>
	  </div>
  </form>
</div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script type="text/javascript">
      $(document).ready(function()
          $("#BtnCrear").click(function(){
              $("#formulario")[0].reset();
              $(".modal")[0].text("Crear Usuario");
              
          });
        var dataTable = $('#datos_usuario').DataTables({
          "processing":true,
          "serverside":true,
          "orde":[],
          "ajax":{
            url:"obtener_registro.php",
            type:"post",

          },
          "columsDefs":[
            {
              "targets":[0,3,4],
              "orderable":false,
            },
           
          ]
        })
      });

      $(document).on('submit','#formulario',function(event){
        event.preventDefault();
        var nombres = $("#nombre").val();
        var apellido = $("#apellido").val();
        var telefono = $("#telefono").val();
        var email = $("#email").val();
        var extension = $("#imagen_usuario").val().split('.').pop().toLowerCase();
        
        if(extension != ''){
          if(jQuery.inArray(extension,['gif','png','jgp','jpeg']) == -1)
          alert("Formato de imagen invalido");
          $("#imagen_usuario").val('');
          return false;
        }
        if(nombres != '' && apellidos != '' && email !=''){
          $.ajax({
            url:"crear.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
              alert(data);
              $('#formulario')[0].reset();
              $('#modalUsuario').modal.hide();
              dataTable.ajax.reload();
            }
          });
        }else{
          alert("algunos campos son obligatorios");
        }
      });


    </script>
  </body>
</html>