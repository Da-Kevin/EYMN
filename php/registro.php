<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>
</head>
<body>
    
</body>
</html>


<?php
$conn = mysqli_connect('localhost', 'root', '', 'eymn');


//hacemos llamado al imput de formuario
$Nombre_Real = $_POST["Nombre_Real"] ;
$Edad = $_POST["Edad"] ;
$Correo_Electronico = $_POST["correo_electrónico"] ;
$Telefono = $_POST["Telefono"] ;
$Nombre_Usuario = $_POST["Nombre_Usuario"] ;
$Direccion = $_POST["Direccion"] ;
$Clave = md5($_POST["Clave"]) ;

//verificamos la conexion a base datos
if(!$conn) 
        {
            echo "No se ha podido conectar con el servidor" . mysql_error();
        }
  else
        {
            echo "<script> alert('Validando información')</script>"; 
        }
        //indicamos el nombre de la base datos
        $datab = "eymn";
        //indicamos selecionar ala base datos
        $db = mysqli_select_db($conn,$datab);

        $sql="SELECT * FROM persona where correo_electrónico='$Correo_Electronico' or Nombre_Usuario='$Nombre_Usuario'";
        $result=mysqli_query($conn,$sql);

        $filas=mysqli_num_rows($result);


        if (!$db)
        {
        echo "No se ha podido conectar con el servidor";
        }
        else 
        {
          echo "";
        }
        //insertamos datos de registro al mysql xamp, indicando nombre de la tabla y sus atributos
        if ($filas){
          ?>
          <?php
           echo "<script> alert('Error: El usuario ya se encuentra registrado')</script>" ; 
           include("../html/REGISTRO.HTML");
        }
        else{

           $instruccion_SQL = "INSERT INTO persona (Nombre_Real, Edad, correo_electrónico, Telefono, Nombre_Usuario, Direccion, Clave, ID_Cargo)
           VALUES ('$Nombre_Real','$Edad','$Correo_Electronico', '$Telefono', '$Nombre_Usuario', '$Direccion', '$Clave', '2')";
 
           $resultado = mysqli_query($conn,$instruccion_SQL);
 
           header("location:../html/registroE.HTML");
        }