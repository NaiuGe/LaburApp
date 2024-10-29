<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Perfil de usuario </title>
</head>
<body>
            <?php
                session_name("LOGIN");
                session_start();

                include ("conexion.php");

                if (isset($_SESSION['contador'])){

                    $id_usuario = $_SESSION['id_usuario'];
                    $consulta = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '$id_usuario';"; 
                
                    $resultado= mysqli_query($conexion, $consulta);
                    $cantfilas= mysqli_num_rows($resultado);

                    
                    //barra lateral
                    //checkbox para controlar a la barra lateral
                    echo "<input type='checkbox' id='activar-barra' class='activar-checkbox'>";
                    //etiqueta de botón para abrir y cerrar la barra
                    echo "<label for='activar-barra' class='boton-activar'>☰ Menú</label>";

                    //barra lateral sss

                    echo"<div class='barra-lateral'>
                    <a href='index.php'>Inicio</a>
                    <a href='perfil.php'>Ver Perfil</a>
                    <a href='publicaciones.php'>Mis Publicaciones</a>
                    <a href='foto_perfil.php'>Foto de Perfil</a>
                    <a href='cerrarlogin.php'>CERRAR SESIÓN</a>
                    </div>";


                    //contenido perfil
                    echo "<div class='barra-arriba'>";
                    echo "<div class='bloque-perfil'> <form id='contenedor-foto-perfil' action='info_perfil.php' method='POST'>";
                    if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                        echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                        header('Cache-Control: no-store, no-cache, must-revalidate');
                    } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                    echo "<input type='button' value='modificar' onClick='location=\"info_perfil.php\"'>";
                    echo '<br></br></div>';
                    echo '<div class="info"> <h1>'. $_SESSION['nombre'].' '. $_SESSION['apellido'] .'</h1>';
                    echo " <h3> Información</h3>";
                    while ( $fila = mysqli_fetch_assoc($resultado) ) {
                        echo "<p> ". $fila['informacion'] ." </p>";
                        echo "<h4>Número de Teléfono: </h4><p>". $fila['telefono'] ."</p>";
                        echo "<h4>Correo Electrónico: </h4><p>". $fila['mail'] ."</p>";
                        echo "<h4>Domicilio: </h4><p>". $fila['domicilio'] ."</p>";
                    }
                    echo "</div>";
                } else {
                    echo "No tenes una cuenta ingresada. Inicia Sesión e intentalo de nuevo.";
                    echo '<br><input type="button" value="Iniciar sesion" onclick="location=\'login.html\'">';
                }
                
            ?>
        
    </div>
    <div class="central">
        <h3>Trabajos Disponibles</h3>
        <div class="opciones">

        </div>
    </div>


</body>
</html>