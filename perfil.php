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

                    //barra lateral sss

                    echo'<header> <nav class="nav-bar">
                    <ul>
                        <div>
                            <img class="logo-hidden"  src="./imagenes/logo.png" alt="logo-Laburapp">
                        </div>
                        <li><a href="index.php" alt="indice">Principal</a></li>
                        <li><a href="publicaciones.php" alt="Mis publicaciones">Mis publicaciones</a></li>
                        <li><a href="foto_perfil.php" alt="Foto de Perfil">Foto de Perfil</a></li>
                        <li><a href="cerrarlogin.php" alt="CERRAR SESIÓN">CERRAR SESIÓN</a></li>            
                        </ul>
                    </nav> </header>';


                    //contenido perfil
                    echo "<div class='barra-arriba'>";
                    echo "<div class='bloque-perfil'> <form id='contenedor-foto-perfil' action='info_perfil.php' method='POST'>";
                    if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                        echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                        header('Cache-Control: no-store, no-cache, must-revalidate');
                    } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                    echo "<input type='button' class='boton' value='modificar' onClick='location=\"info_perfil.php\"'>";
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
        
        <div class="seccion">
        <div class="publicaciones"> 
            <?php
                include ('conexion.php');
                //Paginacion, parte logica
                if (isset($_GET['pagina'])){
                    $pagina = $_GET['pagina'];
                } else {
                    $pagina = 1;
                }
                $rango_publi = 6;
                $desde = ($pagina-1)*$rango_publi;             
                $registro_publicaciones = "SELECT * from publicaciones";
                $resultado1 = mysqli_query($conexion, $registro_publicaciones);
                $cantf = mysqli_num_rows($resultado1);
                $cant_publi= ceil($cantf/$rango_publi);
                $sql = "SELECT * from publicaciones limit $desde, $rango_publi";
                $resultado1 = mysqli_query($conexion, $sql);
                $cantfilas = mysqli_num_rows($resultado1);
                if ($cantfilas>=1){ //carga la primera publicacion, fila_p es publicaciones, fila_u es de usuarios
                    $fila_p = mysqli_fetch_assoc($resultado1);
                    $id = $fila_p['id_usuario'];
                    $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                    $resultado2 = mysqli_query($conexion, $registro_usuarios);
                    $fila_u = mysqli_fetch_assoc($resultado2);  
                    echo "<a href='' class='link'>
                    <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                    <b> ". $fila_p['nombre_publicacion'] ." </b> 
                    <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                    </a>";
                    while ($fila_p = mysqli_fetch_assoc($resultado1) ){ //itera para q cargue las demas publicaciones
                        $id = $fila_p['id_usuario'];
                        $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                        $resultado2 = mysqli_query($conexion, $registro_usuarios);
                        $fila_u = mysqli_fetch_assoc($resultado2);  
                        echo "<a href='' class='link'>
                        <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                        <b> ". $fila_p['nombre_publicacion'] ." </b>
                        <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                        </a>";
                        
                    }

                } else {//Se carga una imagen default si no hay registro de publicaciones
                    echo '<a href="" class="link">
                            <img src="imagenes/icono_trabajo.png" id="fotopubli">
                        </a>';
                }
            ?>
        </div>
    </div>
    </div>


</body>
</html>