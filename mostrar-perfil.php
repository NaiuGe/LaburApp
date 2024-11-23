<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Perfil de usuario </title>
</head>
<header>
<img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
        <img id="cerrar" class="cerrar-menu" src="./imagenes/cerrar.png" alt="Cruz para cerrar el menú">
                    <ul class="nav-list"> 
                    <li><a href="index.php" alt="indice">Principal</a></li>
                    <li><a href='perfil.php' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
</header>
    
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
                    echo "<div class='barra-arriba'>";
                    echo "<div class='bloque-perfil'> <form id='contenedor-foto-perfil' action='info_perfil.php' method='POST'>";
                    if (!empty($fila['foto_perfil'] )){
                        echo "<img src='" . $fila['foto_perfil'] . "' class='fotoperfil'>";
                        header('Cache-Control: no-store, no-cache, must-revalidate');
                    } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                    echo '<br></br></div>';
                    echo '<div class="info"> <h1>'. $fila['nombre'].' '. $fila['apellido'] .'</h1>';
                    echo "<div class='contenedor-datos'> <h3> Información</h3>";
                    echo "<p> ". $fila['informacion'] ." </p> </div>";
                    echo "<div class='contenedor-datos'> <h4>Número de Teléfono: </h4><p>". $fila['telefono'] ."</p> </div>";
                    echo "<div class='contenedor-datos'> <h4>Correo Electrónico: </h4><p>". $fila['mail'] ."</p> </div>";
                    echo "<div class='contenedor-datos'><h4>Domicilio: </h4><p>". $fila['domicilio'] ."</p> </div>";
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
    <footer> 
    <div class="paginacion">
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="./script.js"></script> 

</body>
</html>