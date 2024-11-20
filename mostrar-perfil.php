<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Perfil de usuario </title>
</head>
<body>
            <?php
                session_name("LOGIN");
                session_start();

                include ("conexion.php");

                if (isset($_GET['id_usuario'])){

                    $id_usuario = $_GET['id_usuario'];
                    $consulta = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '$id_usuario'"; 
                
                    $resultado= mysqli_query($conexion, $consulta);
                    $cantfilas= mysqli_num_rows($resultado);
                    $fila = mysqli_fetch_assoc($resultado);
                    echo "<header> 
                    <div class='logo'>Laburapp </div>
                    <nav><a href='index.php'>Inicio</a></nav>
                    </header>"; //barra superior
                    echo "<div class='barra-arriba'>";
                    echo "<div class='bloque-perfil'> <form id='contenedor-foto-perfil' action='info_perfil.php' method='POST'>";
                    if (!empty($fila['foto_perfil'] )){
                        echo "<img src='" . $fila['foto_perfil'] . "' class='fotoperfil'>";
                        header('Cache-Control: no-store, no-cache, must-revalidate');
                    } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                    echo '<br></br></div>';
                    echo '<div class="info"> <h1>'. $fila['nombre'].' '. $fila['apellido'] .'</h1>';
                    echo " <h3> Información</h3>";
                    echo "<p> ". $fila['informacion'] ." </p>";
                    echo "<h4>Número de Teléfono: </h4><p>". $fila['telefono'] ."</p>";
                    echo "<h4>Correo Electrónico: </h4><p>". $fila['mail'] ."</p>";
                    echo "<h4>Domicilio: </h4><p>". $fila['domicilio'] ."</p>";
                    echo "</div>
                    </div>";
                    echo '<div class="seccion">';
                    echo '<h3>Trabajos disponibles</h3>';
                    echo ' <div class="publicaciones"> ' ;
                            $consulta = "SELECT * FROM publicaciones WHERE id_usuario='$id_usuario' ";
                            $resultado = mysqli_query($conexion, $consulta);
                            $cantfilas= mysqli_num_rows($resultado);
                            if($cantfilas>=1){
                                $fila = mysqli_fetch_assoc($resultado);
                                echo "<a href='publicacion.php?id_publicacion=".$fila['id_publicaciones']."&value=4' class='link'>
                                    <img src='". $fila['foto_portada'] ."' id='fotopubli' c>
                                    <b> ". $fila['nombre_publicacion'] ." </b>
                                </a>";
                            while($fila = mysqli_fetch_assoc($resultado)){
                                    echo "<a href='publicacion.php?id_publicacion=".$fila['id_publicaciones']."&value=4' class='link'>
                                    <img src='".$fila['foto_portada']."' id='fotopubli' >
                                    <b> ". $fila['nombre_publicacion'] ." </b>
                                    </a>";
                            }
                            } else {echo "no hay publicaciones";}
                            
                
                        echo '  </div> ';
                    echo '  </div> ';
                }
                
                else {
                    echo "error";
                    echo '<br><input type="button" value="Iniciar sesion" onclick="location=\'login.html\'">';
                }
                
            ?>
        
    </div>


</body>
</html>