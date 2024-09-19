<!DOCTYPE html>
 <html lang="es">
 

   <head>
      <meta charset="utf-8"/>
      
	<meta name="viewport" content="width=device-width, initial-scale=1">
      <title>conexion mysql</title>    
   </head>
  <body>
      <?php
     
      function abrirConexion()
      {
        
          $host = "localhost";
          $user = "root";
          $pass = "";
          $baseDatos = "proyecto_final_daw";

          // Crear la conexión.
          $conexion = mysqli_connect($host, $user, $pass, $baseDatos);

          // Verificar la conexión.
          if (!$conexion) {
              die("Error de conexión: " . mysqli_connect_error());
          }
          return $conexion;
      }
      function cerrarConexion($conexion)
      {

          // Cerrar la conexión
          mysqli_close($conexion);
      }
      ?>


      
 </body>
 </html>
